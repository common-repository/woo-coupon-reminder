<?php

defined( 'ABSPATH' ) || exit;
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://villatheme.com/
 * @since      1.0.0
 *
 * @package    Woo_Coupon_Reminder
 * @subpackage Woo_Coupon_Reminder/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Woo_Coupon_Reminder
 * @subpackage Woo_Coupon_Reminder/includes
 * @author     Villatheme
 */
class Woo_Coupon_Reminder {
    
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @var      Woo_Coupon_Reminder_Loader $loader Maintains and registers all hooks for the plugin.
     * @since    1.0.0
     * @access   protected
     */
    protected $loader;
    
    /**
     * The unique identifier of this plugin.
     *
     * @var      string $woo_coupon_reminder The string used to uniquely identify this plugin.
     * @since    1.0.0
     * @access   protected
     */
    protected $woo_coupon_reminder;
    
    /**
     * The current version of the plugin.
     *
     * @var      string $version The current version of the plugin.
     * @since    1.0.0
     * @access   protected
     */
    protected $version;
    
    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {
        if ( defined( 'WOO_COUPON_REMINDER_VERSION' ) ) {
            $this->version = WOO_COUPON_REMINDER_VERSION;
        } else {
            $this->version = '2.0.0';
        }
        $this->woo_coupon_reminder = 'woo-coupon-reminder';
        
        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }
    
    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Woo_Coupon_Reminder_Loader. Orchestrates the hooks of the plugin.
     * - Woo_Coupon_Reminder_i18n. Defines internationalization functionality.
     * - Woo_Coupon_Reminder_Admin. Defines all hooks for the admin area.
     * - Woo_Coupon_Reminder_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woo-coupon-reminder-loader.php';
        
        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woo-coupon-reminder-i18n.php';
        
        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woo-coupon-reminder-admin.php';
        
        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-woo-coupon-reminder-public.php';
        
        $this->loader = new Woo_Coupon_Reminder_Loader();
    }
    
    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Woo_Coupon_Reminder_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {
        $plugin_i18n = new Woo_Coupon_Reminder_i18n();
        
        $plugin_i18n->load_plugin_textdomain();
    }
    
    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {
        $plugin_admin = new Woo_Coupon_Reminder_Admin( $this->get_woo_coupon_reminder(), $this->get_version() );
        
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        
        $this->loader->add_action( 'admin_notices', $plugin_admin, 'clear_old_version_admin_notice' );
        $this->loader->add_action( 'init', $plugin_admin, 'viwcr_register_post_type' );
        $this->loader->add_filter( 'plugin_action_links_' . WOO_COUPON_REMINDER_BASE_NAME, $plugin_admin, 'viwcr_add_action_links' );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'remove_add_new_email_template' );
        $this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'viwcr_email_template_meta_box' );
        $this->loader->add_action( 'save_post_viwcr_email_template', $plugin_admin, 'viwcr_save_email_template', 10, 2 );
        //        $this->loader->add_action( 'manage_posts_extra_tablenav', $plugin_admin,'addCustomUpdateButton'  );
        
        $this->loader->add_action( 'wp_ajax_scan_coupons', $plugin_admin, 'scan_coupons' );
        $this->loader->add_action( 'wp_ajax_nopriv_scan_coupons', $plugin_admin, 'scan_coupons' );
        
        $this->loader->add_action( 'wp_ajax_update_schedule_data_coupon', $plugin_admin, 'update_schedule_data_coupon' );
        $this->loader->add_action( 'wp_ajax_nopriv_update_schedule_data_coupon', $plugin_admin, 'update_schedule_data_coupon' );
        
        $this->loader->add_action( 'viwcr_add_cron_every_day', $plugin_admin, 'viwcr_add_cron_every_day' );
        $this->loader->add_action( 'action_viwcr_send_schedule_mail', $plugin_admin, 'viwcr_send_schedule_mail' );
        
        //        $this->loader->add_action( 'woocommerce_coupon_options_save', $plugin_admin, 'viwcr_action_woocommerce_coupon_options_save' , 10, 2);
        
        $this->loader->add_filter( 'manage_viwcr_email_template_posts_columns', $plugin_admin, 'custom_viwcr_email_template_columns', 20, 1 );
        $this->loader->add_action( 'manage_viwcr_email_template_posts_custom_column', $plugin_admin, 'show_viwcr_email_template_columns', 20, 1 );
        /*preview email*/
        $this->loader->add_action( 'media_buttons', $plugin_admin, 'add_preview_emails_button' );
        $this->loader->add_action( 'admin_footer', $plugin_admin, 'render_preview_emails_html' );
        $this->loader->add_action( 'wp_ajax_preview_emails_ajax', $plugin_admin, 'preview_emails_ajax' );
        $this->loader->add_action( 'wp_ajax_nopriv_preview_emails_ajax', $plugin_admin, 'preview_emails_ajax' );
        
        $this->loader->add_action( 'wp_ajax_action_ajax_enable_email', $plugin_admin, 'action_ajax_enable_email' );
        $this->loader->add_action( 'wp_ajax_nopriv_action_ajax_enable_email', $plugin_admin, 'action_ajax_enable_email' );
        
        /*Edit shop coupon*/
        $this->loader->add_filter( 'views_edit-shop_coupon', $plugin_admin, 'filter_email_template' );
        
        $this->loader->add_filter( 'manage_shop_coupon_posts_columns', $plugin_admin, 'custom_coupon_columns', 20, 1 );
        $this->loader->add_action( 'manage_shop_coupon_posts_custom_column', $plugin_admin, 'show_coupon_columns', 20, 1 );
        
        $this->loader->add_action( 'load-edit.php', $plugin_admin, 'viwcr_add_extensions' );
        $this->loader->add_action( 'woocommerce_after_data_object_save', $plugin_admin, 'viwcr_action_update_schedule_woocommerce_coupon_save' );
        
        $this->loader->add_filter( 'post_row_actions', $plugin_admin, 'viwcr_duplicate_email_link', 20, 2 );
        $this->loader->add_action( 'admin_action_viwcr_duplicate_email_as_draft', $plugin_admin, 'viwcr_duplicate_email_as_draft' );
        
        /*Clear all old data and action scheduled*/
        $this->loader->add_action( 'admin_init', $plugin_admin, 'viwcr_clear_old_version_data' );
        
        /*Compatible with email customize*/
        $this->loader->add_filter( 'viwec_register_email_type', $plugin_admin, 'viwcr_register_email_type' );
        $this->loader->add_filter( 'viwec_sample_subjects', $plugin_admin, 'viwcr_register_email_sample_subject' );
        $this->loader->add_filter( 'viwec_sample_templates', $plugin_admin, 'viwcr_register_email_sample_template' );
        $this->loader->add_filter( 'viwec_live_edit_shortcodes', $plugin_admin, 'viwcr_register_render_preview_shortcode' );
        $this->loader->add_filter( 'viwec_register_preview_shortcode', $plugin_admin, 'viwcr_register_render_preview_shortcode' );
    }
    
    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {
        $plugin_public = new Woo_Coupon_Reminder_Public( $this->get_woo_coupon_reminder(), $this->get_version() );
        
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
        
        $this->loader->add_action( 'init', $plugin_public, 'viwcr_get_coupon_code_from_url_to_session' );
        $this->loader->add_action( 'woocommerce_before_cart', $plugin_public, 'viwcr_auto_apply_discount_to_cart_from_url' );
        $this->loader->add_action( 'woocommerce_before_mini_cart', $plugin_public, 'viwcr_auto_apply_discount_to_cart_from_url' );
        $this->loader->add_action( 'woocommerce_before_checkout_form', $plugin_public, 'viwcr_auto_apply_discount_to_cart_from_url' );
    }
    
    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }
    
    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @return    string    The name of the plugin.
     * @since     1.0.0
     */
    public function get_woo_coupon_reminder() {
        return $this->woo_coupon_reminder;
    }
    
    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @return    Woo_Coupon_Reminder_Loader    Orchestrates the hooks of the plugin.
     * @since     1.0.0
     */
    public function get_loader() {
        return $this->loader;
    }
    
    /**
     * Retrieve the version number of the plugin.
     *
     * @return    string    The version number of the plugin.
     * @since     1.0.0
     */
    public function get_version() {
        return $this->version;
    }
    
}
