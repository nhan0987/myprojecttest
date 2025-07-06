<?php
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'WP_Customize_Control' ) ) return;

if ( ! class_exists( 'Penci_Custom_Button_Control' ) ) {
	/**
	 * Inherit from WP_Customize_Control and create a new type
	 */
	class Penci_Custom_Button_Control extends WP_Customize_Control {
		public $type = 'penci_render_button';
		public $data_type = '';
		public $description = '';
		public $nonce = '';

		public function enqueue() {
			wp_enqueue_script( 'pencidesign-render-button', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/js/button.js', array( 'customize-controls' ), PENCI_SOLEDAD_VERSION, true );
			wp_enqueue_style( 'pencidesign-render-style-button', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/css/button.css', array(), PENCI_SOLEDAD_VERSION );
		}
		
		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();

			$this->json['data_type'] = $this->data_type;
			$this->json['description'] = $this->description;
			$this->json['nonce'] = $this->nonce;
		}

		public function content_template() {
			?>
			<button class="button" data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>" data-type="{{{ data.data_type }}}" data-nonce="{{{ data.nonce }}}">{{{ data.label }}}</button>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">
					<p>{{{ data.description }}}</p>
				</span>
			<# } #>
			<?php
		}
	}
}
