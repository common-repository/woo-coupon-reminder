<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class VIWCR_Schedule_List_Table extends WP_List_Table {
    
    /** Class constructor */
    public function __construct() {
        global $status, $page;
        parent::__construct( [
            'singular' => esc_html__( 'viwcr_schedule', 'woo-coupon-reminder' ), //singular name of the listed records
            'plural'   => esc_html__( 'viwcr_schedule', 'woo-coupon-reminder' ), //plural name of the listed records
            'ajax'     => false, //should this table support ajax?
        
        ] );
    }
    
    public function extra_tablenav( $which ) {
        if ( 'top' === $which ) {
            ?>
            <div class="alignleft actions custom viwcr_action_scan_coupon">
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
    
    function column_default( $item, $column_name ) {
        switch ( $column_name ) {
            case 'coupon_title':
            case 'coupon_expiry':
            case 'email_restrictions':
            case 'email_reminder':
            default:
                return print_r( $item, true ); //Show the whole array for troubleshooting purposes
        }
    }
    
    public function column_coupon_title( $item ) {
        $actions = array();
        
        return sprintf( '<a target="_blank" href="%2$s" ><strong>%1$s </strong></a>', $item['coupon_title'], get_edit_post_link( $item['coupon_id'] ) );
    }
    
    public function column_coupon_expiry( $item ) {
        $date_format = get_option( 'date_format' );
        $time_format = get_option( 'time_format' );
        
        return sprintf( '%1$s ', gmdate( $date_format . ' ' . $time_format, $item['coupon_expiry'] ) );
    }
    
    public function column_email_restrictions( $item ) {
        $items = '';
        foreach ( $item['email_restrictions'] as $email ) {
            $items .= '<span class="vi-ui teal mini label">' . $email . '</span>';
        }
        
        return sprintf( '%1$s', $items );
    }
    
    public function column_email_reminder( $item ) {
        $items = '';
        if ( ! empty( $item['email_reminder'] ) ) {
            foreach ( $item['email_reminder'] as $key => $email_temp ) {
                $enable = get_post_meta( $key, 'viwcr_email_enable', true );
                
                if ( $enable == 'on' ) {
                    if ( $email_temp['schedule_status'] == 'email_sent' ) {
                        $class = 'blue';
                        $title = 'Email sent';
                    } elseif ( $email_temp['schedule_status'] == 'email_failed' ) {
                        $class = 'red';
                        $title = 'Email failed';
                    } else {
                        $class = 'green';
                        $title = 'Pending';
                    }
                } else {
                    $class = 'gray';
                    $title = 'Email Template Disable';
                }
                $items .= '<a target="_blank" href="' . esc_url( get_edit_post_link( $key ) ) . '" title="' . esc_attr( $title ) . '" class="vi-ui ' . esc_attr( $class ) . ' mini label">' . esc_html( get_the_title( $key ) ) . '</a>';
            }
        }
        
        return sprintf( '%1$s', $items );
    }
    
    public function get_columns() {
        $columns = array(
            'coupon_title'       => 'Coupon code',
            'coupon_expiry'      => 'Expiry date',
            'email_restrictions' => 'Allowed emails',
            'email_reminder'     => 'Email reminder name',
        );
        
        return $columns;
    }
    
    /*    public function get_sortable_columns(){
            $sortable_columns = array(
                'coupon_title'      => array('coupon_title', false),
                'coupon_expiry'     => array('coupon_expiry', false),
            );

            return $sortable_columns;
        }*/
    
    public function no_items() {
        esc_html_e( 'No items found.', 'woo-coupon-reminder' );
    }
    
    public function prepare_items() {
        global $wpdb;
        
        $per_page = 20;
        $columns  = $this->get_columns();
        $paged    = isset( $_GET['paged'] ) ? wc_clean( $_GET['paged'] ) : 1; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        $hidden   = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array( $columns, $hidden, $sortable );
        $viwcr_arr_coupon      = get_option( 'viwrc_schedule_coupon' ) ? get_option( 'viwrc_schedule_coupon' ) : array();
        $total_items           = count( $viwcr_arr_coupon );
        $start                 = $per_page * $paged - $per_page;
        $limit                 = $per_page * $paged - 1 <= $total_items - 1 ? $per_page * $paged - 1 : $total_items - 1;
        $data                  = array();
        
        if ( count( $viwcr_arr_coupon ) > 0 ) {
            for ( $i = $start; $i <= $limit; $i ++ ) {
                if ( ! isset( $viwcr_arr_coupon[ $i ] ) ) {
                    continue;
                }
                $detail_schedule_email_reminder = get_post_meta( $viwcr_arr_coupon[ $i ]['coupon_id'], 'detail_schedule_email_reminder', true );
                if ( empty( $detail_schedule_email_reminder ) ) {
                    continue;
                }
                array_push( $data, array(
                    'coupon_id'          => $viwcr_arr_coupon[ $i ]['coupon_id'],
                    'coupon_title'       => $viwcr_arr_coupon[ $i ]['coupon_code'],
                    'coupon_expiry'      => $viwcr_arr_coupon[ $i ]['coupon_expires'],
                    'email_restrictions' => $viwcr_arr_coupon[ $i ]['coupon_email_restrictions'],
                    'email_reminder'     => $detail_schedule_email_reminder,
                ) );
            }
        }
        
        $this->items = $data;
        
        $this->set_pagination_args( array(
            'total_items' => $total_items,
            'per_page'    => $per_page,
            'total_pages' => ceil( $total_items / $per_page ),
        ) );
    }
    
}