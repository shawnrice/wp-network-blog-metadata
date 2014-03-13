<?php

/***
****
Setup and teardown functions.
****

nbm_create_table(): creates the table
nbm_install(): install script
nbm_update_db_check(): checks to make sure the table schema is the correct version
nbm_uninstall(): needs to be written

***/

// Make sure that these options are for the base table and not a per-blog table.

global $nbm_db_version;
$nbm_db_version = '1.1'; // Current version

function nbm_create_table() {
	// Function to create the data table

	global $wpdb;
	$tablename = $wpdb->base_prefix . "nbm_data"; // General tablename

	add_option( "nbm_db_version", $nbm_db_version );
	// Hard coded table, for now.
	// Changed column names: purpose, class_name, major, department
	$sql = "CREATE TABLE $tablename (
			  `blog_id` INT NOT NULL ,
			  `role` VARCHAR(45) NULL ,
			  `purpose` VARCHAR(45) NULL ,
			  `class_name` VARCHAR(128) NULL ,
			  `class_number` VARCHAR(45) NULL ,
			  `major` VARCHAR(128) NULL ,
			  `department` VARCHAR(128) NULL ,
			  `program` VARCHAR(128) NULL ,
			  PRIMARY KEY (`blog_id`) ,
			  UNIQUE KEY `blog_id_UNIQUE` (`blog_id` ASC)
			);";


	require_once ABSPATH . 'wp-admin/includes/upgrade.php'; // To upgrade the table schema later
	dbDelta( $sql );

	update_option( "nbm_db_version", $nbm_db_version ); // Updates the table schema version
	nbm_update_sql_table();
}

function nbm_update_sql_table() {

	global $wpdb;
	$tablename = $wpdb->base_prefix . "nbm_data"; // General tablename

	$t = count( $wpdb->get_results( "show columns from `$tablename` like 'program'" ) );

	if ( ! $t ) {
		$sql = ( "ALTER TABLE `$tablename` ADD program VARCHAR(128) NULL" );
		$wpdb->get_results( $sql );
	}
}


function nbm_install() {

	global $wpdb;
	$table_name = $wpdb->base_prefix . "nbm_data"; // Site-wide table
	$installed_db_version = get_option( "nbm_db_version" );

	if ( $installed_db_version != $nbm_db_version ) {
		nbm_create_table(); // This function might just need to be incorporated here.
	}

}
register_activation_hook( __FILE__, 'nbm_install' );

function nbm_update_db_check() {
	global $nbm_db_version;
	if ( get_site_option( 'nbm_db_version' ) != $nbm_db_version ) {
		nbm_install();
	}
}
add_action( 'plugins_loaded', 'nbm_update_db_check' );

function nbm_uninstall() {

	// Write function to drop the table, add in a js confirmation.

	// Directions below:

	// <script type="text/javascript">
	//   alert('Do you want to delete the NBM tables?');
	//   capture the output of the alert (or we might need to replace this with a different dialog.
	//  Delete the tables if yes. Don't if no.
	// </script>
	// Return a message
	// Data for NBM removed from the database.

}
