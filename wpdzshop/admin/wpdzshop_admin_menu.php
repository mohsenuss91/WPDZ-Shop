<?php// create custom plugin settings menuadd_action('admin_menu', 'wpdz_shop_create_menu');function wpdz_shop_create_menu() {	//create new top-level menu	add_menu_page('WPDZShop Plugin Settings', 'WPDZ Shop', 'administrator', 'wpdz_shop_menu', 'wpdz_shop_settings_page',plugins_url('images/e-conf.png', __FILE__));	// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );	add_submenu_page( 'wpdz_shop_menu', 'My orders', 'My orders', 'manage_options', 'wpdz_shop_myorders', 'wpdz_shop_myorders' ); 	add_submenu_page( 'wpdz_shop_menu', 'Paypal Settings', 'Paypal Settings', 'manage_options', 'wpdz_shop_paypal_setting', 'wpdz_shop_paypal_setting' ); 	add_submenu_page( 'wpdz_shop_menu', 'ePay Settings', 'ePay Settings', 'manage_options', 'wpdz_shop_epay_setting', 'wpdz_shop_epay_setting' ); 	add_submenu_page( 'wpdz_shop_menu', 'Bank Transfer Settings', 'Bank Transfer Settings', 'manage_options', 'wpdz_shop_banktransfer_setting', 'wpdz_shop_banktransfer_setting' ); 	add_submenu_page( 'wpdz_shop_menu', 'CCP Settings', 'CCP Settings', 'manage_options', 'wpdz_shop_ccp_setting', 'wpdz_shop_ccp_setting' ); 	//call register settings function	add_action( 'admin_init', 'wpdz_shop_settings' );	add_action( 'admin_init', 'register_paypal_settings' );	add_action( 'admin_init', 'register_epay_settings' );	add_action( 'admin_init', 'register_banktransfer_settings' );	add_action( 'admin_init', 'register_ccp_settings' );}function wpdz_shop_settings() {	//register our settings	register_setting( 'wpdz_shop_settings', 'shop_email' );	register_setting( 'wpdz_shop_settings', 'shop_tel' );	register_setting( 'wpdz_shop_settings', 'shipping_shop' );	register_setting( 'wpdz_shop_settings', 'exchange_usd' );	register_setting( 'wpdz_shop_settings', 'exchange_eur' );	register_setting( 'wpdz_shop_settings', 'payment_method_active' );}function register_paypal_settings() {	//register our settings	register_setting( 'wpdz_shop_paypal', 'account_type' );	register_setting( 'wpdz_shop_paypal', 'login_account' );	register_setting( 'wpdz_shop_paypal', 'return_url' );	register_setting( 'wpdz_shop_paypal', 'currency_code' );}function register_epay_settings() {	//register our settings	register_setting( 'wpdz_shop_epay', 'merchant' );	register_setting( 'wpdz_shop_epay', 'currency' );	register_setting( 'wpdz_shop_epay', 'language' );	register_setting( 'wpdz_shop_epay', 'returnurl' );	register_setting( 'wpdz_shop_epay', 'cancelurl' );	register_setting( 'wpdz_shop_epay', 'statusurl' );	register_setting( 'wpdz_shop_epay', 'ref1' );	register_setting( 'wpdz_shop_epay', 'ref2' );	register_setting( 'wpdz_shop_epay', 'ref3' );	register_setting( 'wpdz_shop_epay', 'ref4' );	register_setting( 'wpdz_shop_epay', 'ref5' );	register_setting( 'wpdz_shop_epay', 'ref6' );}function register_banktransfer_settings() {	//register our settings	register_setting( 'wpdz_shop_banktransfer', 'fax_banktransfer' );	register_setting( 'wpdz_shop_banktransfer', 'email_banktransfer' );	register_setting( 'wpdz_shop_banktransfer', 'tel_banktransfer' );	register_setting( 'wpdz_shop_banktransfer', 'accountnumber_banktransfer' );	register_setting( 'wpdz_shop_banktransfer', 'accountname_banktransfer' );}function register_ccp_settings() {	//register our settings	register_setting( 'wpdz_shop_ccp', 'fax_ccp' );	register_setting( 'wpdz_shop_ccp', 'email_ccp' );	register_setting( 'wpdz_shop_ccp', 'tel_ccp' );	register_setting( 'wpdz_shop_ccp', 'ccp_name' );	register_setting( 'wpdz_shop_ccp', 'ccp_number' );}function wpdz_shop_myorders() {	global $wpdb;	include 'wpdzshop_admin_menu_myorders.php';}function wpdz_shop_paypal_setting() {	include 'wpdzshop_admin_menu_paypal_settings.php';}function wpdz_shop_epay_setting() {	global $wpdb;	include 'wpdzshop_admin_menu_epay_settings.php';}function wpdz_shop_banktransfer_setting() {	global $wpdb;	include 'wpdzshop_admin_menu_banktransfer_settings.php';}function wpdz_shop_ccp_setting() {	include 'wpdzshop_admin_menu_ccp_settings.php';}function wpdz_shop_settings_page(){	include 'wpdzshop_admin_menu_settings.php';}