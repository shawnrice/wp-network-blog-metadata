<?php

/*
Plugin Name: Network Blog Metadata
Plugin URI: https://github.com/shawnrice/wp-network-blog-metadata
Description: A plugin to collect usage data about individual blogs on a network installation.
Version: 0.2-alpha
Author: Shawn Rice
Author URI: 
License: GPL2
*/

/****														 *****
***** Current Table Structure -- hardcoded, need to abstract *****
*****
	 
	This table includes more questions than are asked via the plugin right now. They're there for expandability in the future.
	
	<pre>
	  `blog_id` INT NOT NULL ,
	  `user_role` VARCHAR(45) NULL ,
	  `blog_intended_use` VARCHAR(45) NULL ,
	  `course_title` VARCHAR(128) NULL ,
	  `course_number` VARCHAR(45) NULL ,
	  `student_major` VARCHAR(128) NULL ,
	  `person_department` VARCHAR(128) NULL ,
	</pre>

*****														 *****
*****														 *****/

/*** 
	Link to other scripts in the plugin.
***/

require_once('network-admin.php');
require_once('admin-menu.php');


/***

Notes to consider for when the plugin moves to a dynamic version:

--- Form creation should be available only to the network admin.
--- Create a tabbed admin page that has the "create/edit" form and another for reports.
--- Encode form data in json that can be retrieved by another php script
--- Make jQuery to alter the forms interpret everything from the json
--- Build in dependencies in the form fields and feed that in the JS; make sure that it allows for dependencies on multiple fields
--- Do a check to see if the site is using buddypress (and/or BBpress?) or a regular WPMU to alter the add_action calls for the appropriate pages
		--- Buddypress hijacks the registration and create new blog pages
		--- Does BBpress?
		--- Just do a check to see if it Buddypress and use the functions to get the register page, store that as a variable and feed that to the add_action functions
--- Add a table to store the form structure. Should this be based on the same architecture as the wp_options page?


--- Admin menus keep the same hooks in Buddypress and in WPMU, so those calls need not be altered.


***/


/*

Some BP constants to check for

define ( 'BP_REGISTER_SLUG', 'signup' );
define ( 'BP_ENABLE_MULTIBLOG', true );


function bp_blog_signup_enabled() { // checks to see if signup is enabled... obviously..

*/




/***

Init functions. The functions will vary slightly if the site is running Buddypress or a regular WPMU

***/

function nbm_bp_init() {
	require( dirname( __FILE__ ) . '/bp/bp-functions.php' );
}

function nbm_wpmu_init() {
	require( dirname( __FILE__ ) . '/wpmu-functions.php' );
}

// Check to see if Buddypress is active by seeing if an action exists in the wp_filters array
$is_bp_active = ( has_action( 'wp_head' , 'bp_core_add_ajax_url_js' ) ); 

if ($is_bp_active) nbm_bp_init();	// If BP	--> Load the BP init
else nbm_wpmu_init();				// If !BP	--> Load the WPMU init


/*** End Init ***/


// Add form elements on blog admin dashboard screens
add_action( "admin_print_scripts-site-new.php", "add_extra_field_on_blog_signup" );


// Add form to user registration and new blog creation for regular users
add_action('register','add_nbm_registration_fields');
function add_nbm_registration_fields() {
	wp_register_script( 'sign-up-extend' , plugins_url('js/alter-sign-up.js', __FILE__));
	wp_enqueue_script( 'sign-up-extend' );
	wp_register_style( 'hide-questions', plugins_url( '/nbm-style.css', __FILE__ ) ); // Stylesheet that just includes the way to hide the questions when not in use
	wp_enqueue_style( 'hide-questions' ); // I should just insert this into the wp-head, perhaps.
	

    // Get and set any values already sent
	// Doesn't work yet
$course_website = ( isset( $_POST['course_website'] ) ) ? $_POST['course_website'] : '';
$use_other = ( isset( $_POST['use_other'] ) ) ? $_POST['use_other'] : '';
$purpose = ( isset( $_POST['purpose'] ) ) ? $_POST['purpose'] : '';
$course_name = ( isset( $_POST['course_name'] ) ) ? $_POST['course_name'] : '';
$course_number = ( isset( $_POST['course_number'] ) ) ? $_POST['course_number'] : '';
$major = ( isset( $_POST['major'] ) ) ? $_POST['major'] : '';
$department = ( isset( $_POST['department'] ) ) ? $_POST['department'] : '';

}

// Works called during the admin menus
// Pulls in the javascript to control the sign-up the blog form...
// Doesn't pull all the javascript to write the form (faster via PHP because the load is on the server instead of the client)
function add_extra_field_on_blog_signup() {
	wp_enqueue_script( 'jQuery');
	wp_register_style( 'hide-questions', plugins_url( '/nbm-style.css', __FILE__ ) );
	wp_enqueue_style( 'hide-questions' );
	
}



// When the new site is finally created (user has followed the activation link provided via e-mail), add a row to the options table with the value he submitted during signup
add_action('wpmu_new_blog', 'process_extra_field_on_blog_signup', 10, 6);					// Dependent on a WPMU installation
//add_action('bp_core_validate_blog_signup' , 'process_extra_field_on_blog_signup', 10, 6);	// Dependent on a Buddypress installation (is this necessary?)

function process_extra_field_on_blog_signup($blog_id, $user_id, $domain, $path, $site_id, $meta) {

		   	global $wpdb;
		   	$tablename = $wpdb->base_prefix . "wpnbm_data"; // This is a site-wide table

			// These next calls should be coming from the network admin on an install script or activation script or something like that...
			// The creation of the table shouldn't exist in the regular user admin menus
			$table_exists = $wpdb->get_results("SHOW TABLES LIKE '".$tablename."'");
			if (empty($table_exists)) {
				nbm_create_table();
			}

			$row_exists = $wpdb->get_var('SELECT COUNT(*) from ' . $tablename . ' WHERE `blog_id` = ' . $blog_id);

	    if ( $_SERVER["REQUEST_METHOD"] == "POST" ) { 
			// For processing the form if submitted
			// Start processing the data in order to put into a SQL Query	
			foreach ($_POST as $key => $val) {
				if (!($val == NULL)) {
					$_POST[$key] = '"' . $val . '"';
				} else {
					$_POST[$key] = "NULL";
				}
			}

			if ($_POST['course_website'] == '"Yes"') {
				$purpose = '"course_website"';
			} else if ($_POST['purpose'] == '"other"') {
				$purpose = $_POST['use_other'];
			} else {
				$purpose = $_POST['purpose'];
			}

			// Finished replacing values within the $_POST array in order to insert the correct ones.
			if (!(empty($row_exists))) {
				$sql = 'UPDATE ' . $tablename . ' 
						SET 
						`user_role` = ' . $_POST["role"] . ',
						`blog_intended_use` = ' . $purpose . ',
						`course_title` = ' . $_POST["course_name"] . ',
						`course_number` = ' . $_POST["course_number"] . ',
						`student_major` = ' . $_POST["major"] . ',
						`person_department` = ' . $_POST["department"] . '
						WHERE `blog_id` = ' . $blog_id;
			} else {
				$sql = 'INSERT INTO ' . $tablename . ' VALUES (' .
						$blog_id . ', ' .
						$_POST["role"] . ', ' .
						$purpose . ', ' .
						$_POST["course_name"] . ', ' .
						$_POST["course_number"] . ', ' . '
						`student_major` = ' . $_POST["major"] . ', 
						`person_department` = ' . $_POST["department"] . ')';
			}
			$wpdb->query($wpdb->prepare($sql)); // Insert into the DB after preparing it.
		}
}


add_filter('add_signup_meta', 'append_extra_field_as_meta');
function append_extra_field_as_meta($meta) {

    if(isset($_REQUEST['role'])) {
        $meta['role'] = $_REQUEST['role'];
    }
    return $meta;

}

/*********** 
For extending the site-new.php page | this is an admin-menu page
***********/

// Only add the script for the page site-new.php (the page hook).
add_action( 'admin_print_scripts-site-new.php', 'nbm_admin_scripts_alter' );
//add_action( 'wpmu_new_blog', 'add_new_blog_field' , 10, 6); 		// Validates the data | does it?

function nbm_admin_scripts_alter() {
// Enqueues the js for the admin menu site-new page

   wp_register_script('sign-up-extend', plugins_url('js/alter-sign-up-admin.js', __FILE__));
   wp_enqueue_script('sign-up-extend');

}


/***

Installation and uninstallation functions

***/

register_activation_hook( __FILE__ , 'installNBM' ); // Call to run the installation script when plugin is activated.


function nbm_create_table() {
	// Function to create the data table
	
   global $wpdb;
   $tablename = $wpdb->base_prefix . "wpnbm_data"; // General tablename
	
	// Hard coded table, for now.
	$sql = "CREATE TABLE $tablename (
			  `blog_id` INT NOT NULL ,
			  `user_role` VARCHAR(45) NULL ,
			  `blog_intended_use` VARCHAR(45) NULL ,
			  `course_title` VARCHAR(128) NULL ,
			  `course_number` VARCHAR(45) NULL ,
			  `student_major` VARCHAR(128) NULL ,
			  `person_department` VARCHAR(128) NULL ,
			  PRIMARY KEY (`blog_id`) ,
			  UNIQUE KEY `blog_id_UNIQUE` (`blog_id` ASC)
			);";


		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' ); // This is currently a placeholder. We need to implement a versioned dataschema for an upgrade path. 
		dbDelta( $sql );
}

function installNBM() {
	// This function currently isn't called when it's supposed to be called
   if( !is_multisite() ) wp_die( 'This plugin is available only for multisite installations.' ); // This plugin shouldn't be installed on single sites, so kill the activation if single site..

	global $wpdb;
	$tablename = $wpdb->base_prefix . "wpnbm_data"; // This is a site-wide table

	$table_exists = $wpdb->get_results("SHOW TABLES LIKE '".$tablename."'");
	if (empty($table_exists)) { 
		// Just make sure that the table doesn't exist already.
		nbm_create_table();
	}

// The populate null values script could go here... | should it?

}

function uninstallNBM() {
	// Write function to delete the table if the user wants to do so on deactivation.
	
	// <script type="text/javascript">
	// 		alert('Do you want to delete the NBM tables?');
	// 		capture the output of the alert (or we might need to replace this with a different dialog.
	//		Delete the tables if yes. Don't if no.
	// </script>
	// Return a message
	// Data for NBM removed from the database.
	
}