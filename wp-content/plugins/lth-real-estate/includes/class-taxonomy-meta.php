<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class LTH_Real_Estate_Taxonomy_Meta {

    public function __construct() {
        // Hooks for 'project' taxonomy
        add_action( 'project_add_form_fields', [ $this, 'add_project_image_field' ], 10, 2 );
        add_action( 'project_edit_form_fields', [ $this, 'edit_project_image_field' ], 10, 2 );
        add_action( 'created_project', [ $this, 'save_project_image' ], 10, 2 );
        add_action( 'edited_project', [ $this, 'save_project_image' ], 10, 2 );
        
        // Add column
        add_filter( 'manage_edit-project_columns', [ $this, 'add_project_columns' ] );
        add_filter( 'manage_project_custom_column', [ $this, 'fill_project_columns' ], 10, 3 );
        
        // Scripts
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_taxonomy_scripts' ] );
    }

    public function enqueue_taxonomy_scripts( $hook ) {
        if ( $hook == 'edit-tags.php' || $hook == 'term.php' ) {
            if ( isset( $_GET['taxonomy'] ) && $_GET['taxonomy'] === 'project' ) {
                wp_enqueue_media();
            }
        }
    }

    public function add_project_image_field( $taxonomy ) {
        ?>
        <div class="form-field term-group">
            <label for="project_image">Ảnh đại diện dự án</label>
            <input type="hidden" id="project_image" name="project_image" class="custom_media_url" value="">
            <div id="project_image_wrapper" style="margin-top: 10px;"></div>
            <p>
                <button type="button" class="button button-secondary lth_tax_media_button" id="lth_tax_media_button">Tải ảnh lên</button>
                <button type="button" class="button button-link lth_tax_media_remove" id="lth_tax_media_remove" style="display:none; color: #d63638;">Xóa ảnh</button>
            </p>
        </div>
        <?php $this->print_js(); ?>
        <?php
    }

    public function edit_project_image_field( $term, $taxonomy ) {
        $image_id = get_term_meta( $term->term_id, 'project_image', true );
        $image_url = '';
        if ( $image_id ) {
            $image_url = wp_get_attachment_image_url( $image_id, 'thumbnail' );
        }
        ?>
        <tr class="form-field term-group-wrap">
            <th scope="row"><label for="project_image">Ảnh đại diện dự án</label></th>
            <td>
                <input type="hidden" id="project_image" name="project_image" value="<?php echo esc_attr( $image_id ); ?>">
                <div id="project_image_wrapper" style="margin-bottom: 10px;">
                    <?php if ( $image_url ) : ?>
                        <img src="<?php echo esc_url( $image_url ); ?>" style="max-width:150px; height:auto; display:block; border-radius:4px; border:1px solid #ccc;"/>
                    <?php endif; ?>
                </div>
                <p>
                    <button type="button" class="button button-secondary lth_tax_media_button" id="lth_tax_media_button">Tải ảnh lên</button>
                    <button type="button" class="button button-link lth_tax_media_remove" id="lth_tax_media_remove" style="<?php echo empty($image_id) ? 'display:none;' : ''; ?> color: #d63638;">Xóa ảnh</button>
                </p>
                <p class="description">Tải lên logo banner hoặc hình ảnh đại diện khu quy hoạch Dự án này.</p>
            </td>
        </tr>
        <?php $this->print_js(); ?>
        <?php
    }

    public function print_js() {
        ?>
        <script>
        jQuery(document).ready(function($){
            var custom_uploader;
            $('#lth_tax_media_button').click(function(e) {
                e.preventDefault();
                if (custom_uploader) {
                    custom_uploader.open();
                    return;
                }
                custom_uploader = wp.media.frames.file_frame = wp.media({
                    title: 'Chọn ảnh đại diện Dự án',
                    button: { text: 'Sử dụng ảnh này' },
                    multiple: false
                });
                custom_uploader.on('select', function() {
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    $('#project_image').val(attachment.id);
                    var url = attachment.url;
                    if(attachment.sizes && attachment.sizes.thumbnail) {
                        url = attachment.sizes.thumbnail.url;
                    }
                    $('#project_image_wrapper').html('<img src="'+url+'" style="max-width:150px; height:auto; display:block; border-radius:4px; border:1px solid #ccc;"/>');
                    $('#lth_tax_media_remove').show();
                });
                custom_uploader.open();
            });
            $('#lth_tax_media_remove').click(function(e){
                e.preventDefault();
                $('#project_image').val('');
                $('#project_image_wrapper').html('');
                $(this).hide();
            });
        });
        </script>
        <?php
    }

    public function save_project_image( $term_id, $tt_id ) {
        if ( isset( $_POST['project_image'] ) ) {
            $image_id = absint( $_POST['project_image'] );
            update_term_meta( $term_id, 'project_image', $image_id );
        }
    }

    public function add_project_columns( $columns ) {
        $new_columns = [];
        foreach ( $columns as $k => $v ) {
            if ( $k == 'name' ) {
                $new_columns['project_image'] = 'Ảnh đại diện';
            }
            $new_columns[$k] = $v;
        }
        return $new_columns;
    }

    public function fill_project_columns( $content, $column_name, $term_id ) {
        if ( 'project_image' == $column_name ) {
            $image_id = get_term_meta( $term_id, 'project_image', true );
            if ( $image_id ) {
                $image_url = wp_get_attachment_image_url( $image_id, 'thumbnail' );
                if ( $image_url ) {
                    $content = '<img src="' . esc_url( $image_url ) . '" style="width:60px; height:auto; border-radius:4px; border:1px solid #ddd;" />';
                } else {
                    $content = '—';
                }
            } else {
                $content = '—';
            }
        }
        return $content;
    }
}
