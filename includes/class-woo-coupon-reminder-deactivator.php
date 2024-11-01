<?php

defined( 'ABSPATH' ) || exit;
/**
 * Fired during plugin deactivation
 *
 * @link       https://villatheme.com/
 * @since      1.0.0
 *
 * @package    Woo_Coupon_Reminder
 * @subpackage Woo_Coupon_Reminder/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Woo_Coupon_Reminder
 * @subpackage Woo_Coupon_Reminder/includes
 * @author     Villatheme
 */
class Woo_Coupon_Reminder_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		delete_option( 'coreem_actived' );
        wp_clear_scheduled_hook( 'viwcr_add_cron_every_day' );
	}

}
