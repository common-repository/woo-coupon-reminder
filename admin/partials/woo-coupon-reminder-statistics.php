<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class VIWCR_Statistics_List_Table extends WP_List_Table {
	/** Class constructor */
	public function __construct() {
		global $status, $page;
		parent::__construct( [
			'singular' => esc_html__( 'viwcr_statistics', 'woo-coupon-reminder' ), //singular name of the listed records
			'plural'   => esc_html__( 'viwcr_statistics', 'woo-coupon-reminder' ), //plural name of the listed records
			'ajax'     => false //should this table support ajax?

		] );

	}

	function column_default( $item, $column_name ) {

		switch ( $column_name ) {
			case 'coupon_title':
			case 'coupon_tracking':
			case 'status':
				return ucfirst( $item[ $column_name ] );
			default:
				return print_r( $item, true ); //Show the whole array for troubleshooting purposes
		}
	}

	public function column_coupon_title( $item ) {
		$actions = array();

		return sprintf(
			'<strong>%1$s</strong> %2$s',
			$item['coupon_title'],
			$this->row_actions( $actions )
		);
	}

	public function column_coupon_tracking( $item ) {
		return sprintf(
			'%1$s ',
			$item['coupon_tracking']
		);
	}

	public function column_status( $item ) {
		return sprintf(
			'%1$s',
			$item['status']
		);
	}

	public function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="%1$s[]" value="%2$s" />',
			$this->_args['singular'],
			$item['id']
		);

	}

	public function get_columns() {
		$columns = array(
			'cb'              => '<input type="checkbox">',
			'coupon_title'    => 'Coupon code',
			'coupon_tracking' => 'Tracking click',
			'status'          => 'Status',
		);

		return $columns;
	}

	public function get_sortable_columns() {
		$sortable_columns = array(
			'coupon_title'    => array( 'coupon_title', false ),
			'coupon_tracking' => array( 'coupon_tracking', false ),
			'status'          => array( 'status', false ),
		);

		return $sortable_columns;
	}

	public function no_items() {
		esc_html_e( 'No items found.', 'woo-coupon-reminder' );
	}

    // phpcs:disable WordPress.Security.NonceVerification.Recommended
	public function prepare_items() {

		global $wpdb;

		$table_name = $wpdb->prefix . 'viwcr_statistics';
		$per_page   = 20;
		$columns    = $this->get_columns();

		$hidden   = array();
		$sortable = $this->get_sortable_columns();

		$this->_column_headers = array( $columns, $hidden, $sortable );

		$total_items = $wpdb->get_var( "SELECT COUNT(id) FROM $table_name" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared

		$paged   = isset( $_REQUEST['paged'] ) ? max( 0, intval( wc_clean($_REQUEST['paged']) ) - 1 ) : 0;
		$orderby = ( isset( $_REQUEST['orderby'] ) && in_array( $_REQUEST['orderby'], array_keys( $this->get_sortable_columns() ) ) ) ? wc_clean($_REQUEST['orderby']) : 'coupon_title';
		$order   = ( isset( $_REQUEST['order'] ) && in_array( $_REQUEST['order'], array(
				'asc',
				'desc'
			) ) ) ? wc_clean($_REQUEST['order']) : 'asc';


		$this->items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged ), ARRAY_A ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared

		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'per_page'    => $per_page,
			'total_pages' => ceil( $total_items / $per_page ),
		) );
	}
}