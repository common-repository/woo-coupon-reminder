<?php

defined( 'ABSPATH' ) || exit;
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://villatheme.com/
 * @since      1.0.0
 *
 * @package    Woo_Coupon_Reminder
 * @subpackage Woo_Coupon_Reminder/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_Coupon_Reminder
 * @subpackage Woo_Coupon_Reminder/admin
 * @author     Villatheme
 */
class Woo_Coupon_Reminder_Admin {
    
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
     * @param string $woo_coupon_reminder The name of this plugin.
     * @param string $version             The version of this plugin.
     *
     * @since    1.0.0
     */
    public function __construct( $woo_coupon_reminder, $version ) {
        $this->woo_coupon_reminder = $woo_coupon_reminder;
        $this->version             = $version;
        //Action hide notices
        if ( isset( $_GET['viwcr_dismiss_notices'] ) && $_GET['viwcr_dismiss_notices'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            update_option( 'viwcr_dismiss_notices', true );
        }
    }
    
    /**
     * Register the stylesheets for the admin area.
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
        
        $current_screen = get_current_screen()->id;
        if ( ( $current_screen == 'viwcr_email_template' )
             || ( $current_screen == 'edit-viwcr_email_template' )
             || ( $current_screen == 'viwcr_email_template_page_viwcr_statistics_email' )
             || ( $current_screen == 'viwcr_email_template_page_viwcr_scheduled_email' )
             || ( $current_screen == 'edit-shop_coupon' )
             || ( $current_screen == 'shop_coupon' ) ) {
            wp_enqueue_style( $this->woo_coupon_reminder . '-button', WOO_COUPON_REMINDER_DIR_URL . 'assets/css/button.min.css', array(), $this->version, 'all' );
            wp_enqueue_style( $this->woo_coupon_reminder . '-checkbox', WOO_COUPON_REMINDER_DIR_URL . 'assets/css/checkbox.min.css', array(), $this->version, 'all' );
            wp_enqueue_style( $this->woo_coupon_reminder . '-dropdown', WOO_COUPON_REMINDER_DIR_URL . 'assets/css/dropdown.min.css', array(), $this->version, 'all' );
            wp_enqueue_style( $this->woo_coupon_reminder . '-form', WOO_COUPON_REMINDER_DIR_URL . 'assets/css/form.min.css', array(), $this->version, 'all' );
            wp_enqueue_style( $this->woo_coupon_reminder . '-grid', WOO_COUPON_REMINDER_DIR_URL . 'assets/css/grid.min.css', array(), $this->version, 'all' );
            wp_enqueue_style( $this->woo_coupon_reminder . '-icon', WOO_COUPON_REMINDER_DIR_URL . 'assets/css/icon.min.css', array(), $this->version, 'all' );
            wp_enqueue_style( $this->woo_coupon_reminder . '-input', WOO_COUPON_REMINDER_DIR_URL . 'assets/css/input.min.css', array(), $this->version, 'all' );
            wp_enqueue_style( $this->woo_coupon_reminder . '-progress', WOO_COUPON_REMINDER_DIR_URL . 'assets/css/progress.min.css', array(), $this->version, 'all' );
            wp_enqueue_style( $this->woo_coupon_reminder . '-label', WOO_COUPON_REMINDER_DIR_URL . 'assets/css/label.min.css', array(), $this->version, 'all' );
            wp_enqueue_style( $this->woo_coupon_reminder . '-segment', WOO_COUPON_REMINDER_DIR_URL . 'assets/css/segment.min.css', array(), $this->version, 'all' );
            wp_enqueue_style( $this->woo_coupon_reminder . '-table', WOO_COUPON_REMINDER_DIR_URL . 'assets/css/table.min.css', array(), $this->version, 'all' );
            wp_enqueue_style( $this->woo_coupon_reminder . '-transition', WOO_COUPON_REMINDER_DIR_URL . 'assets/css/transition.min.css', array(), $this->version, 'all' );
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style( $this->woo_coupon_reminder . '-style', WOO_COUPON_REMINDER_DIR_URL . 'admin/css/woo-coupon-reminder-admin.css', array(), $this->version, 'all' );
        }
    }
    
    /**
     * Register the JavaScript for the admin area.
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
        $current_screen = get_current_screen()->id;
        if ( ( $current_screen == 'viwcr_email_template' )
             || ( $current_screen == 'edit-viwcr_email_template' )
             || ( $current_screen == 'viwcr_email_template_page_viwcr_statistics_email' )
             || ( $current_screen == 'viwcr_email_template_page_viwcr_scheduled_email' )
             || ( $current_screen == 'shop_coupon' )
             || ( $current_screen == 'edit-shop_coupon' ) ) {
            wp_enqueue_script( $this->woo_coupon_reminder . '-js-checkbox', WOO_COUPON_REMINDER_DIR_URL . 'assets/js/checkbox.js', array(), $this->version, 'all' );
            wp_enqueue_script( $this->woo_coupon_reminder . '-js-dropdown', WOO_COUPON_REMINDER_DIR_URL . 'assets/js/dropdown.min.js', array(), $this->version, 'all' );
            wp_enqueue_script( $this->woo_coupon_reminder . '-js-progress', WOO_COUPON_REMINDER_DIR_URL . 'assets/js/progress.min.js', array(), $this->version, 'all' );
            wp_enqueue_script( $this->woo_coupon_reminder . '-js-transition', WOO_COUPON_REMINDER_DIR_URL . 'assets/js/transition.min.js', array(), $this->version, 'all' );
            wp_enqueue_script( 'wp-color-picker' );
            wp_enqueue_script( $this->woo_coupon_reminder . '-script', WOO_COUPON_REMINDER_DIR_URL . 'admin/js/woo-coupon-reminder-admin.js', array( 'jquery' ), $this->version, false );
            wp_localize_script( $this->woo_coupon_reminder . '-script', 'viwcr_ajax', array( 'ajax' => admin_url( "admin-ajax.php" ), 'nonce' => wp_create_nonce( 'viwcr_nonce' ) ) );
        }
    }
    
    public function clear_old_version_admin_notice() {
        $dismiss = ! empty( get_option( 'viwcr_dismiss_notices' ) ) ? get_option( 'viwcr_dismiss_notices' ) : false;
        
        if ( ! $dismiss ) {
            ?>
            <div class="notice notice-warning is-dismissible villatheme-dashboard">
                <div class="villatheme-content">
                    <h3><?php esc_html_e( 'Coreem - Coupon Reminder for Woo', 'woo-coupon-reminder' ); ?></h3>
                    <p><?php esc_html_e( 'All initial settings of this plugin will be removed and invalid for outdated versions before version 2.0.', 'woo-coupon-reminder' ); ?></p>
                    <a target="_self"
                       href="<?php echo esc_attr( add_query_arg( array( 'viwcr_dismiss_notices' => 1 ) ) ); ?>"
                       class="button notice-dismiss vi-button-dismiss"><?php esc_html_e( 'Dismiss', 'woo-coupon-reminder' ) ?></a>
                </div>
            </div>
            <?php
        }
    }
    
    function viwcr_add_action_links( $links ) {
        $settings_link = array(
            '<a href="' . admin_url( 'edit.php?post_type=viwcr_email_template' ) . '">' . esc_html__( 'Email Templates', 'woo-coupon-reminder' ) . '</a>',
        );
        
        return array_merge( $links, $settings_link );
    }
    
    function viwcr_add_extensions() {
        $current_screen = get_current_screen()->id;
        // Only edit post screen:
        if ( $current_screen == 'edit-viwcr_email_template' ) {
            add_action( 'in_admin_footer', function() {
                do_action( 'villatheme_support_woo-coupon-reminder' );
            } );
        }
    }
    
    /**
     * Register Custom Post Type for the admin area.
     *
     * @since    1.0.0
     */
    public function viwcr_register_post_type() {
        /*
         * Post type Coupon Reminders Email Template
         *
         */
        $labels = array(
            'name'                  => esc_html__( 'Email templates', 'woo-coupon-reminder' ),
            'singular_name'         => esc_html__( 'Email templates', 'woo-coupon-reminder' ),
            'menu_name'             => esc_html__( 'Coupon Reminder', 'woo-coupon-reminder' ),
            'name_admin_bar'        => esc_html__( 'Coupon Reminder', 'woo-coupon-reminder' ),
            'archives'              => esc_html__( 'Email Archives', 'woo-coupon-reminder' ),
            'attributes'            => esc_html__( 'Email Attributes', 'woo-coupon-reminder' ),
            'parent_item_colon'     => esc_html__( 'Parent Email:', 'woo-coupon-reminder' ),
            'all_items'             => esc_html__( 'Email Templates', 'woo-coupon-reminder' ),
            'add_new_item'          => esc_html__( 'Add New Email', 'woo-coupon-reminder' ),
            'add_new'               => esc_html__( 'Add New', 'woo-coupon-reminder' ),
            'new_item'              => esc_html__( 'New Email', 'woo-coupon-reminder' ),
            'edit_item'             => esc_html__( 'Edit Email', 'woo-coupon-reminder' ),
            'update_item'           => esc_html__( 'Update Email', 'woo-coupon-reminder' ),
            'view_item'             => esc_html__( 'View Email', 'woo-coupon-reminder' ),
            'view_items'            => esc_html__( 'View Emails', 'woo-coupon-reminder' ),
            'search_items'          => esc_html__( 'Search Email', 'woo-coupon-reminder' ),
            'not_found'             => esc_html__( 'Not found', 'woo-coupon-reminder' ),
            'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'woo-coupon-reminder' ),
            'featured_image'        => esc_html__( 'Featured Image', 'woo-coupon-reminder' ),
            'set_featured_image'    => esc_html__( 'Set featured image', 'woo-coupon-reminder' ),
            'remove_featured_image' => esc_html__( 'Remove featured image', 'woo-coupon-reminder' ),
            'use_featured_image'    => esc_html__( 'Use as featured image', 'woo-coupon-reminder' ),
            'insert_into_item'      => esc_html__( 'Insert item', 'woo-coupon-reminder' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'woo-coupon-reminder' ),
            'items_list'            => esc_html__( 'Emails list', 'woo-coupon-reminder' ),
            'items_list_navigation' => esc_html__( 'Emails list navigation', 'woo-coupon-reminder' ),
            'filter_items_list'     => esc_html__( 'Filter items list', 'woo-coupon-reminder' ),
        );
        $args   = array(
            'labels'              => $labels,
            'description'         => esc_html__( 'Coupon Email Reminder for WooCommerce', 'woo-coupon-reminder' ),
            'supports'            => array(
                'title',
                'revisions',
            ),
            'taxonomies'          => array( '' ),
            'hierarchical'        => false,
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => false,
            'show_in_admin_bar'   => false,
            'menu_position'       => 6,
            'menu_icon'           => 'dashicons-email-alt',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
        
        );
        
        register_post_type( 'viwcr_email_template', $args );
    }
    
    public function remove_add_new_email_template() {
        remove_submenu_page( 'edit.php?post_type=viwcr_email_template', 'post-new.php?post_type=viwcr_email_template' );
        add_submenu_page( 'edit.php?post_type=viwcr_email_template', esc_html__( 'Scheduled email', 'woo-coupon-reminder' ), esc_html__( 'Scheduled email', 'woo-coupon-reminder' ), 'manage_options', 'viwcr_scheduled_email', array( $this, 'viwcr_scheduled_email' ), 2 );
        add_submenu_page( 'edit.php?post_type=viwcr_email_template', esc_html__( 'Statistics email', 'woo-coupon-reminder' ), esc_html__( 'Statistics email', 'woo-coupon-reminder' ), 'manage_options', 'viwcr_statistics_email', array( $this, 'viwcr_statistics_email' ), 3 );
    }
    
    public function viwcr_scheduled_email() {
        echo '<div class="wrap">';
        echo '<h1 class="wp-heading-inline">' . esc_html__( 'Scheduled email', 'woo-coupon-reminder' ) . '</h1>';
        
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/woo-coupon-reminder-schedule.php';
        $schedule_list_table = new VIWCR_Schedule_List_Table();
        $schedule_list_table->prepare_items();
        $schedule_list_table->display();
        do_action( 'villatheme_support_woo-coupon-reminder' );
        echo '</div>';
    }
    
    public function viwcr_statistics_email() {
        echo '<div class="wrap">';
        echo '<h1 class="wp-heading-inline">' . esc_html__( 'Statistics email', 'woo-coupon-reminder' ) . '</h1>';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/woo-coupon-reminder-statistics.php';
        $statistics_list_table = new VIWCR_Statistics_List_Table();
        $statistics_list_table->prepare_items();
        $statistics_list_table->display();
        do_action( 'villatheme_support_woo-coupon-reminder' );
        echo '</div>';
    }
    
    /**
     * Function Register metabox to detail Filter Block.
     *
     * @since    1.0.0
     */
    public function viwcr_email_template_meta_box() {
        add_meta_box( 'viwcr_email_template_meta_box', esc_html__( 'Email field template', 'woo-coupon-reminder' ), array(
            $this,
            'viwcr_detail_email_template',
        ), 'viwcr_email_template', 'normal', 'high' );
    }
    
    /**
     * Function callback Add metabox to detail filter block
     *
     * @since    1.0.0
     */
    public function viwcr_detail_email_template( $post ) {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/display-detail-email-template-page.php';
    }
    
    /**
     * Function save meta data of detail Filter Menu
     *
     * @param $post_id
     * @param $post
     *
     * @return void
     * @since    1.0.0
     *
     */
    
    public function viwcr_save_email_template( $post_id, $post ) {
        if ( ! current_user_can( "edit_post", $post_id ) ) {
            return $post_id;
        }
        if ( defined( "DOING_AUTOSAVE" ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        
        if ( isset( $_POST['_viwcr_save_email_template'] ) ) {
            $viwcr_email_template_nonce = sanitize_text_field( $_POST['_viwcr_save_email_template'] );
            if ( ! isset( $viwcr_email_template_nonce ) ) {
                return;
            }
            if ( ! wp_verify_nonce( $viwcr_email_template_nonce, 'viwcr_save_email_template' ) ) {
                return;
            }
        } else {
            return;
        }
        
        $viwcr_email_enable = isset( $_POST['viwcr-enable_template'] ) ? 'on' : 'off';
        
        $viwcr_number_expiry         = isset( $_POST['viwcr-number_expiry'] ) ? sanitize_text_field( $_POST['viwcr-number_expiry'] ) : ( '1' );
        $viwcr_unit_expiry           = isset( $_POST['viwcr-unit_expiry'] ) ? sanitize_text_field( $_POST['viwcr-unit_expiry'] ) : ( 'days' );
        $viwcr_email_subject         = isset( $_POST['viwcr-email_subject'] ) ? stripslashes( sanitize_text_field( $_POST['viwcr-email_subject'] ) ) : '';
        $viwcr_email_header          = isset( $_POST['viwcr-email_header'] ) ? stripslashes( sanitize_text_field( $_POST['viwcr-email_header'] ) ) : '';
        $viwcr_email_content         = isset( $_POST['viwcr-email_content'] ) ? wp_kses_post( $_POST['viwcr-email_content'] ) : '';
        $viwcr_email_content_replace = isset( $_POST['viwcr-email_content_replace'] ) ? wp_kses_post( $_POST['viwcr-email_content_replace'] ) : 'template_none';
        
        $viwcr_button_title      = isset( $_POST['viwcr-button_title'] ) ? sanitize_text_field( $_POST['viwcr-button_title'] ) : '';
        $viwcr_button_url        = isset( $_POST['viwcr-button_url'] ) ? sanitize_url( $_POST['viwcr-button_url'] ) : '';
        $viwcr_button_font_size  = isset( $_POST['viwcr-button_font_size'] ) ? sanitize_text_field( $_POST['viwcr-button_font_size'] ) : ( '16' );
        $viwcr_button_color      = isset( $_POST['viwcr-button_color '] ) ? sanitize_hex_color( $_POST['viwcr-button_color'] ) : ( '#ffffff' );
        $viwcr_button_background = isset( $_POST['viwcr-button_background'] ) ? sanitize_hex_color( $_POST['viwcr-button_background'] ) : ( '#000000' );
        
        $viwcr_email_setting = array(
            'viwcr_number_expiry'         => $viwcr_number_expiry,
            'viwcr_unit_expiry'           => $viwcr_unit_expiry,
            'viwcr_email_subject'         => $viwcr_email_subject,
            'viwcr_email_header'          => $viwcr_email_header,
            'viwcr_email_content'         => $viwcr_email_content,
            'viwcr_email_content_replace' => $viwcr_email_content_replace,
            'viwcr_button_title'          => $viwcr_button_title,
            'viwcr_button_url'            => $viwcr_button_url,
            'viwcr_button_font_size'      => $viwcr_button_font_size,
            'viwcr_button_color'          => $viwcr_button_color,
            'viwcr_button_background'     => $viwcr_button_background,
        );
        update_post_meta( $post_id, "viwcr_email_enable", $viwcr_email_enable );
        update_post_meta( $post_id, "viwcr_email_setting", $viwcr_email_setting );
    }
    
    /**
     * Adds "Update" button on coupon list page
     */
    public function addCustomUpdateButton( $which ) {
        global $typenow;
        // Not our post type, exit earlier
        // You can remove this if condition if you don't have any specific post type to restrict to.
        if ( 'viwcr_email_template' === $typenow && 'top' === $which ) {
            ?>
            <div class="alignleft actions custom">
                <a href="#" id="viwcr_btn_update_email_data" class="vi-ui button mini primary labeled icon">
                    <i class="send icon"></i>
                    <?php
                    esc_html_e( 'Scan coupons', 'woo-coupon-reminder' );
                    ?>
                </a>
            
            </div>
            <?php
        }
    }
    
    /**
     * Adds more button in list filter on coupon list page
     *
     * @param $views
     *
     * @return array
     */
    public function filter_email_template( $views ) {
        $views['import'] = '<a href="#" class="primary">' . esc_html__( 'Template', 'woo-coupon-reminder' ) . '</a>';
        
        return $views;
    }
    
    /**
     * Get all valid coupons
     */
    public static function scan_coupons() {
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['nonce'] ), 'viwcr_nonce' ) ) {
            return;
        }
        $arr_coupons   = array();
        $args          = array(
            'posts_per_page' => - 1, //show all posts
            'post_type'      => 'shop_coupon', //custom post type
            'post_status'    => 'publish', //published coupons only,
        );
        $query_coupons = new WP_Query( $args );
        // The Loop
        if ( $query_coupons->have_posts() ) :
            while ( $query_coupons->have_posts() ) : $query_coupons->the_post();
                if ( class_exists( 'WC_Coupon' ) ) {
                    $coupon_obj           = new WC_Coupon( get_the_title() );
                    $expiry_date          = $coupon_obj->get_date_expires();
                    $usage_limit          = $coupon_obj->get_usage_limit();
                    $usage_limit_per_user = $coupon_obj->get_usage_limit_per_user();
                    $usage_count          = $coupon_obj->get_usage_count();
                    $email_restrictions   = $coupon_obj->get_email_restrictions();
                    
                    if ( ( ! $email_restrictions )
                         || ( count( $email_restrictions ) <= 0 ) ) {
                        continue;
                    }
                    if ( $usage_limit > 0 ) {
                        if ( ( $usage_limit - $usage_count ) <= 0 ) {
                            continue;
                        }
                    }
                    if ( $expiry_date ) {
                        /*$timezone            = $expiry_date->getTimezone(); // get timezone*/
                        $timezone = wp_timezone(); // get timezone
                        
                        $expiry_datetime_Obj = new WC_DateTime( $expiry_date->date( 'Y-m-d' ) );
                        $now_datetime        = current_time( 'U' );
                        
                        //                        $expiry_datetime = gmdate( 'Y-m-d H:m:s', $expiry_datetime_Obj->getTimestamp() );
                        
                        if ( $now_datetime < $expiry_datetime_Obj->getTimestamp() ) {
                            array_push( $arr_coupons, array(
                                'coupon_id'                 => get_the_ID(),
                                'coupon_code'               => get_the_title(),
                                'coupon_expires'            => $expiry_datetime_Obj->getTimestamp(),
                                'coupon_email_restrictions' => $email_restrictions,
                                'time_expiry'               => $expiry_datetime_Obj->getTimestamp(),
                            ) );
                        }
                    }
                }
            endwhile;
        endif;
        wp_reset_postdata();
        
        update_option( 'viwrc_schedule_coupon', $arr_coupons );
        
        $result = array(
            'status' => 'successed',
            'count'  => count( $arr_coupons ),
        );
        
        wp_send_json( $result );
        
        die();
    }
    
    /*
    * Ajax update schedule data for each coupon
    */
    public function update_schedule_data_coupon() {
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['nonce'] ), 'viwcr_nonce' ) ) {
            return;
        }
        $offset = isset( $_POST['offset'] ) ? wc_clean( absint( $_POST['offset'] ) ) : 0;
        
        $arr_coupon       = get_option( 'viwrc_schedule_coupon' ) ? wc_clean( get_option( 'viwrc_schedule_coupon' ) ) : array();
        $count_arr_coupon = count( $arr_coupon );
        $result           = array();
        if ( ! is_array( $arr_coupon )
             && ( $count_arr_coupon > 0 ) ) {
            $result = array(
                'offset' => 'done',
                'status' => 'arr_coupon error',
            );
            wp_send_json( $result );
            die();
        }
        
        if ( $offset < $count_arr_coupon ) {
            $data_meta_all_schedule_email    = array();
            $data_meta_detail_schedule_email = array();
            $coupon_Obj                      = array();
            $coupon_data                     = $arr_coupon[ $offset ];
            $coupon_code                     = $coupon_data['coupon_code'];
            $coupon_id                       = $coupon_data['coupon_id'];
            $coupon_expiry                   = $coupon_data['coupon_expires'];
            $coupon_email_restrictions       = $coupon_data['coupon_email_restrictions'];
            $data_email_template             = $this->get_email_template_data( $coupon_expiry );
            if ( count( $data_email_template ) > 0 ) {
                if ( class_exists( 'WC_Coupon' ) ) {
                    $coupon_Obj = new WC_Coupon( $coupon_code );
                    foreach ( $data_email_template as $data ) {
                        $data_meta_all_schedule_email[]                                = $data['id_email_template'];
                        $data_meta_detail_schedule_email[ $data['id_email_template'] ] = array(
                            'time_send'       => $data['email_scheduling_time'],
                            'email'           => $coupon_email_restrictions,
                            'schedule_status' => false,
                        );
                    }
                }
                update_post_meta( $coupon_id, 'schedule_email_reminder', $data_meta_all_schedule_email );
                update_post_meta( $coupon_id, 'detail_schedule_email_reminder', $data_meta_detail_schedule_email );
                $offset ++;
                $result = array(
                    'offset' => $offset,
                    
                    'data_meta_all_schedule_email'    => $data_meta_all_schedule_email,
                    'data_meta_detail_schedule_email' => $data_meta_detail_schedule_email,
                );
            } else {
                $result = array(
                    'offset' => 'done',
                    'status' => 'Not found email template',
                );
            }
        } else {
            do_action( 'viwcr_add_cron_every_day' );
            $result = array(
                'offset' => 'done',
            );
        }
        wp_send_json( $result );
        die();
    }
    
    /*
    *
    * Check and get all email reminder template ids
    *
    * @param  $time_expiry  time expiry of coupon
    * @return array
    */
    public static function get_email_template_data( $time_expiry ) {
        $arr_email_template = array();
        if ( empty( $time_expiry ) ) {
            return array();
        }
        $args        = array(
            'posts_per_page' => - 1, //show all posts
            'post_type'      => 'viwcr_email_template', //custom post type
            'post_status'    => 'publish', //published template only,
        );
        $query_email = new WP_Query( $args );
        // The Loop
        if ( $query_email->have_posts() ) :
            while ( $query_email->have_posts() ) : $query_email->the_post();
                $viwcr_email_enable = get_post_meta( get_the_ID(), 'viwcr_email_enable', true );
                if ( $viwcr_email_enable === 'on' ) {
                    $viwcr_email_setting = get_post_meta( get_the_ID(), 'viwcr_email_setting', true );
                    $now_datetime_Obj    = new WC_DateTime();
                    $now_Timestamp       = current_time( 'U' );
                    //                    wp_send_json( array( 'now' => $now_Timestamp, 'expiry' => $time_expiry));
                    if ( isset( $viwcr_email_setting ) && is_array( $viwcr_email_setting ) ) {
                        $viwcr_number_expiry = $viwcr_email_setting['viwcr_number_expiry'];
                        $viwcr_unit_expiry   = $viwcr_email_setting['viwcr_unit_expiry'];
                        switch ( $viwcr_unit_expiry ) {
                            case 'days':
                                $scheduleEmailTime = $viwcr_number_expiry * 24 * 60 * 60;
                                break;
                            case 'hours':
                                $scheduleEmailTime = $viwcr_number_expiry * 60 * 60;
                                break;
                            case 'minutes':
                                $scheduleEmailTime = $viwcr_number_expiry * 60;
                                break;
                            default:
                                $scheduleEmailTime = 0;
                                break;
                        }
                        $scheduleCouponEmailTime = $time_expiry - $scheduleEmailTime;
                        if ( $now_Timestamp < $scheduleCouponEmailTime ) {
                            $wordpress_timezone_string = wp_timezone_string();
                            $scheduleCouponEmailTime   = new DateTime( gmdate( 'Y-m-d H:i:s', $scheduleCouponEmailTime ), new DateTimeZone( $wordpress_timezone_string ) );
                            
                            array_push( $arr_email_template, array(
                                'id_email_template'     => get_the_ID(),
                                'email_scheduling_time' => $scheduleCouponEmailTime->getTimestamp(),
                            ) );
                        }
                    }
                }
            endwhile;
        endif;
        wp_reset_postdata();
        
        return $arr_email_template;
    }
    
    /*
    *
    * Run schedule event every day in 0:00 AM
    *
    *Hook name: viwcr_add_cron_every_day
    */
    public function viwcr_add_cron_every_day() {
        wp_unschedule_hook( 'action_viwcr_send_schedule_mail' );
        
        $wordpress_timezone_string = wp_timezone_string();
        
        $today_midnight_Obj = new DateTime( 'today midnight', new DateTimeZone( $wordpress_timezone_string ) );
        
        $today_midnight = $today_midnight_Obj->getTimestamp();
        /*$today_midnight = strtotime('today midnight');*/
        $day_to_seconds           = 86400;
        $tomorrow_midnight        = absint( $today_midnight ) + absint( $day_to_seconds );
        $arr_schedule_event_today = array();
        
        $viwcr_arr_coupon = get_option( 'viwrc_schedule_coupon' );
        if ( is_array( $viwcr_arr_coupon )
             && ( count( $viwcr_arr_coupon ) > 0 ) ) {
            foreach ( $viwcr_arr_coupon as $key => $coupon_item ) {
                if ( class_exists( 'WC_Coupon' ) ) {
                    $coupon_obj           = new WC_Coupon( $coupon_item['coupon_code'] );
                    $expiry_date          = $coupon_obj->get_date_expires();
                    $usage_limit          = $coupon_obj->get_usage_limit();
                    $usage_limit_per_user = $coupon_obj->get_usage_limit_per_user();
                    $usage_count          = $coupon_obj->get_usage_count();
                    $email_restrictions   = $coupon_obj->get_email_restrictions();
                    
                    if ( ( ! $email_restrictions )
                         || ( count( $email_restrictions ) <= 0 )
                         || ( ( $usage_limit > 0 )
                              && ( ( $usage_limit - $usage_count ) <= 0 ) )
                         || ! $expiry_date ) {
                        unset( $viwcr_arr_coupon[ $key ] );
                        $viwcr_arr_coupon = array_values( $viwcr_arr_coupon );
                    }
                    
                    if ( $expiry_date ) {
                        $timezone            = $expiry_date->getTimezone(); // get timezone
                        $expiry_datetime_Obj = new WC_DateTime( $expiry_date->date( 'Y-m-d' ) );
                        $now_datetime        = current_time( 'U' );
                        
                        if ( $now_datetime >= $expiry_datetime_Obj->getTimestamp() ) {
                            unset( $viwcr_arr_coupon[ $key ] );
                            $viwcr_arr_coupon = array_values( $viwcr_arr_coupon );
                        }
                    }
                }
            }
        }
        update_option( 'viwrc_schedule_coupon', $viwcr_arr_coupon );
        if ( is_array( $viwcr_arr_coupon )
             && ( count( $viwcr_arr_coupon ) > 0 ) ) {
            foreach ( $viwcr_arr_coupon as $coupon_item ) {
                $coupon_id                      = $coupon_item['coupon_id'];
                $coupon_code                    = $coupon_item['coupon_code'];
                $schedule_email_reminder        = get_post_meta( $coupon_id, 'schedule_email_reminder', true );
                $detail_schedule_email_reminder = get_post_meta( $coupon_id, 'detail_schedule_email_reminder', true );
                if ( is_array( $schedule_email_reminder )
                     && ( count( $schedule_email_reminder ) > 0 ) ) {
                    foreach ( $schedule_email_reminder as $schedule_email_item ) {
                        $data_schedule_single = $detail_schedule_email_reminder[ $schedule_email_item ];
                        
                        $time_send = $data_schedule_single['time_send'];
                        
                        $email = $data_schedule_single['email'];
                        if ( ( $time_send > $today_midnight )
                             && ( $time_send < $tomorrow_midnight ) ) {
                            array_push( $arr_schedule_event_today, array(
                                'time_send'     => $time_send,
                                'email_address' => $email,
                                'id_coupon'     => $coupon_id,
                                'coupon_code'   => $coupon_code,
                                'id_temp_email' => $schedule_email_item,
                            ) );
                        }
                    }
                }
            }
        }
        $new_arr_schedule_event_today = array();
        if ( is_array( $arr_schedule_event_today )
             && ( count( $arr_schedule_event_today ) > 0 ) ) {
            foreach ( $arr_schedule_event_today as $data_send_mail ) {
                $time_send = $data_send_mail['time_send'];
                //				array_push($new_arr_schedule_event_today[$time_send], $data_send_mail);
                //				array_push($new_arr_schedule_event_today, $data_send_mail);
                if ( isset( $new_arr_schedule_event_today[ $time_send ] ) ) {
                    array_push( $new_arr_schedule_event_today[ $time_send ], $data_send_mail );
                } else {
                    $new_arr_schedule_event_today[ $time_send ] = array( $data_send_mail );
                }
            }
        }
        if ( is_array( $new_arr_schedule_event_today )
             && ( count( $new_arr_schedule_event_today ) > 0 ) ) {
            foreach ( $new_arr_schedule_event_today as $time_send => $data_send_mail ) {
                wp_schedule_single_event( $time_send, 'action_viwcr_send_schedule_mail', array( $data_send_mail ) );
            }
        }
    }
    
    /*
    *
    * Single schedule event send email
    *
    *Hook name: action_viwcr_send_schedule_mail
    */
    public function viwcr_send_schedule_mail( $arr_schedule_event_today ) {
        if ( is_array( $arr_schedule_event_today )
             && ( count( $arr_schedule_event_today ) > 0 ) ) {
            foreach ( $arr_schedule_event_today as $data_send_mail ) {
                $email_address_arr    = $data_send_mail['email_address'];
                $id_coupon            = $data_send_mail['id_coupon'];
                $coupon_code          = $data_send_mail['coupon_code'];
                $id_temp_email        = $data_send_mail['id_temp_email'];
                $header               = '';
                $email_heading        = '';
                $subject              = '';
                $content              = '';
                $template_id          = 'none';
                $button_shop_url      = '';
                $button_shop_size     = '';
                $button_shop_color    = '';
                $button_shop_bg_color = '';
                $button_shop_title    = '';
                
                $viwcr_email_enable = get_post_meta( $id_temp_email, 'viwcr_email_enable', true );
                $viwcr_email_status = get_post_status( $id_temp_email );
                if ( isset( $viwcr_email_enable )
                     && ( $viwcr_email_enable === 'on' )
                     && ( $viwcr_email_status == 'publish' ) ) {
                    $viwcr_email_setting = get_post_meta( $id_temp_email, 'viwcr_email_setting', true );
                    if ( isset( $viwcr_email_setting )
                         && is_array( $viwcr_email_setting ) ) {
                        $email_heading = isset( $viwcr_email_setting['viwcr_email_header'] ) ? $viwcr_email_setting['viwcr_email_header'] : '';
                        $subject       = isset( $viwcr_email_setting['viwcr_email_subject'] ) ? $viwcr_email_setting['viwcr_email_subject'] : '';
                        
                        $content = isset( $viwcr_email_setting['viwcr_email_content'] ) ? $viwcr_email_setting['viwcr_email_content'] : '';
                        
                        $button_shop_title    = ! empty( $viwcr_email_setting['viwcr_button_title'] ) ? $viwcr_email_setting['viwcr_button_title'] : 'Shop now';
                        $button_shop_url      = ! empty( $viwcr_email_setting['viwcr_button_url'] ) ? $viwcr_email_setting['viwcr_button_url'] : home_url();
                        $button_shop_size     = ! empty( $viwcr_email_setting['viwcr_button_font_size'] ) ? $viwcr_email_setting['viwcr_button_font_size'] : '16';
                        $button_shop_color    = ! empty( $viwcr_email_setting['viwcr_button_color'] ) ? $viwcr_email_setting['viwcr_button_color'] : '#ffffff';
                        $button_shop_bg_color = ! empty( $viwcr_email_setting['viwcr_button_background'] ) ? $viwcr_email_setting['viwcr_button_background'] : '#000000';
                        
                        /*Compatible with Email Customize */
                        if ( class_exists( 'VIWEC_Render_Email_Template' ) ) {
                            $template_id = isset( $viwcr_email_setting['viwcr_email_content_replace'] ) ? $viwcr_email_setting['viwcr_email_content_replace'] : 'template_none';
                            if ( $template_id !== 'template_none' ) {
                                $email_template_obj = get_post( $template_id );
                                if ( $email_template_obj && $email_template_obj->post_type === 'viwec_template' ) {
                                    $args             = [ 'template_id' => $template_id ];
                                    $email_customizer = new VIWEC_Render_Email_Template( $args );
                                    ob_start();
                                    $email_heading = '';
                                    $email_customizer->get_content();
                                    $content            = ob_get_clean();
                                    $email_template_obj = get_post( $template_id );
                                    $subject            = $email_template_obj->post_title;
                                }
                            }
                        }
                    }
                    /*Replace shortcode on content email*/
                    $button_shop_now = '<a href="' . esc_url( $button_shop_url ) . '?email_redirect=true&coupon_code=' . esc_attr( $coupon_code ) . '" target="_blank" style="text-decoration:none;display:inline-block;padding:10px 30px;margin:10px 0;font-size:' . esc_attr( $button_shop_size ) . 'px;color:' . esc_attr( $button_shop_color ) . ';background:' . esc_attr( $button_shop_bg_color ) . ';">' . esc_html( $button_shop_title ) . '</a>';
                    
                    $subject = str_replace( '{viwcr_site_title}', get_bloginfo( 'name' ), $subject );
                    $content = str_replace( '{use_coupon_button}', $button_shop_now, $content );
                    $content = str_replace( '{coupon_code}', $coupon_code, $content );
                    $content = str_replace( '{viwcr_site_title}', get_bloginfo( 'name' ), $content );
                    
                    ///Coupon code
                    $coupon_Obj = new WC_Coupon( $coupon_code );
                    
                    if ( is_object( $coupon_Obj ) ) {
                        ///Coupon description
                        $coupon_des = $coupon_Obj->get_description();
                        $content    = str_replace( '{coupon_des}', $coupon_des, $content );
                        ///Coupon amount
                        if ( $coupon_Obj->get_discount_type() === 'percent' ) {
                            $content = str_replace( '{coupon_amount}', $coupon_Obj->get_amount() . '%', $content );
                        } else {
                            $content = str_replace( '{coupon_amount}', wc_price( $coupon_Obj->get_amount() ), $content );
                            $content = str_replace( '&nbsp;', ' ', $content );
                        }
                        ///Coupon expiry
                        $expiry_date_coupon = $coupon_Obj->get_date_expires();
                        
                        $expiry_datetime_Obj    = new WC_DateTime( $expiry_date_coupon->date( 'Y-m-d' ) );
                        $expiry_coupon_datetime = gmdate( 'Y-m-d H:m:s', $expiry_datetime_Obj->getTimestamp() ) . ' (GMT)';
                        
                        $content = str_replace( '{coupon_expiry}', $expiry_coupon_datetime, $content );
                        
                        /*Config sent email*/
                        if ( is_array( $email_address_arr )
                             && ( count( $email_address_arr ) > 0 ) ) {
                            foreach ( $email_address_arr as $email_address ) {
                                /*check is email address*/
                                if ( $this->is_email_invalid( $email_address )
                                     && $this->is_coupon_invalid( $coupon_Obj, $email_address ) ) {
                                    if ( $this->viwcr_send_mail( $email_address, $subject, $content, $email_heading ) ) {
                                        $this->update_status_schedule_after_send_mai( $id_coupon, $id_temp_email, 'success' );
                                    } else {
                                        $this->update_status_schedule_after_send_mai( $id_coupon, $id_temp_email, 'failed' );
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    
    /**
     * VIWCR function send email
     *
     * @param string $user_email    email address
     * @param string $subject       email subject
     * @param string $content       email content
     * @param string $email_heading email heading
     * @param array  $attachment    email attachment - always default array()
     *
     * @return boolean
     */
    public function viwcr_send_mail( $user_email, $subject, $content, $email_heading, $attachment = array() ) {
        $mailer = WC()->mailer();
        $email  = new WC_Email();
        if ( function_exists( 'mb_encode_mimeheader' ) ) {
            $subject = mb_encode_mimeheader( html_entity_decode( $subject, ENT_COMPAT, 'UTF-8' ) );
        }
        $content = $email->style_inline( $mailer->wrap_message( $email_heading, $content ) );
        
        $admin_email = get_bloginfo( 'admin_email' );
        $headers     = "Content-Type: text/html\r\nReply-to: {$email->get_from_name()} <{$email->get_from_address()}>\r\n";
        $headers     .= "Reply-to: <{$admin_email}>";
        
        return $email->send( $user_email, $subject, $content, $headers, $attachment );
    }
    
    /**
     * Check is valid email
     *
     * @param string $emailAddress email address
     *
     * @return boolean
     */
    public static function is_email_invalid( $emailAddress ) {
        if ( empty( $emailAddress ) ) {
            return false;
        }
        if ( filter_var( $emailAddress, FILTER_VALIDATE_EMAIL ) ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Preview Email
     *
     * @param $editor_id
     */
    public static function add_preview_emails_button( $editor_id ) {
        $editor_ids = array( 'viwcr-email_content' );
        if ( ! self::check_page_now() ) {
            return;
        }
        if ( in_array( $editor_id, $editor_ids ) ) {
            ?>
            <span class="vi-ui mini button primary icon labeled " id="viwcr-preview-emails-button">
                <i class="desktop icon"></i>
                <?php esc_html_e( 'Preview emails', 'woo-coupon-reminder' ) ?>
            </span>
            <?php
        }
    }
    
    /**
     * Render preview email to html and append to footer page
     *
     * @return void
     */
    public static function render_preview_emails_html() {
        if ( ! self::check_page_now() ) {
            return;
        }
        ?>
        <div class="preview-emails-html-container preview-html-hidden">
            <div class="preview-emails-html-overlay"></div>
            <div class="preview-emails-html"></div>
        </div>
        <?php
    }
    
    /**
     * Ajax show preview email modal popup
     *
     * @return void
     */
    public function preview_emails_ajax() {
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['nonce'] ), 'viwcr_nonce' ) ) {
            return;
        }

        add_filter( 'viwec_remove_origin_email_header_footer', '__return_false' );
        
        $content              = isset( $_POST['content'] ) ? wp_kses_post( stripslashes( $_POST['content'] ) ) : '';
        $email_heading        = isset( $_POST['heading'] ) ? sanitize_text_field( stripslashes( $_POST['heading'] ) ) : '';
        $button_shop_url      = isset( $_POST['button_shop_url'] ) ? sanitize_url( stripslashes( $_POST['button_shop_url'] ) ) : '';
        $button_shop_size     = isset( $_POST['button_shop_size'] ) ? sanitize_text_field( stripslashes( $_POST['button_shop_size'] ) ) : 16;
        $button_shop_color    = isset( $_POST['button_text_color'] ) ? sanitize_hex_color( stripslashes( $_POST['button_text_color'] ) ) : '#ffffff';
        $button_shop_bg_color = isset( $_POST['button_background_color'] ) ? sanitize_hex_color( stripslashes( $_POST['button_background_color'] ) ) : '#000000';
        $button_shop_title    = isset( $_POST['button_shop_title'] ) ? sanitize_text_field( stripslashes( $_POST['button_shop_title'] ) ) : 'Shop now';
        $template_id          = '';
        
        $button_shop_now = '<a href="' . esc_url( $button_shop_url ) . '" target="_blank" style="text-decoration:none;display:inline-block;padding:10px 30px;margin:10px 0;font-size:' . esc_attr( $button_shop_size ) . 'px;color:' . esc_attr( $button_shop_color ) . '!important;background-color:' . esc_attr( $button_shop_bg_color ) . ';">' . esc_html( $button_shop_title ) . '</a>';
        $coupon_amount   = '10% OFF';
        $coupon_des      = 'This is description coupon';
        $coupon_code     = 'COUPON_EMAIL_REMINDER';
        $date_expires    = strtotime( '+30 days' );
        
        if ( class_exists( 'VIWEC_Render_Email_Template' ) ) {
            $template_id = isset( $_POST['templace_replace'] ) ? wp_kses_post( stripslashes( $_POST['templace_replace'] ) ) : 'template_none';
            if ( $template_id !== 'none' ) {
                $email_template_obj = get_post( $template_id );
                if ( $email_template_obj && $email_template_obj->post_type === 'viwec_template' ) {
                    ob_start();
                    viwec_render_email_template( $template_id );
                    $content = ob_get_clean();
                    $subject = $email_template_obj->post_title;
                }
            }
        }
        
        $content = str_replace( '{coupon_code}', '<span style="font-size: x-large;">' . strtoupper( $coupon_code ) . '</span>', $content );
        $content = str_replace( '{coupon_expiry}', empty( $date_expires ) ? esc_html__( 'never expires', 'woo-coupon-reminder' ) : date_i18n( 'F d, Y', ( $date_expires ) ), $content );
        $content = str_replace( '{coupon_amount}', $coupon_amount, $content );
        $content = str_replace( '{coupon_des}', $coupon_des, $content );
        $content = str_replace( '{viwcr_site_title}', get_bloginfo( 'name' ), $content );
        $content = str_replace( '{use_coupon_button}', $button_shop_now, $content );
        
        if ( ( $template_id === 'template_none' )
             || ( $template_id === '' ) ) {
            // load the mailer class
            $mailer = WC()->mailer();
            
            // create a new email
            $email = new WC_Email();
            
            // wrap the content with the email template and then add styles
            $message = apply_filters( 'woocommerce_mail_content', $email->style_inline( $mailer->wrap_message( $email_heading, $content ) ) );
        } else {
            $message = $content;
        }
        
        // print the preview email
        wp_send_json( array(
            'html' => $message,
        ) );
        die();
    }
    
    /**
     * Check page now
     *
     * @return boolean
     */
    public static function check_page_now() {
        if ( ! is_admin() || is_preview() ) {
            return false;
        }
        /**
         * Check whether the get_current_screen function exists
         * because it is loaded only after 'admin_init' hook.
         */
        if ( ! function_exists( 'get_current_screen' ) ) {
            return false;
        }
        $get_current_screen = get_current_screen();
        $current_screen     = $get_current_screen->id ?? '';
        
        $check = false;
        if ( ( $current_screen == 'viwcr_email_template' )
             || ( $current_screen == 'edit-viwcr_email_template' ) ) {
            $check = true;
        }
        
        return $check;
    }
    
    /**
     * Action update coupon schedule data whenever this run function save()
     *
     * @param object $couponObj Coupon object
     *
     * @return void
     * @throws Exception
     */
    public function viwcr_action_update_schedule_woocommerce_coupon_save( $couponObj ) {
        if ( is_a( $couponObj, 'WC_Coupon' ) ) {
            $data_meta_all_schedule_email        = array();
            $data_meta_detail_schedule_email     = array();
            $old_data_meta_all_schedule_email    = array();
            $old_data_meta_detail_schedule_email = array();
            if ( ! is_object( $couponObj ) ) {
                return;
            }
            
            $coupon_id   = $couponObj->get_id();
            $coupon_code = $couponObj->get_code();
            $expiry_date = $couponObj->get_date_expires();
            
            $usage_limit          = $couponObj->get_usage_limit();
            $usage_limit_per_user = $couponObj->get_usage_limit_per_user();
            $usage_count          = $couponObj->get_usage_count();
            $email_restrictions   = $couponObj->get_email_restrictions();
            $coupon_expiry        = '';
            
            if ( ( ! $email_restrictions )
                 || ( count( $email_restrictions ) <= 0 ) ) {
                return;
            }
            if ( $usage_limit > 0 ) {
                if ( ( $usage_limit - $usage_count ) <= 0 ) {
                    return;
                }
            }
            
            if ( $expiry_date ) {
                $expiry_datetime_Obj = new WC_DateTime( $expiry_date->date( 'Y-m-d' ) );
                $now_datetime        = current_time( 'U' );
                
                if ( $now_datetime < $expiry_datetime_Obj->getTimestamp() ) {
                    $coupon_expiry       = $expiry_datetime_Obj->getTimestamp();
                    $data_email_template = $this->get_email_template_data( $coupon_expiry );
                    
                    if ( count( $data_email_template ) > 0 ) {
                        if ( class_exists( 'WC_Coupon' ) ) {
                            foreach ( $data_email_template as $data ) {
                                $data_meta_all_schedule_email[]                                = $data['id_email_template'];
                                $data_meta_detail_schedule_email[ $data['id_email_template'] ] = array(
                                    'time_send'       => $data['email_scheduling_time'],
                                    'email'           => $email_restrictions,
                                    'schedule_status' => false,
                                );
                            }
                        }
                    }
                }
            }
            
            if ( count( $data_meta_all_schedule_email ) > 0 ) {
                $arr_coupon    = get_option( 'viwrc_schedule_coupon' ) ? get_option( 'viwrc_schedule_coupon' ) : array();
                $arr_coupon_id = array();
                
                foreach ( $arr_coupon as $coupon_item ) {
                    $arr_coupon_id[] = $coupon_item['coupon_id'];
                }
                if ( ! in_array( $coupon_id, $arr_coupon_id ) ) {
                    array_push( $arr_coupon, array(
                        'coupon_id'                 => $coupon_id,
                        'coupon_code'               => $coupon_code,
                        'coupon_expires'            => $coupon_expiry,
                        'coupon_email_restrictions' => $email_restrictions,
                    ) );
                    update_option( 'viwrc_schedule_coupon', $arr_coupon );
                }
            }
            update_post_meta( $coupon_id, 'schedule_email_reminder', $data_meta_all_schedule_email );
            update_post_meta( $coupon_id, 'detail_schedule_email_reminder', $data_meta_detail_schedule_email );
            do_action( 'viwcr_add_cron_every_day' );
        }
    }
    
    /**
     * Check is valid coupon
     *
     * @param object $coupon_obj
     * @param string $email_address
     *
     * @return boolean
     * @throws Exception
     */
    public static function is_coupon_invalid( $coupon_obj, $email_address = '' ) {
        $result = true;
        if ( is_a( $coupon_obj, 'WC_Coupon' ) ) {
            $discounts = new WC_Discounts( WC()->cart );
            $valid     = $discounts->is_coupon_valid( $coupon_obj );
            if ( $valid ) {
                $expiry_date          = $coupon_obj->get_date_expires();
                $usage_limit          = $coupon_obj->get_usage_limit();
                $usage_limit_per_user = $coupon_obj->get_usage_limit_per_user();
                $usage_count          = $coupon_obj->get_usage_count();
                $email_restrictions   = $coupon_obj->get_email_restrictions();
                if ( $expiry_date ) {
                    $timezone            = wp_timezone(); // get timezone
                    $expiry_datetime_Obj = new WC_DateTime( $expiry_date->date( 'Y-m-d' ) );
                    $now_datetime        = current_time( 'U' );
                    
                    /*Check expiry time coupon*/
                    if ( $now_datetime >= $expiry_datetime_Obj->getTimestamp() ) {
                        return false;
                    }
                    /*Check email restriction coupon*/
                    if ( ( ! $email_restrictions )
                         || ( count( $email_restrictions ) <= 0 ) ) {
                        return false;
                    }
                    if ( $usage_limit > 0 ) {
                        if ( ( $usage_limit - $usage_count ) <= 0 ) {
                            return false;
                        }
                    }
                    
                    /*Check usage coupon by email*/
                    if ( ( $email_address != '' ) && ( $usage_limit_per_user > 0 ) ) {
                        // For guest, usage per user has not been enforced yet. Enforce it now.
                        $coupon_data_store = $coupon_obj->get_data_store();
                        $email_address     = strtolower( sanitize_email( $email_address ) );
                        if ( $coupon_data_store
                             && $coupon_data_store->get_usage_by_email( $coupon_obj, $email_address ) >= $usage_limit_per_user ) {
                            return false;
                        }
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        
        return $result;
    }
    
    public function update_status_schedule_after_send_mai( $id_coupon, $id_email, $status = '' ) {
        if ( empty( $id_coupon ) || empty( $id_email ) ) {
            return;
        }
        $schedule_email_reminder = get_post_meta( $id_coupon, 'schedule_email_reminder', true );
        if ( ! is_array( $schedule_email_reminder )
             || ( count( $schedule_email_reminder ) <= 0 )
             || ! in_array( $id_email, $schedule_email_reminder ) ) {
            return;
        }
        $detail_schedule_email_reminder = get_post_meta( $id_coupon, 'detail_schedule_email_reminder', true );
        if ( is_array( $detail_schedule_email_reminder )
             && ( count( $detail_schedule_email_reminder ) > 0 ) ) {
            if ( $status == '' || $status == 'success' ) {
                $detail_schedule_email_reminder[ $id_email ]['schedule_status'] = 'email_sent';
            } else {
                $detail_schedule_email_reminder[ $id_email ]['schedule_status'] = 'email_failed';
            }
            
            update_post_meta( $id_coupon, 'detail_schedule_email_reminder', $detail_schedule_email_reminder );
        }
    }
    
    public function custom_coupon_columns( $columns ) {
        $columns['reminder-schedule'] = esc_html__( 'Coupon Reminder', 'woo-coupon-reminder' );
        
        return $columns;
    }
    
    public function show_coupon_columns( $name ) {
        global $post;
        switch ( $name ) {
            case 'reminder-schedule':
                if ( ! isset( $_GET['post_status'] ) || ( isset( $_GET['post_status'] ) && ( $_GET['post_status'] != 'trash' ) ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
                    $schedule_email_reminder = get_post_meta( $post->ID, 'detail_schedule_email_reminder', true );
                    $viwcr_arr_coupon        = get_option( 'viwrc_schedule_coupon' ) ? get_option( 'viwrc_schedule_coupon' ) : array();
                    $arr_coupon_id           = array();
                    
                    foreach ( $viwcr_arr_coupon as $coupon_item ) {
                        $arr_coupon_id[] = $coupon_item['coupon_id'];
                    }
                    
                    if ( $schedule_email_reminder
                         && ( count( $schedule_email_reminder ) > 0 ) ) {
                        $items = '';
                        foreach ( $schedule_email_reminder as $key => $email_temp ) {
                            $enable = get_post_meta( $key, 'viwcr_email_enable', true );
                            if ( $enable == 'on' ) {
                                if ( $email_temp['schedule_status'] == 'email_sent' ) {
                                    $class = 'blue';
                                    $title = 'Email sent';
                                } elseif ( $email_temp['schedule_status'] == 'email_failed' ) {
                                    $class = 'red';
                                    $title = 'Email failed';
                                } else {
                                    if ( count( $arr_coupon_id ) > 0
                                         && in_array( $post->ID, $arr_coupon_id ) ) {
                                        $class = 'green';
                                        $title = 'Pending';
                                    } else {
                                        $class = 'gray';
                                        $title = 'Email Template out of date';
                                    }
                                }
                            } else {
                                $class = 'gray';
                                $title = 'Email Template Disable';
                            }
                            $items .= '<a target="_blank" href="' . get_edit_post_link( $key ) . '" title="' . esc_attr( $title ) . '" class="viwcr_label ' . esc_attr( $class ) . ' mini">' . esc_html( get_the_title( $key ) ) . '</a>';
                        }
                        echo wp_kses_post( $items );
                    }
                }
                break;
            default:
                break;
        }
    }
    
    public function custom_viwcr_email_template_columns( $columns ) {
        $columns['viwcr-email-send-before'] = esc_html__( 'Send before', 'woo-coupon-reminder' );
        $columns['viwcr-email-action']      = esc_html__( 'Action', 'woo-coupon-reminder' );
        
        return $columns;
    }
    
    public function show_viwcr_email_template_columns( $name ) {
        global $post;
        switch ( $name ) {
            case 'viwcr-email-send-before':
                $viwcr_email_setting = get_post_meta( $post->ID, 'viwcr_email_setting', true );
                if ( isset( $viwcr_email_setting )
                     && is_array( $viwcr_email_setting ) ) {
                    $viwcr_number_expiry = isset( $viwcr_email_setting['viwcr_number_expiry'] ) ? $viwcr_email_setting['viwcr_number_expiry'] : 1;
                    $viwcr_unit_expiry   = isset( $viwcr_email_setting['viwcr_unit_expiry'] ) ? $viwcr_email_setting['viwcr_unit_expiry'] : 'days';
                    
                    echo esc_html( $viwcr_number_expiry . ' ' . $viwcr_unit_expiry );
                }
                
                break;
            case 'viwcr-email-action':
                $viwcr_email_enable = get_post_meta( $post->ID, 'viwcr_email_enable', true );
                if ( ! empty( $viwcr_email_enable ) ) {
                    $enable_template = $viwcr_email_enable;
                } else {
                    $enable_template = 'on';
                }
                $disable_action = '';
                if ( $post->post_status == 'trash' ) {
                    $disable_action = 'disabled';
                }
                ?>
                <div class="vi-ui toggle action_enable checkbox">
                    <input type="checkbox"
                           class="viwcr-action_enable"
                        <?php
                        if ( $enable_template == 'on' ) {
                            esc_attr_e( 'checked', 'woo-coupon-reminder' );
                        }
                        ?>
                        <?php esc_attr( $disable_action ); ?>
                    >
                    <label></label>
                </div>
                <?php
                break;
            default:
                break;
        }
    }
    
    /**
     * Ajax show preview email modal popup
     *
     * @return void
     */
    public function action_ajax_enable_email() {
        if ( ! isset( $_POST['nonce'] ) || wp_verify_nonce( sanitize_key( $_POST['nonce'] ), 'viwcr_nonce' ) ) {
            return;
        }
        $post_id         = isset( $_POST['post_id'] ) ? sanitize_text_field( $_POST['post_id'] ) : '';
        $checkboxChecked = isset( $_POST['checkboxChecked'] ) ? sanitize_text_field( $_POST['checkboxChecked'] ) : 'on';
        $message         = '';
        if ( ( $post_id != '' ) && is_admin() ) {
            update_post_meta( $post_id, 'viwcr_email_enable', $checkboxChecked );
            $message = 'success';
        } else {
            $message = 'error';
        }
        wp_send_json( array(
            'checkboxChecked' => $checkboxChecked,
            'email_enable'    => get_post_meta( $post_id, 'viwcr_email_enable', true ),
            'success'         => $message,
        ) );
        die();
    }
    
    /**
     * Duplicate email template
     *
     * @param $actions
     * @param $post
     *
     * @return object
     */
    public function viwcr_duplicate_email_link( $actions, $post ) {
        if ( ! current_user_can( 'edit_posts' ) ) {
            return $actions;
        }
        if ( $post->post_type == "viwcr_email_template" ) {
            $url = wp_nonce_url( add_query_arg( array(
                'action' => 'viwcr_duplicate_email_as_draft',
                'post'   => $post->ID,
            ), 'admin.php' ), basename( __FILE__ ), 'duplicate_nonce' );
            
            $actions['duplicate'] = '<a href="' . esc_url( $url ) . '" title="Duplicate this email" rel="permalink">' . esc_html__( 'Duplicate', 'woo-coupon-reminder' ) . '</a>';
        }
        unset ( $actions['view'] );
        
        return $actions;
    }
    
    /**
     * Action duplicate email template
     *
     *
     * @return void
     */
    function viwcr_duplicate_email_as_draft() {
        // check if post ID has been provided and action
        if ( empty( $_GET['post'] ) ) {
            wp_die( 'No email template to duplicate has been provided!' );
        }
        
        // Nonce verification
        if ( ! isset( $_GET['duplicate_nonce'] ) || ! wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) ) {
            return;
        }
        
        // Get the original post id
        $post_id = absint( wc_clean( $_GET['post'] ) );
        
        // And all the original post data then
        $post = get_post( $post_id );
        
        /*
         * if you don't want current user to be the new post author,
         * then change next couple of lines to this: $new_post_author = $post->post_author;
         */
        $current_user    = wp_get_current_user();
        $new_post_author = $current_user->ID;
        
        // if post data exists (I am sure it is, but just in a case), create the post duplicate
        if ( $post ) {
            // new post data array
            $args = array(
                'post_author' => $new_post_author,
                'post_status' => 'draft',
                'post_title'  => $post->post_title,
                'post_type'   => $post->post_type,
            
            );
            
            // insert the post by wp_insert_post() function
            $new_post_id = wp_insert_post( $args );
            
            // duplicate all post meta
            $viwcr_email_enable  = get_post_meta( $post_id, 'viwcr_email_enable', true );
            $viwcr_email_setting = get_post_meta( $post_id, 'viwcr_email_setting', true );
            if ( ! empty( $viwcr_email_enable ) ) {
                $enable_template = $viwcr_email_enable;
            } else {
                $enable_template = 'on';
            }
            if ( isset( $viwcr_email_setting )
                 && is_array( $viwcr_email_setting ) ) {
                update_post_meta( $new_post_id, 'viwcr_email_setting', $viwcr_email_setting );
            }
            update_post_meta( $new_post_id, 'viwcr_email_enable', $enable_template );
            // finally, redirect to the edit post screen for the new draft
            wp_safe_redirect( add_query_arg( array(
                'action' => 'edit',
                'post'   => $new_post_id,
            ), admin_url( 'post.php' ) ) );
            exit;
        } else {
            wp_die( 'Post creation failed, could not find original post.' );
        }
    }
    
    /*
     * Compatiblie with email customize
     * */
    public function viwcr_register_email_type( $emails ) {
        $emails['viwcr_coupon_reminders'] = array(
            'name'          => esc_html__( 'WooCommerce Coupon Reminders Email', 'woo-coupon-reminder' ),
            'hide_rules'    => array( 'country', 'category', 'min_order', 'max_order', 'products' ),
            'hide_elements' => array(
                'html/order_detail',
                'html/order_subtotal',
                'html/order_total',
                'html/shipping_method',
                'html/payment_method',
                'html/order_note',
                'html/billing_address',
                'html/shipping_address',
                'html/wc_hook',
            ),
        );
        
        return $emails;
    }
    
    public function viwcr_register_email_sample_subject( $subjects ) {
        $subjects['viwcr_coupon_reminders'] = 'Coupon reminder from {viwcr_site_title}';
        
        return $subjects;
    }
    
    public function viwcr_register_email_sample_template( $samples ) {
        $samples['viwcr_coupon_reminders'] = [
            'basic' => [
                'name' => esc_html__( 'Basic', 'woo-coupon-reminder' ),
                'data' => '{"style_container":{"background-color":"transparent","background-image":"none"},"rows":{"0":{"props":{"style_outer":{"padding":"15px 35px","background-image":"none","background-color":"#162447","border-color":"transparent","border-style":"solid","border-width":"0px","border-radius":"0px","width":"600px"},"type":"layout/grid1cols","dataCols":"1"},"cols":{"0":{"props":{"style":{"padding":"0px","background-image":"none","background-color":"transparent","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px","width":"530px"}},"elements":{"0":{"type":"html/text","style":{"width":"530px","line-height":"30px","background-image":"none","background-color":"transparent","padding":"0px","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px"},"content":{"text":"<p style=\"text-align: center;\"><span style=\"color: #ffffff;\">{viwcr_site_title}</span></p>"},"attrs":{},"childStyle":{}}}}}},"1":{"props":{"style_outer":{"padding":"25px","background-image":"none","background-color":"#f9f9f9","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px","width":"600px"},"type":"layout/grid1cols","dataCols":"1"},"cols":{"0":{"props":{"style":{"padding":"0px","background-image":"none","background-color":"transparent","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px","width":"550px"}},"elements":{"0":{"type":"html/text","style":{"width":"550px","line-height":"28px","background-image":"none","background-color":"transparent","padding":"0px","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px"},"content":{"text":"<p style=\"text-align: center;\"><span style=\"font-size: 24px; color: #444444;\">Your coupon is about to expire!</span></p>"},"attrs":{},"childStyle":{}}}}}},"2":{"props":{"style_outer":{"padding":"10px 35px","background-image":"none","background-color":"#ffffff","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px","width":"600px"},"type":"layout/grid1cols","dataCols":"1"},"cols":{"0":{"props":{"style":{"padding":"0px","background-image":"none","background-color":"transparent","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px","width":"530px"}},"elements":{"0":{"type":"html/text","style":{"width":"530px","line-height":"22px","background-image":"none","background-color":"transparent","padding":"0px","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px"},"content":{"text":"<p>Dear Customer,</p>"},"attrs":{},"childStyle":{}},"1":{"type":"html/spacer","style":{"width":"530px"},"content":{},"attrs":{},"childStyle":{".viwec-spacer":{"padding":"10px 0px 0px"}}},"2":{"type":"html/text","style":{"width":"530px","line-height":"22px","background-image":"none","background-color":"transparent","padding":"0px","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px"},"content":{"text":"<p> Your coupon is about to expire. Please apply the coupon when shopping with us before it expires. Thank you!</p>"},"attrs":{},"childStyle":{}},"3":{"type":"html/button","style":{"width":"530px","font-size":"15px","font-weight":"400","color":"#1de712","line-height":"22px","text-align":"center","padding":"20px 0px 20px 1px"},"content":{"text":"{coupon_code}"},"attrs":{"href":"{shop_url}"},"childStyle":{"a":{"border-width":"2px","border-radius":"0px","border-color":"#162447","border-style":"dashed","background-color":"#ffffff","width":"200px","padding":"10px 20px"}}},"4":{"type":"html/text","style":{"width":"530px","line-height":"22px","background-image":"none","background-color":"transparent","padding":"0px","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px"},"content":{"text":"<p>This coupon will expire on {coupon_expiry}.</p>"},"attrs":{},"childStyle":{}},"5":{"type":"html/spacer","style":{"width":"530px"},"content":{},"attrs":{},"childStyle":{".viwec-spacer":{"padding":"10px 0px 0px"}}},"6":{"type":"html/text","style":{"width":"530px","line-height":"22px","background-image":"none","background-color":"transparent","padding":"0px","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px"},"content":{"text":"<p>Yours sincerely!</p>\n<p>{viwcr_site_title}</p>"},"attrs":{},"childStyle":{}}}}}},"3":{"props":{"style_outer":{"padding":"25px 35px","background-image":"none","background-color":"#162447","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px","width":"600px"},"type":"layout/grid1cols","dataCols":"1"},"cols":{"0":{"props":{"style":{"padding":"0px","background-image":"none","background-color":"transparent","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px","width":"530px"}},"elements":{"0":{"type":"html/text","style":{"width":"530px","line-height":"22px","background-image":"none","background-color":"transparent","padding":"0px","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px"},"content":{"text":"<p style=\"text-align: center;\"><span style=\"color: #f5f5f5; font-size: 20px;\">Get in Touch</span></p>"},"attrs":{},"childStyle":{}},"1":{"type":"html/social","style":{"width":"530px","text-align":"center","padding":"20px 0px 0px","background-image":"none","background-color":"transparent"},"content":{},"attrs":{"facebook":"'
                          . VIWEC_IMAGES . 'fb-blue-white.png","facebook_url":"#","twitter":"' . VIWEC_IMAGES . 'twi-cyan-white.png","twitter_url":"#","instagram":"' . VIWEC_IMAGES
                          . 'ins-white-color.png","instagram_url":"#","direction":""},"childStyle":{}},"2":{"type":"html/text","style":{"width":"530px","line-height":"22px","background-image":"none","background-color":"transparent","padding":"20px 0px","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px"},"content":{"text":"<p style=\"text-align: center;\"><span style=\"color: #f5f5f5; font-size: 12px;\">This email was sent by : <span style=\"color: #ffffff;\"><a style=\"color: #ffffff;\" href=\"{admin_email}\">{admin_email}</a></span></span></p>\n<p style=\"text-align: center;\"><span style=\"color: #f5f5f5; font-size: 12px;\">For any questions please send an email to <span style=\"color: #ffffff;\"><a style=\"color: #ffffff;\" href=\"{admin_email}\">{admin_email}</a></span></span></p>"},"attrs":{},"childStyle":{}},"3":{"type":"html/text","style":{"width":"530px","line-height":"22px","background-image":"none","background-color":"transparent","padding":"0px","border-color":"#444444","border-style":"solid","border-width":"0px","border-radius":"0px"},"content":{"text":"<p style=\"text-align: center;\"><span style=\"color: #f5f5f5;\"><span style=\"color: #f5f5f5;\"><span style=\"font-size: 12px;\"><a style=\"color: #f5f5f5;\" href=\"#\">Privacy Policy</a>&nbsp; |&nbsp; <a style=\"color: #f5f5f5;\" href=\"#\">Help Center</a></span></span></span></p>"},"attrs":{},"childStyle":{}}}}}}}}',
            ],
        ];
        
        return $samples;
    }
    
    public function viwcr_register_render_preview_shortcode( $sc ) {
        $date_format = get_option( 'date_format', 'F d, Y' );
        if ( ! $date_format ) {
            $date_format = 'F d, Y';
        }
        $sc['viwcr_coupon_reminders'] = array(
            '{coupon_amount}'     => '10% OFF',
            '{viwcr_site_title}'  => get_bloginfo( 'name' ),
            '{coupon_code}'       => 'COUPON_CODE',
            '{coupon_des}'        => 'This is description of coupon',
            '{use_coupon_button}' => '<a href="#" target="_blank" style="text-decoration:none;display:inline-block;padding:10px 30px;margin:10px 0;font-size:16px;color:#ffffff!important;background-color:#000000;">' . esc_html__( 'Shop now', 'woo-coupon-reminder' ) . '</a>',
            '{coupon_expiry}'     => date_i18n( $date_format, current_time( 'timestamp' ) ),
        );
        
        return $sc;
    }
    
    public static function viwcr_get_replace_email_templates( $type = 'viwcr_coupon_reminders' ) {
        $email_templates = array();
        if ( class_exists( 'WooCommerce_Email_Template_Customizer' ) || class_exists( 'Woo_Email_Template_Customizer' ) ) {
            $email_templates = viwec_get_emails_list( $type );
        }
        
        return $email_templates;
    }
    
    /*Clear old version data*/
    public function viwcr_clear_old_version_data() {
        if ( get_option( 'viwcr_clear_old_version_data' ) ) {
            global $wpdb;
            $db_table_name = $wpdb->prefix . 'scheduled_mails';
            $wpdb->query( "DROP TABLE IF EXISTS $db_table_name" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared
            delete_option( 'wce_statistics' );
            delete_option( 'wce_coupon_meta' );
            
            wp_unschedule_hook( 'wce_daily_scan_coupons' );
            wp_unschedule_hook( 'wce_send_mail_again' );
            
            update_option( 'viwcr_clear_old_version_data', true );
        }
    }
    
}
