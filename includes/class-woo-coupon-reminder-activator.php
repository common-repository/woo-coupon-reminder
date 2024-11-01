<?php

defined( 'ABSPATH' ) || exit;

/**
 * Fired during plugin activation
 *
 * @link       https://villatheme.com/
 * @since      1.0.0
 *
 * @package    Woo_Coupon_Reminder
 * @subpackage Woo_Coupon_Reminder/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Woo_Coupon_Reminder
 * @subpackage Woo_Coupon_Reminder/includes
 * @author     Villatheme
 */
class Woo_Coupon_Reminder_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		self::create_db_schedule_mail();
	}

	public static function create_db_schedule_mail() {
		global $wpdb;
		$db_table_name   = $wpdb->prefix . 'viwcr_statistics';  // table name
		$charset_collate = $wpdb->get_charset_collate();
		$sql             = "CREATE TABLE IF NOT EXISTS $db_table_name (
                id int(11) NOT NULL auto_increment,
                coupon_title varchar(255) NOT NULL,
                coupon_tracking int(11) NOT NULL,
                status varchar(200) NOT NULL,
            
                UNIQUE KEY id (id)
        ) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

}
