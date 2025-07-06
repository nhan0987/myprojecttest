<?php
namespace PenciSoledadElementor\Modules\PenciBigGrid\Widgets;

use PenciSoledadElementor\Base\Base_Widget;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use PenciSoledadElementor\Modules\QueryControl\Module as Query_Control;
use PenciSoledadElementor\Modules\QueryControl\Controls\Group_Control_Posts;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PenciBigGrid extends Base_Widget {

	public function get_name() {
		return 'penci-big-grid';
	}

	public function get_title() {
		return esc_html__( 'Penci Big Grid', 'soledad' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}
	
	public function get_categories() {
		return [ 'penci-elements' ];
	}

	public function get_keywords() {
		return array( 'big grid', 'post' );
	}

	protected function _register_controls() {
		parent::_register_controls();

		// Section layout
		$this->start_controls_section(
			'section_general', array(
				'label' => esc_html__( 'General', 'soledad' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		
		$this->add_control(
			'bgquery_type', array(
				'label'   => __( 'Query Type:', 'soledad' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post',
				'options' => array(
					'post' => esc_html__( 'Based Posts', 'soledad' ),
					'custom' => esc_html__( 'Custom', 'soledad' ),
				)
			)
		);
		
		$this->add_control(
			'style', array(
				'label'   => __( 'Big Grid Style', 'soledad' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Grid ( Default )', 'soledad' ),
					'style-2' => esc_html__( 'Style 2', 'soledad' ),
					'style-3' => esc_html__( 'Style 3', 'soledad' ),
					'style-4' => esc_html__( 'Style 4', 'soledad' ),
					'style-5' => esc_html__( 'Style 5', 'soledad' ),
					'style-6' => esc_html__( 'Style 6', 'soledad' ),
					'style-7' => esc_html__( 'Style 7', 'soledad' ),
					'style-8' => esc_html__( 'Style 8', 'soledad' ),
					'style-9' => esc_html__( 'Style 9', 'soledad' ),
					'style-10' => esc_html__( 'Style 10', 'soledad' ),
					'style-11' => esc_html__( 'Style 11', 'soledad' ),
					'style-12' => esc_html__( 'Style 12', 'soledad' ),
					'style-13' => esc_html__( 'Style 13', 'soledad' ),
					'style-14' => esc_html__( 'Style 14', 'soledad' ),
					'style-15' => esc_html__( 'Style 15', 'soledad' ),
					'style-16' => esc_html__( 'Style 16', 'soledad' ),
					'style-17' => esc_html__( 'Style 17', 'soledad' ),
					'style-18' => esc_html__( 'Style 18', 'soledad' ),
					'style-19' => esc_html__( 'Style 19', 'soledad' ),
					'style-20' => esc_html__( 'Style 20', 'soledad' )
				)
			)
		);
		
		$this->add_control(
			'bg_columns', array(
				'label'   => __( 'Grid Style Columns', 'soledad' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => array(
					'1' => esc_html__( '1 Column', 'soledad' ),
					'2' => esc_html__( '2 Columns', 'soledad' ),
					'3' => esc_html__( '3 Columns', 'soledad' ),
					'4' => esc_html__( '4 Columns', 'soledad' ),
					'5' => esc_html__( '5 Columns', 'soledad' ),
					'6' => esc_html__( '6 Columns', 'soledad' )
				),
				'selectors' => array( '{{WRAPPER}} .home-featured-boxes' => 'margin-bottom: {{VALUE}}' ),
				'condition'      => array( 'style' => 'style-1' ),
			)
		);
		
		$this->add_responsive_control(
			'bg_gap', array(
				'label'   => __( 'Gap Between Items', 'soledad' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array( '' => array( 'min' => 0, 'max' => 100, ) ),
				'selectors' => array( '{{WRAPPER}} .home-featured-boxes' => 'margin-bottom: {{SIZE}}' ),
			)
		);
		
		$this->add_responsive_control(
			'penci_img_ratio', array(
				'label'          => __( 'Adjust Ratio', 'soledad' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array( 'size' => 0.66 ),
				'tablet_default' => array( 'size' => '' ),
				'mobile_default' => array( 'size' => 0.5 ),
				'range'          => array( 'px' => array( 'min' => 0.1, 'max' => 3, 'step' => 0.01 ) ),
				'selectors'      => array(
					'{{WRAPPER}} .home-featured-boxes .penci-image-holder:before' => 'padding-top: calc( {{SIZE}} * 100% );',
				),
			)
		);
		
		$this->add_responsive_control(
			'penci_margin_bottom', array(
				'label'   => __( 'Margin Bottom', 'soledad' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array( 'px' => array( 'min' => 0, 'max' => 500, ) ),
				'selectors' => array( '{{WRAPPER}} .home-featured-boxes' => 'margin-bottom: {{SIZE}}px' ),
			)
		);

		$this->end_controls_section();
		
		$this->register_query_section_controls();
		
		$this->start_controls_section(
			'bg_custom', array(
				'label' => __( 'Custom Items', 'soledad' ),
				'condition' => array( 'bgquery_type' => 'custom' ),
			)
		);

		$repeater = new Repeater();
		$repeater->start_controls_tabs( 'biggrid_repeater' );

		$repeater->start_controls_tab( 'content', array( 'label' => __( 'Content', 'soledad' ) ) );
		
		$repeater->add_control(
			'image', array(
				'label'     => _x( 'Select Image', 'soledad' ),
				'type'      => Controls_Manager::MEDIA,
				'default' => array( 'url' => Utils::get_placeholder_image_src() ),
			)
		);
		
		$repeater->add_control(
			'sub_title', array(
				'label'       => __( 'Sub title', 'soledad' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Sub title', 'soledad' ),
				'label_block' => true,
			)
		);
		
		$repeater->add_control(
			'title', array(
				'label'       => __( 'Title', 'soledad' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Heading Title', 'soledad' ),
				'label_block' => true,
			)
		);
		
		$repeater->add_control(
			'title_link', array(
				'label'       => __( 'Title URL', 'soledad' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'soledad' ),
			)
		);

		$repeater->add_control(
			'desc', array(
				'label'      => __( 'Description', 'soledad' ),
				'type'       => Controls_Manager::TEXTAREA,
				'default'    => __( 'I am demo text - click edit button to change me.', 'soledad' ),
				'show_label' => true,
			)
		);

		$repeater->add_control(
			'button_text', array(
				'label'   => __( 'Button Text', 'soledad' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Read More', 'soledad' ),
			)
		);

		$repeater->add_control(
			'button_link', array(
				'label'       => __( 'Button Link', 'soledad' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'soledad' ),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'background', array( 'label' => __( 'Background', 'soledad' ) ) );
		
		$repeater->add_control(
			'background_size', array(
				'label'      => _x( 'Background Size', 'Background Control', 'soledad' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'cover',
				'options'    => array(
					'cover'   => _x( 'Cover', 'Background Control', 'soledad' ),
					'contain' => _x( 'Contain', 'Background Control', 'soledad' ),
					'auto'    => _x( 'Auto', 'Background Control', 'soledad' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-ctslide-bg' => 'background-size: {{VALUE}}'
				),
			)
		);

		$repeater->add_control(
			'background_position', array(
				'label'      => _x( 'Background Position', 'Background Control', 'soledad' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'center center',
				'options'    => array(
					'left center'   => _x( 'Left Center', 'Background Control', 'soledad' ),
					'left left'   => _x( 'Left Left', 'Background Control', 'soledad' ),
					'left right'   => _x( 'Left Right', 'Background Control', 'soledad' ),
					'center left'   => _x( 'Center Left', 'Background Control', 'soledad' ),
					'center center'   => _x( 'Center Center', 'Background Control', 'soledad' ),
					'center right'   => _x( 'Center Right', 'Background Control', 'soledad' ),
					'right left'   => _x( 'Right Left', 'Background Control', 'soledad' ),
					'right center'   => _x( 'Right Center', 'Background Control', 'soledad' ),
					'right right'   => _x( 'Right Right', 'Background Control', 'soledad' )
				),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-ctslide-bg' => 'background-position: {{VALUE}}'
				),
			)
		);
		
		$repeater->add_control(
			'background_attachment', array(
				'label'      => _x( 'Background Attachment', 'Background Control', 'soledad' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'scroll',
				'options'    => array(
					'scroll'   => _x( 'Scroll', 'Background Control', 'soledad' ),
					'fixed'   => _x( 'Fixed', 'Background Control', 'soledad' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-ctslide-bg' => 'background-attachment: {{VALUE}}'
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'style', array( 'label' => __( 'Style', 'soledad' ) ) );

		$repeater->add_control(
			'custom_style', array(
				'label'       => __( 'Custom', 'soledad' ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => __( 'Set custom style that will only affect this item only. To adjust the style for all items, check options on the "Style" tab', 'soledad' ),
			)
		);

		$repeater->add_control(
			'horizontal_position', array(
				'label'                => __( 'Horizontal Position', 'soledad' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => array(
					'left'   => array(
						'title' => __( 'Left', 'soledad' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'soledad' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'soledad' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors'            => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-ctslide-inner .penci-ctslider-content' => '{{VALUE}}',
				),
				'selectors_dictionary' => array(
					'left'   => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right'  => 'margin-left: auto',
				),
				'conditions'           => array(
					'terms' => array(
						array(
							'name'  => 'custom_style',
							'value' => 'yes',
						)
					),
				),
			)
		);

		$repeater->add_control(
			'vertical_position',
			array(
				'label'                => __( 'Vertical Position', 'soledad' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => array(
					'top'    => array(
						'title' => __( 'Top', 'soledad' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => __( 'Middle', 'soledad' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => __( 'Bottom', 'soledad' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors'            => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-ctslide-inner' => 'align-items: {{VALUE}}',
				),
				'selectors_dictionary' => array(
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				),
				'conditions'           => array(
					'terms' => array(
						array(
							'name'  => 'custom_style',
							'value' => 'yes',
						)
					)
				),
			)
		);

		$repeater->add_control(
			'text_align', array(
				'label'       => __( 'Text Align', 'soledad' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'left'   => array(
						'title' => __( 'Left', 'soledad' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'soledad' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'soledad' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-ctslide-inner' => 'text-align: {{VALUE}}'
				),
				'conditions'  => array(
					'terms' => array(
						array(
							'name'  => 'custom_style',
							'value' => 'yes',
						)
					)
				),
			)
		);

		$repeater->add_control(
			'subtitle_color', array(
				'label'      => __( 'Sub Title Color', 'soledad' ),
				'type'       => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-title'                     => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-caption'                   => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-slider_btnwrap .pencislider-btn' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'custom_style',
							'value' => 'yes',
						)
					)
				)
			)
		);
		
		$repeater->add_control(
			'title_color', array(
				'label'      => __( 'Title Color', 'soledad' ),
				'type'       => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-title'                     => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-caption'                   => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-slider_btnwrap .pencislider-btn' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'custom_style',
							'value' => 'yes',
						)
					)
				)
			)
		);
		
		$repeater->add_control(
			'title_hcolor', array(
				'label'      => __( 'Title Hover Color', 'soledad' ),
				'type'       => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-title'                     => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-caption'                   => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-slider_btnwrap .pencislider-btn' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'custom_style',
							'value' => 'yes',
						)
					)
				)
			)
		);
		
		$repeater->add_control(
			'desc_color', array(
				'label'      => __( 'Description Color', 'soledad' ),
				'type'       => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-title'                     => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-caption'                   => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-slider_btnwrap .pencislider-btn' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'custom_style',
							'value' => 'yes',
						)
					)
				)
			)
		);
		
		$repeater->add_control(
			'button_border_color', array(
				'label'      => __( 'Button Border Color', 'soledad' ),
				'type'       => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-title'                     => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-caption'                   => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-slider_btnwrap .pencislider-btn' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'custom_style',
							'value' => 'yes',
						)
					)
				)
			)
		);
		
		$repeater->add_control(
			'button_bg_color', array(
				'label'      => __( 'Button Background Color', 'soledad' ),
				'type'       => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-title'                     => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-caption'                   => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-slider_btnwrap .pencislider-btn' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'custom_style',
							'value' => 'yes',
						)
					)
				)
			)
		);
		
		$repeater->add_control(
			'button_color', array(
				'label'      => __( 'Button Text Color', 'soledad' ),
				'type'       => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-title'                     => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-caption'                   => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-slider_btnwrap .pencislider-btn' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'custom_style',
							'value' => 'yes',
						)
					)
				)
			)
		);
		
		$repeater->add_control(
			'button_border_hcolor', array(
				'label'      => __( 'Button Border Hover Color', 'soledad' ),
				'type'       => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-title'                     => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-caption'                   => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-slider_btnwrap .pencislider-btn' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'custom_style',
							'value' => 'yes',
						)
					)
				)
			)
		);
		
		$repeater->add_control(
			'button_bg_hcolor', array(
				'label'      => __( 'Button Background Hover Color', 'soledad' ),
				'type'       => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-title'                     => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-caption'                   => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-slider_btnwrap .pencislider-btn' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'custom_style',
							'value' => 'yes',
						)
					)
				)
			)
		);
		
		$repeater->add_control(
			'button_hcolor', array(
				'label'      => __( 'Button Text Hover Color', 'soledad' ),
				'type'       => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-title'                     => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-caption'                   => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .penci-slider_btnwrap .pencislider-btn' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'custom_style',
							'value' => 'yes',
						)
					)
				)
			)
		);
		
		
		$repeater->add_responsive_control(
			'bgoverlay_padding',array(
				'label' => __( 'Padding', 'soledad' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-title-overlay .pslider-bgoverlay-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .pencislider-caption-overlay .pslider-bgoverlay-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'  => 'custom_style',
							'value' => 'yes',
						)
					)
				)
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'biggrid_items', array(
				'label'       => __( 'Big Grid Custom Items', 'soledad' ),
				'type'        => Controls_Manager::REPEATER,
				'show_label'  => true,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'image' => array( 'url' => Utils::get_placeholder_image_src() ),
						'sub_title'          => __( 'Sub Title', 'soledad' ),
						'title'          => __( 'Big Grid Item #1', 'soledad' ),
						'desc'      => __( 'Click edit button to change this text', 'soledad' ),
						'button_text'      => __( 'Click Here', 'soledad' ),
					),
					array(
						'image' => array( 'url' => Utils::get_placeholder_image_src() ),
						'sub_title'          => __( 'Sub Title', 'soledad' ),
						'title'          => __( 'Big Grid Item #2', 'soledad' ),
						'desc'      => __( 'Click edit button to change this text', 'soledad' ),
						'button_text'      => __( 'Click Here', 'soledad' ),
					),
					array(
						'image' => array( 'url' => Utils::get_placeholder_image_src() ),
						'sub_title'          => __( 'Sub Title', 'soledad' ),
						'title'          => __( 'Big Grid Item #3', 'soledad' ),
						'desc'      => __( 'Click edit button to change this text', 'soledad' ),
						'button_text'      => __( 'Click Here', 'soledad' ),
					),
					array(
						'image' => array( 'url' => Utils::get_placeholder_image_src() ),
						'sub_title'          => __( 'Sub Title', 'soledad' ),
						'title'          => __( 'Big Grid Item #4', 'soledad' ),
						'desc'      => __( 'Click edit button to change this text', 'soledad' ),
						'button_text'      => __( 'Click Here', 'soledad' ),
					),
					array(
						'image' => array( 'url' => Utils::get_placeholder_image_src() ),
						'sub_title'          => __( 'Sub Title', 'soledad' ),
						'title'          => __( 'Big Grid Item #5', 'soledad' ),
						'desc'      => __( 'Click edit button to change this text', 'soledad' ),
						'button_text'      => __( 'Click Here', 'soledad' ),
					),
					array(
						'image' => array( 'url' => Utils::get_placeholder_image_src() ),
						'sub_title'          => __( 'Sub Title', 'soledad' ),
						'title'          => __( 'Big Grid Item #6', 'soledad' ),
						'desc'      => __( 'Click edit button to change this text', 'soledad' ),
						'button_text'      => __( 'Click Here', 'soledad' ),
					),
				),
				'title_field' => '{{{ title }}}',
			)
		);
		
		$this->end_controls_section();

		$this->register_block_title_section_controls();
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_title_block_style',
			array(
				'label' => __( 'Big Grid Style', 'soledad' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		
		$this->add_control(
			'thumb_size', array(
				'label'   => __( 'Custom General Image Size', 'soledad' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => $this->get_list_image_sizes( true ),
				//'condition'      => array( 'penci_featimg_size' => 'custom' ),
			)
		);

		$this->add_control(
			'img_box_border_color', array(
				'label'     => __( 'Background and Border color', 'soledad' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} ul.homepage-featured-boxes .penci-fea-in h4 span span:before'     => 'border-color: {{VALUE}};',
					'{{WRAPPER}} ul.homepage-featured-boxes li .penci-fea-in:after'                => 'border-color: {{VALUE}};',
					'{{WRAPPER}} ul.homepage-featured-boxes li .penci-fea-in:before'               => 'border-color: {{VALUE}};',
					'{{WRAPPER}} ul.homepage-featured-boxes .penci-fea-in.boxes-style-2 h4:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} ul.homepage-featured-boxes .penci-fea-in h4 span span'            => 'background-color: {{VALUE}};',
					'{{WRAPPER}} ul.homepage-featured-boxes .penci-fea-in.boxes-style-2 h4'        => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'img_box_text_color', array(
				'label'     => __( 'Text color', 'soledad' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array( '{{WRAPPER}} ul.homepage-featured-boxes .penci-fea-in h4 > span,{{WRAPPER}} ul.homepage-featured-boxes .penci-fea-in h4 span span' => 'color: {{VALUE}};' ),
			)
		);
		$this->add_control(
			'img_box_text_hcolor', array(
				'label'     => __( 'Hover text color', 'soledad' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} ul.homepage-featured-boxes li .penci-fea-in:hover h4 > span' => 'color: {{VALUE}};',
					'{{WRAPPER}} ul.homepage-featured-boxes li .penci-fea-in:hover h4 span span' => 'color: {{VALUE}};',
				),
			)
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(), array(
				'name'     => 'img_box_typo',
				'label'    => __( 'Text Typography', 'soledad' ),
				'selector' => '{{WRAPPER}} ul.homepage-featured-boxes .penci-fea-in h4 > span,{{WRAPPER}} ul.homepage-featured-boxes .penci-fea-in h4 span span',
			)
		);
		
		$this->end_controls_section();
	}
	
	protected function register_query_section_controls() {
		
		$this->start_controls_section(
			'section_query', array(
				'label' => __( 'Query Based Posts', 'soledad' ),
				'condition' => array( 'bgquery_type' => 'post' ),
				'tab'   => Controls_Manager::TAB_CONTENT
			)
		);
		
		$this->add_group_control(
			Group_Control_Posts::get_type(), array(
				'name' => 'posts'
			)
		);

		$this->add_control(
			'posts_per_page', array(
				'label'   => __( 'Posts Per Page', 'soledad' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 10,
			)
		);

		$this->add_control(
			'orderby', array(
				'label'   => __( 'Order By', 'soledad' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'          => __( 'Published Date', 'soledad' ),
					'ID'            => 'Post ID',
					'modified'      => 'Modified Date',
					'title'         => 'Post Title',
					'rand'          => 'Random Posts',
					'comment_count' => 'Comment Count',
				)
			)
		);

		$this->add_control(
			'order', array(
				'label'   => __( 'Order', 'soledad' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => array(
					'asc'  => __( 'ASC', 'soledad' ),
					'desc' => __( 'DESC', 'soledad' )
				)
			)
		);

		$this->add_control(
			'offset', array(
				'label'       => __( 'Offset', 'soledad' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 0,
				'condition'   => array( 'posts_post_type!' => array( 'by_id', 'current_query' ) ),
				'description' => __( 'Use this setting to skip over posts (e.g. \'2\' to skip over 2 posts).', 'soledad' ),
			)
		);

		Query_Control::add_exclude_controls( $this );
		
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['boxes_data'] ) ) {
			return;
		}
		$size = $settings['penci_size'];
		$thumb = 'penci-thumb';
		if( $size == 'square' ){
			$thumb = 'penci-thumb-square';
		} elseif( $size == 'vertical' ) {
			$thumb = 'penci-thumb-vertical';
		} elseif ( $size == 'custom' ){
			if( $settings['thumbnail_size'] ){
				$thumb = $settings['thumbnail_size'];
			}
		}
		?>
		<div class="clearfix penci-biggrid penci-bgel">
			<div class="penci-biggrid-inner">
				<div class="penci-biggrid-wrapper">
					
				</div>
			</div>
		</div>
		<?php
	}
	
	/**
	 * Get image sizes.
	 *
	 * Retrieve available image sizes after filtering `include` and `exclude` arguments.
	 */
	public function get_list_image_sizes( $default = false ) {
		$wp_image_sizes = $this->get_all_image_sizes();

		$image_sizes = array();

		if ( $default ) {
			$image_sizes[''] = esc_html__( 'Default', 'soledad' );
		}

		foreach ( $wp_image_sizes as $size_key => $size_attributes ) {
			$control_title = ucwords( str_replace( '_', ' ', $size_key ) );
			if ( is_array( $size_attributes ) ) {
				$control_title .= sprintf( ' - %d x %d', $size_attributes['width'], $size_attributes['height'] );
			}

			$image_sizes[ $size_key ] = $control_title;
		}

		$image_sizes['full'] = esc_html__( 'Full', 'soledad' );

		return $image_sizes;
	}

	public function get_all_image_sizes() {
		global $_wp_additional_image_sizes;

		$default_image_sizes = [ 'thumbnail', 'medium', 'medium_large', 'large' ];

		$image_sizes = [];

		foreach ( $default_image_sizes as $size ) {
			$image_sizes[ $size ] = [
				'width'  => (int) get_option( $size . '_size_w' ),
				'height' => (int) get_option( $size . '_size_h' ),
				'crop'   => (bool) get_option( $size . '_crop' ),
			];
		}

		if ( $_wp_additional_image_sizes ) {
			$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
		}

		return $image_sizes;
	}
	
}
