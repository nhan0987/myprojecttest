<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class LTH_Real_Estate_Config {

    /**
     * Get a setting by key
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get( $key, $default = null ) {
        $settings = [
            'phone_link'   => '0972991551',
            'phone_number' => '0972 991 551',
            'email'        => 'info@stnd.vn',
            // Add more keys here
        ];

        return isset( $settings[$key] ) ? $settings[$key] : $default;
    }
}

/**
 * Global helper function to access LTH Real Estate settings anywhere.
 */
if ( ! function_exists( 'lth_cfg' ) ) {
    function lth_cfg( $key, $default = null ) {
        return LTH_Real_Estate_Config::get( $key, $default );
    }
}
