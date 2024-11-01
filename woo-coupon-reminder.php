<?php
/**
 * Plugin Name:          Coreem - Coupon Reminder for WooCommerce
 * Plugin URI:           https://villatheme.com/extensions/woocommerce-coupon-reminder/
 * Description:          The plugin's user-friendly design helps manage coupons, sends reminder emails, and encourages customers to use coupons before expiration.
 * Version:              2.1.3
 * Author:               VillaTheme
 * Author URI:           https://villatheme.com/
 * License:              GPLv2
 * License URI:          http://www.gnu.org/licenses/gpl-2.0
 * Text Domain:          woo-coupon-reminder
 * Copyright 2019-2024   VillaTheme.com. All rights reserved.
 * Requires Plugins:     woocommerce
 * Domain Path:          /languages
 * Requires at least:    5.0
 * Tested up to:         6.5
 * WC requires at least: 7.0
 * WC tested up to:      8.9
 * Requires PHP:         7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOO_COUPON_REMINDER_VERSION', '2.1.3' );
define( 'WOO_COUPON_REMINDER_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'WOO_COUPON_REMINDER_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'WOO_COUPON_REMINDER_CSS', WOO_COUPON_REMINDER_DIR_URL . 'assets/css/' );
define( 'WOO_COUPON_REMINDER_BASE_NAME', plugin_basename( __FILE__ ) );

//compatible with 'High-Performance order storage (COT)'
add_action( 'before_woocommerce_init', function() {
    if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
} );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-coupon-reminder-activator.php
 */
function activate_woo_coupon_reminder() {
    require_once WOO_COUPON_REMINDER_DIR_PATH . 'includes/class-woo-coupon-reminder-activator.php';
    Woo_Coupon_Reminder_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-coupon-reminder-deactivator.php
 */
function deactivate_woo_coupon_reminder() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-coupon-reminder-deactivator.php';
    Woo_Coupon_Reminder_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_coupon_reminder' );
register_deactivation_hook( __FILE__, 'deactivate_woo_coupon_reminder' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_coupon_reminder() {
	if ( ! class_exists( 'VillaTheme_Require_Environment' ) ) {
		include_once WOO_COUPON_REMINDER_DIR_PATH . 'includes/support.php';
	}
    $environment = new \VillaTheme_Require_Environment( [
            'plugin_name'     => 'Coreem - Coupon Reminder for WooCommerce',
            'php_version'     => '7.0',
            'wp_version'      => '5.0',
            'wc_version'      => '7.0',
            'require_plugins' => [
                [
                    'slug' => 'woocommerce',
                    'name' => 'WooCommerce',
                ],
            ],
        ] );
    
    if ( $environment->has_error() ) {
        return;
    }
    
    require plugin_dir_path( __FILE__ ) . 'includes/class-woo-coupon-reminder.php';

	if ( empty( get_option( 'coreem_actived', '' ) ) && ! wp_next_scheduled( 'viwcr_add_cron_every_day' ) ) {
		update_option( 'coreem_actived', 1 );
		$wordpress_timezone_string = wp_timezone_string();
		$date                      = new DateTime( 'today midnight', new DateTimeZone( $wordpress_timezone_string ) );
		$today_midnight            = $date->getTimestamp();

		wp_schedule_event( $today_midnight, 'daily', 'viwcr_add_cron_every_day' );
	}

    $plugin = new Woo_Coupon_Reminder();
    $plugin->run();
}

add_action( 'plugins_loaded', 'run_woo_coupon_reminder' );
