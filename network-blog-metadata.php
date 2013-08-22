<?php

/*
Plugin Name: Network Blog Metadata for B@B
Plugin URI: https://github.com/shawnrice/wp-network-blog-metadata
Description: A plugin to collect usage data about individual blogs on a network installation, specifically designed for B@B.
Version: 0.7-alpha
Author: Shawn Rice
Author URI: 
License: GPL2
*/

include_once( 'utilities/install.php' );
include_once( 'utilities/uninstall.php' );
include_once( 'utilities/utils.php' );

include_once( 'network-admin-menu.php' );
include_once( 'admin-menu.php' );

global $nbm_db_version;
$nbm_db_version = '1.1'; // Current version

// Hook the nbm_append_signup into the signup_blogform action
add_action( 'wpmu_new_blog' , 'nbm_append_signup' , 10, 0);
add_action( 'signup_blogform' , 'nbm_append_signup' , 10, 0);

function nbm_append_signup() {
// Function to append the form to the create a new blog page

	global $wpdb, $blog_id;

	$tablename = $wpdb->base_prefix . "nbm_data"; // This is a site-wide table


	//  Enqueue the javascript to reset values and hide fields
		wp_register_script( 'hide-field-js', plugins_url( '/js/hide.field.js', __FILE__ ) );
		wp_enqueue_script( 'hide-field-js' );

	if ( is_admin() && $_SERVER["REQUEST_METHOD"] == "POST" ) {
		process_nbm_on_blog_signup($blog_id, $user_id, $domain, $path, $site_id, $meta);
	}


if ( is_admin() ) {
		// Setup the SQL query
			$sql = 	'SELECT * from ' . $tablename .
					' WHERE `blog_id` = ' . $blog_id;
			
			$data = $wpdb->get_row($sql , ARRAY_A); 			// get_row method works here because there is only ever one row that matches.
			 nbm_update_sql_table(); // minor check that will be taken out soon. !!!!!!!
	

	?>

	   <div class="wrap">

	<?php 

		$dir = plugins_url( 'images/data_32.png' , __FILE__ );
	   	echo '<div id="icon-themes" class="icon32" style="background: url(\''.$dir.'\') no-repeat; background-size: 95%;"><br></div>'; 
} else {

// Get the values from the $_POST array so as to fill them back in when a registration fails
	if (!empty( $_POST ) ) {
		$data['role'] = $_POST['role'];
		$data['department'] = $_POST['department'];
		$data['major'] = $_POST['major'];
		$data['program'] = $_POST['program'];
		$data['class_site'] = $_POST['class_site'];
		$data['class_name'] = $_POST['class_name'];
		$data['class_number'] = $_POST['class_number'];
		$data['purpose'] = $_POST['purpose'];
		$data['use_other'] = $_POST['use_other'];
		$data['other_role'] = $_POST['other_role'];
		$data['class_type'] = $_POST['class_type'];		

	$roles = array( 'Faculty' , 'Student' , 'Staff' , '' );
	$purposes = array( 'Departmental site' , 'Project site' , 'Class site' , 'Club site' , 'Portfolio' , 'Personal/group blog' , 'Other' , 'class_site' );

	if ( (! in_array( $data['purpose'] , $purposes ) ) && (! empty( $data['purpose'] ) ) ) {
		$data['purpose'] = $data['use_other'];
		$purpose_other = TRUE;
	}

	if ( (! in_array( $data['role'] , $roles ) ) && (! empty( $data['role'] ) ) ) {
		$role_other = TRUE;
		$data['role'] = $data['other_role'];
	}

	}
}
	if ( (! ( isset( $_POST['submit'] ) && ( $_POST['submit'] == 'Create Site' ) ) ) || ( is_admin() ) ) {

	$roles = array( 'Faculty' , 'Student' , 'Staff' , '' );
	if ( (! in_array( $data['role'] , $roles ) ) && (! empty( $data['role'] ) ) ) {
		$role_other = TRUE;
	}

	$purposes = array( 'Departmental site' , 'Project site' , 'Class site' , 'Club site' , 'Portfolio' , 'Personal/group blog' , 'Other' , 'class_site' );
	if ( (! in_array( $data['purpose'] , $purposes ) ) && (! empty( $data['purpose'] ) ) ) {
		$purpose_other = TRUE;
	}

	if ( is_admin() ) { 
		if ( $data['purpose'] == 'class_site' ) {
			$data['class_site'] = 'Yes';
		}

	}

?>

<?php include( 'preface.php' ); ?>
<?php include( 'fields/role.php' ); ?>
<?php include( 'fields/classes.php' ); ?>
<?php include( 'fields/purpose.php' ); ?>
<?php include( 'fields/department.php' ); ?>
<?php include( 'fields/majors.php' ); ?>
<?php include( 'fields/programs.php' ); ?>


	</div>
	<?php if (! is_admin() ) { ?>
	<div>
		<p>&nbsp;</p>
	</div>
	<?php } else { echo "<br />"; }
	if ( is_admin() ) { ?>
		<div class="buttons">
			<input type="submit" />
		</div>
	</form>
<?php	
		}
	}
}

// When the new site is finally created (user has followed the activation link provided via e-mail), add a row to the options table with the value he submitted during signup
add_action('wpmu_new_blog', 'process_nbm_on_blog_signup', 10, 6);					// Dependent on a WPMU installation
function process_nbm_on_blog_signup($blog_id, $user_id, $domain, $path, $site_id, $meta) {

		   	global $wpdb;
		   	$tablename = $wpdb->base_prefix . "nbm_data"; // This is a site-wide table

			// These next calls should be coming from the network admin on an install script or activation script or something like that...
			// The creation of the table shouldn't exist in the regular user admin menus
			$table_exists = $wpdb->get_results( "SHOW TABLES LIKE '" . $tablename . "'" );
			if ( empty( $table_exists ) ) {
				nbm_create_table();
			}

			$row_exists = $wpdb->get_var( 'SELECT COUNT(*) from ' . $tablename . ' WHERE `blog_id` = ' . $blog_id );

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


			if ($_POST['class_site'] == '"Yes"') {
				$purpose = '"class_site"';
			} else if ($_POST['purpose'] == '"Other"') {
				$purpose = $_POST['use_other'];
			} else {
				$purpose = $_POST['purpose'];
			}

			if ( $_POST["role"] == '"Other"' ) {
				$_POST['role'] = $_POST['other_role'];
			}
			// Finished replacing values within the $_POST array in order to insert the correct ones.
			// The update sql should never be called
			if ( ! ( empty( $row_exists ) ) ) {
				$sql = 'UPDATE ' . $tablename . ' 
						SET 
						`role` = ' . $_POST["role"] . ',
						`purpose` = ' . $purpose . ',
						`class_name` = ' . $_POST["class_name"] . ',
						`class_number` = ' . $_POST["class_number"] . ',
						`major` = ' . $_POST["major"] . ',
						`department` = ' . $_POST["department"] . ',
						`program` = ' . $_POST["program"] . ',
						`class_type` = ' . $_POST["class_type"] . '
						WHERE `blog_id` = ' . $blog_id;
			} else {
				$sql = 'INSERT INTO ' . $tablename . ' VALUES (' .
						$blog_id . ', ' .
						$_POST["role"] . ', ' .
						$purpose . ', ' .
						$_POST["class_name"] . ', ' .
						$_POST["class_number"] . ', ' . 
						$_POST["major"] . ', ' .
						$_POST["department"] . ', ' .
						$_POST["program"] . ', ' .
						$_POST["class_type"] . ')';
			}
			echo $sql;
			$wpdb->query($wpdb->prepare($sql)); // Insert into the DB after preparing it.
		}
}












?>