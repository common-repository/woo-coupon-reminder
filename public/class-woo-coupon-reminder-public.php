<?php

defined( 'ABSPATH' ) || exit;
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://villatheme.com/
 * @since      1.0.0
 *
 * @package    Woo_Coupon_Reminder
 * @subpackage Woo_Coupon_Reminder/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woo_Coupon_Reminder
 * @subpackage Woo_Coupon_Reminder/public
 * @author     Villatheme
 */
class Woo_Coupon_Reminder_Public {
    
    /**
     * The ID of this plugin.
     *
     * @var      string $woo_coupon_reminder The ID of this plugin.
     * @since    1.0.0
     * @access   private
     */
    private $woo_coupon_reminder;
    
    /**
     * The version of this plugin.
     *
     * @var      string $version The current version of this plugin.
     * @since    1.0.0
     * @access   private
     */
    private $version;
    
    /**
     * Initialize the class and set its properties.
     *
     * @param string $woo_coupon_reminder The name of the plugin.
     * @param string $version             The version of this plugin.
     *
     * @since    1.0.0
     */
    public function __construct( $woo_coupon_reminder, $version ) {
        $this->woo_coupon_reminder = $woo_coupon_reminder;
        $this->version             = $version;
    }
    
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Woo_Coupon_Reminder_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Woo_Coupon_Reminder_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        
        wp_enqueue_style( $this->woo_coupon_reminder, plugin_dir_url( __FILE__ ) . 'css/woo-coupon-reminder-public.css', array(), $this->version, 'all' );
    }
    
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Woo_Coupon_Reminder_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Woo_Coupon_Reminder_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        
        wp_enqueue_script( $this->woo_coupon_reminder, plugin_dir_url( __FILE__ ) . 'js/woo-coupon-reminder-public.js', array( 'jquery' ), $this->version, false );
    }
    
    /**
     * Set session variable on page load if the query string has coupon_code variable.
     *
     * @return void
     */
    // phpcs:disable WordPress.Security.NonceVerification.Recommended
    public function viwcr_get_coupon_code_from_url_to_session() {
        if ( isset( $_GET['coupon_code'] ) && isset( $_GET['email_redirect'] ) && ( $_GET['email_redirect'] ) ) {
            $coupon_id = wc_get_coupon_id_by_code( wc_clean( $_GET['coupon_code'] ) );
            if ( $coupon_id ) {
                /*Add coupon code to session*/
                // Ensure that customer session is started
                if ( ! WC()->session->has_session() ) {
                    WC()->session->set_customer_session_cookie( true );
                }
                
                // Check and register coupon code in a custom session variable
                $coupon_code = WC()->session->get( 'viwcr_coupon_code' );
                if ( empty( $coupon_code )
                     && isset( $_GET['coupon_code'] ) ) {
                    $coupon_code = esc_attr( wc_clean( $_GET['coupon_code'] ) );
                    WC()->session->set( 'viwcr_coupon_code', $coupon_code ); // Set the coupon code in session
                }
                
                /*Tracking click open link from email*/ global $wpdb;
                $coupon_code_url = esc_attr( wc_clean( $_GET['coupon_code'] ) );
                
                $table_name = $wpdb->prefix . 'viwcr_statistics';
                $sql        = $wpdb->prepare( "SELECT coupon_tracking FROM {$table_name} WHERE coupon_title = %s;", $coupon_code_url ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
                
                $results = $wpdb->get_results( $sql, ARRAY_A ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL
                
                if ( count( $results ) > 0 ) {
                    $tracking = $results[0]['coupon_tracking'];
                    $sql      = $wpdb->prepare( "UPDATE {$table_name} SET coupon_tracking = %d WHERE coupon_title = %s;", $tracking + 1, $coupon_code_url ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
                    $wpdb->query( $sql ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL
                } else {
                    $data   = array(
                        'coupon_title'    => $coupon_code_url,
                        'coupon_tracking' => 1,
                        'status'          => '',
                    );
                    $format = array( '%s', '%d', '%s' );
                    $wpdb->insert( $table_name, $data, $format ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
                }
            }
        }
    }
    // phpcs:enable WordPress.Security.NonceVerification.Recommended
    
    /**
     * Apply Coupon code to the cart if the session has coupon_code variable.
     */
    function viwcr_auto_apply_discount_to_cart_from_url() {
        // Set coupon code
        $coupon_code = WC()->session->get( 'viwcr_coupon_code' );
        if ( ! empty( $coupon_code )
             && ! WC()->cart->has_discount( $coupon_code ) ) {
            WC()->cart->add_discount( $coupon_code ); // apply the coupon discount
            WC()->session->__unset( 'viwcr_coupon_code' ); // remove coupon code from session
        }
    }
    
}
