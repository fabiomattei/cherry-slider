<?php
	
	
// Create / Update the items table 
function rcsl_items_create_table() {
	global $wpdb;
	
	$tablename = $wpdb->prefix . 'items';
	
	$sql = "CREATE TABLE `$tablename` (
		`rci_id` int(11) NOT NULL AUTO_INCREMENT,
		`post_id` int(11) NOT NULL,
		`title` varchar(100) NOT NULL,
		`description` varchar(100) NOT NULL,
		PRIMARY KEY (`hit_id`)
	);";
	
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql); 
}
