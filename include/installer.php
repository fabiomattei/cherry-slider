<?php
	

register_activation_hook( __FILE__, 'rcsl_items_create_table' )

// Create / Update the items table 
function rcsl_items_create_table() {
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	global $wpdb;
	
	$tablename = $wpdb->prefix . 'rcslsliders';
	
	$sql = "CREATE TABLE `$tablename` (
		`rcsl_id` int(11) NOT NULL AUTO_INCREMENT,
		`rcsl_title` varchar(100) NOT NULL,
		`rcsl_description` varchar(100) NOT NULL,
		`rcsl_options` TEXT,
		PRIMARY KEY (`rcsl_id`)
	);";
	
	dbDelta($sql);
	
	$tablename = $wpdb->prefix . 'rcslpictures';
	
	$sql = "CREATE TABLE `$tablename` (
		`rcpc_id` int(11) NOT NULL AUTO_INCREMENT,
		`rcpc_rcslid` int(11) NOT NULL AUTO_INCREMENT,
		`rcpc_post_id` int(11) NOT NULL,
		`rcpc_title` varchar(100) NOT NULL,
		PRIMARY KEY (`rcpc_id`)
	);";
	
	dbDelta($sql); 
}
