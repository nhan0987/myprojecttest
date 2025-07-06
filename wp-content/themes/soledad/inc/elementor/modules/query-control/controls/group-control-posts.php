<?php

namespace PenciSoledadElementor\Modules\QueryControl\Controls;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;
use PenciSoledadElementor\Classes\Utils;
use PenciSoledadElementor\Modules\QueryControl\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Group_Control_Posts extends Group_Control_Base {

	const INLINE_MAX_RESULTS = 100;

	protected static $fields;

	public static function get_type() {
		return 'posts';
	}

	public static function on_export_remove_setting_from_element( $element, $control_id ) {
		unset( $element['settings'][ $control_id . '_posts_ids' ] );
		unset( $element['settings'][ $control_id . '_authors' ] );

		foreach ( Utils::get_public_post_types() as $post_type => $label ) {
			$taxonomy_filter_args = array(
				'show_in_nav_menus' => true,
				'object_type'       => array( $post_type )
			);

			$taxonomies = get_taxonomies( $taxonomy_filter_args, 'objects' );

			foreach ( $taxonomies as $taxonomy => $object ) {
				unset( $element['settings'][ $control_id . '_' . $taxonomy . '_ids' ] );
			}
		}

		return $element;
	}

	protected function init_fields() {
		$fields = [];

		$fields['post_type'] = array(
			'label' => __( 'Source', 'soledad' ),
			'type'  => Controls_Manager::SELECT
		);

		$fields['posts_ids'] = array(
			'label'       => __( 'Search by Title & Select', 'soledad' ),
			'type'        => 'penci-select2',
			'options'     => $this->get_post_list(),
			'source_name' => 'post_type',
			'source_type' => 'any',
			'label_block' => true,
			'multiple'    => true,
			'filter_type' => 'by_id',
			'condition'   => array( 'post_type' => 'by_id' )
		);

		$fields['authors'] = array(
			'label'       => __( 'Author', 'soledad' ),
			'label_block' => true,
			'type'        => Controls_Manager::SELECT2,
			'multiple'    => true,
			'default'     => array(),
			'options' => $this->get_authors_list(),
			//'filter_type' => 'author',
			'condition'   => array( 'post_type!' => array( 'by_id', 'current_query' ) )
		);

		return $fields;
	}
	
	public static function get_post_list($post_type = 'any', $limit = -1, $search = ''){
        global $wpdb;
        $where = '';
        $data = [];

        if (-1 == $limit) {
            $limit = '';
        } elseif (0 == $limit) {
            $limit = "limit 0,1";
        } else {
            $limit = $wpdb->prepare(" limit 0,%d", esc_sql($limit));
        }

        if ('any' === $post_type) {
            $in_search_post_types = get_post_types(['exclude_from_search' => false]);
            if (empty($in_search_post_types)) {
                $where .= ' AND 1=0 ';
            } else {
                $where .= " AND {$wpdb->posts}.post_type IN ('" . join("', '",
                    array_map('esc_sql', $in_search_post_types)) . "')";
            }
        } elseif (!empty($post_type)) {
            $where .= $wpdb->prepare(" AND {$wpdb->posts}.post_type = %s", esc_sql($post_type));
        }

        if (!empty($search)) {
            $where .= $wpdb->prepare(" AND {$wpdb->posts}.post_title LIKE %s", '%' . esc_sql($search) . '%');
        }

        $query = "select post_title,ID  from $wpdb->posts where post_status = 'publish' $where $limit";
        $results = $wpdb->get_results($query);
        if (!empty($results)) {
            foreach ($results as $row) {
                $data[$row->ID] = $row->post_title;
            }
        }
        return $data;
    }
	
	/**
     * Get all Authors
     *
     * @return array
     */
    public static function get_authors_list()
    {
        $users = get_users([
            'who' => 'authors',
            'has_published_posts' => false,
            'fields' => [
                'ID',
                'display_name',
            ],
        ]);

        if (!empty($users)) {
            return wp_list_pluck($users, 'display_name', 'ID');
        }

        return [];
    }
	
	

	protected function prepare_fields( $fields ) {
		$args = $this->get_args();

		$post_types = Utils::get_public_post_types( $args );

		$post_types_options = $post_types;

		$post_types_options['by_id']         = __( 'Manual Selection', 'soledad' );
		$post_types_options['current_query'] = __( 'Current Query', 'soledad' );

		$fields['post_type']['options'] = $post_types_options;

		$fields['post_type']['default'] = key( $post_types );

		$fields['posts_ids']['object_type'] = array_keys( $post_types );

		$taxonomy_filter_args = array( 'show_in_nav_menus' => true );

		if ( ! empty( $args['post_type'] ) ) {
			$taxonomy_filter_args['object_type'] = [ $args['post_type'] ];
		}

		$taxonomies = get_taxonomies( $taxonomy_filter_args, 'objects' );

		foreach ( $taxonomies as $taxonomy => $object ) {
			$taxonomy_args = array(
				'label'       => 'Include ' . $object->label,
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'object_type' => $taxonomy,
				'source_name' => 'taxonomy',
				'source_type' => $taxonomy,
				'options'     => array(),
				'condition'   => array( 'post_type' => $object->object_type )
			);

			$count = wp_count_terms( $taxonomy );

			$options = array();

			if ( $count > self::INLINE_MAX_RESULTS ) {
				$taxonomy_args['type'] = 'penci-select2';

				$taxonomy_args['filter_type'] = 'taxonomy';
			} else {
				$taxonomy_args['type'] = Controls_Manager::SELECT2;

				$terms = get_terms( array(
					'taxonomy'   => $taxonomy,
					'hide_empty' => false
				) );

				foreach ( $terms as $term ) {
					$options[ $term->term_id ] = $term->name;
				}

				$taxonomy_args['options'] = $options;
			}

			$fields[ $taxonomy . '_ids' ] = $taxonomy_args;
		}
		
		foreach ( $taxonomies as $taxonomy => $object ) {
			$taxonomy_args = array(
				'label'       => 'Exclude ' . $object->label,
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'object_type' => $taxonomy,
				'source_name' => 'taxonomy',
				'source_type' => $taxonomy,
				'options'     => array(),
				'condition'   => array( 'post_type' => $object->object_type )
			);

			$count = wp_count_terms( $taxonomy );

			$options = array();

			if ( $count > self::INLINE_MAX_RESULTS ) {
				$taxonomy_args['type'] = 'penci-select2';

				$taxonomy_args['filter_type'] = 'taxonomy';
			} else {
				$taxonomy_args['type'] = Controls_Manager::SELECT2;

				$terms = get_terms( array(
					'taxonomy'   => $taxonomy,
					'hide_empty' => false
				) );

				foreach ( $terms as $term ) {
					$options[ $term->term_id ] = $term->name;
				}

				$taxonomy_args['options'] = $options;
			}

			$fields[ $taxonomy . '_exids' ] = $taxonomy_args;
		}
		
		$fields['ignore_sticky_posts'] = array(
			'label' => __( 'Ignore Sticky Posts', 'soledad' ),
			'type' => Controls_Manager::SWITCHER,
			'default' => 'yes',
			'condition' => array( 'post_type' => 'post' ),
			'description' => __( 'Sticky-posts ordering is visible on frontend only. And includes sticky posts doesn\'t work if you filter your posts by a taxonomy or multiple taxonomies (categories, tags... ) - because it doesn\'t support by WordPress itself.', 'soledad' ),
			'separator' => 'before',
		);

		return parent::prepare_fields( $fields );
	}

	protected function get_default_options() {
		return array( 'popover' => false );
	}
}
