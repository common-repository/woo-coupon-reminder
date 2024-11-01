<?php

defined( 'ABSPATH' ) || exit;
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://villatheme.com/
 * @since      1.0.0
 *
 * @package    Woo_Coupon_Reminder
 * @subpackage Woo_Coupon_Reminder/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woo_Coupon_Reminder
 * @subpackage Woo_Coupon_Reminder/includes
 * @author     Villatheme
 */
class Woo_Coupon_Reminder_i18n {
    
    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain( 'woo-coupon-reminder', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' );
        
        if ( class_exists( 'VillaTheme_Support' ) ) {
            new VillaTheme_Support( array(
                    'support'    => 'https://wordpress.org/support/plugin/woo-coupon-reminder/',
                    'docs'       => 'https://docs.villatheme.com/woocommerce-coupon-reminder/',
                    'review'     => 'https://wordpress.org/support/plugin/woo-coupon-reminder/reviews/?rate=5#rate-response',
                    'pro_url'    => '',
                    'css'        => WOO_COUPON_REMINDER_CSS,
                    'image'      => '',
                    'slug'       => 'woo-coupon-reminder',
                    'menu_slug'  => 'edit.php?post_type=viwcr_email_template',
                    'version'    => WOO_COUPON_REMINDER_VERSION,
                    'survey_url' => 'https://script.google.com/macros/s/AKfycbwjReGs2iNaqQdh1FczCj839RIVgE5dYe_xgLv0LvO1j-VKOSn_OvdLFN-pJppM072TBA/exec',
                ) );
        }
    }
    
}
