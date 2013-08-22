<?php

/***********
For the per-site Admin Menu
***********/

add_action( 'admin_init', 'nbm_admin_init' );
add_action( 'admin_menu', 'nbm_admin_menu' );						// Adds the Admin Menu for each blog

function nbm_admin_init() {				
	// Registers the javascript and css for the per-site Admin Menu
    wp_register_script( 'hide-field-js', plugins_url( '/js/hide.field.js', __FILE__ ) );
    wp_register_style( 'nbm', plugins_url( '/css/nbm.css', __FILE__ ) );


}

function nbm_admin_scripts() {			
	// Enqueues the javascript and css for the per-site Admin Menu
    wp_enqueue_script( 'hide-field-js' );
	wp_enqueue_style( 'nbm' );
}

function nbm_empty_settings_flag() {
	// Add flag in case the nbm settings haven't been filled out.

	global $wpdb, $blog_id;
   	$tablename = $wpdb->base_prefix . "nbm_data"; // This is a site-wide table

	// These next calls should be coming from the network admin on an install script or activation script or something like that...
	// The creation of the table shouldn't exist in the regular user admin menus
	$table_exists = $wpdb->get_results( "SHOW TABLES LIKE '" . $tablename . "'" );
	if ( empty( $table_exists ) ) {
		nbm_create_table();
	}

	$role = $wpdb->get_results( 'SELECT `role` from ' . $tablename . ' WHERE `blog_id` = ' . $blog_id );
	if (empty($role[0]->role)) {
		$url = site_url();
		echo "<div id='nbm_notice' class='updated fade'><p>".__('Please take a moment to fill out some information about your blog on the ')."<a href=\"$url/wp-admin/options-general.php?page=nbm_answers\">settings page</a>.</p></div>";
    }
}
add_action('admin_notices', 'nbm_empty_settings_flag');


function nbm_admin_menu() {				
	// Hooks into the dashboard to create the per-site Admin Menu

	$dir = plugins_url( 'images/data_16.png' , __FILE__ );
    $page_hook_suffix = add_options_page( 'NBM Options', 'Site Metadata', 'manage_options', 'nbm_answers', 'nbm_append_signup', $dir );

    add_action('admin_print_scripts-' . $page_hook_suffix, 'nbm_admin_scripts');
}
