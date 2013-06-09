<?php

require_once('network-blog-metadata.php');

/***********
For the Network Admin Menu 
**********/

add_action('network_admin_menu', 'nbm_network_admin_menu');			// Adds the Network Admin Menu

function nbm_network_admin_menu() {									
	// Hook to add in the Network Admin Menu
	$page_hook_suffix = add_menu_page( 'NBM Options', 'Network Blog Metadata', 'manage_options', 'nbm_answers', 'nbm_network_manage_menu', '../wp-content/plugins/network-blog-metadata/images/data.png' );

}



function nbm_network_manage_menu() {								
	// The content for the network admin menu page
	global $wpdb;
	$tablename = $wpdb->prefix . "wpnbm_data";

	$table_exists = $wpdb->get_results("SHOW TABLES LIKE '".$tablename."'");
	if (empty($table_exists)) { // Just make sure that the table doesn't exist already.
		nbm_create_table();		// If not, create the table
	}
		
	if (!(empty($_POST))) {		// If the function to populate the null values has been called
		if ( isset( $_POST['do_null'] ) ) {
			nbm_populate_null();
		}
	}

	$all_blogs = count($wpdb->get_results('SELECT `blog_id` from wp_blogs' , ARRAY_A));	// Counts the number of blogs in the database

	$data = $wpdb->get_results('SELECT * from ' . $tablename , ARRAY_A);				// Selects all the roles in the wpnbm_data table

	$uses = array( 'course_website' => 0 , 'personal'  => 0 , 'porfolio'  => 0 , 'research'  => 0 , 'other' => 0 ); // An array for the uses to check for the "other field"

	// foreach statements that pulls the data from the SQL query into a usable array
	foreach ( $data as $datum ) {
		if ( ! ( isset( $null ) ) ) $null = 0;
		if ( ! ( isset( $student ) ) ) $student = 0;
		if ( ! ( isset( $professor ) ) ) $professor = 0;
		if ( ! ( isset( $staff ) ) ) $staff = 0;
		if ( ! ( isset( $course_website ) ) ) $course_website = 0;		
						
		if (is_null($datum['user_role'])) $null++;
		if ($datum['user_role'] == 'Student' ) $student++;
		if ($datum['user_role'] == 'Staff' ) $staff++;
		if ($datum['user_role'] == 'Professor' ) $professor++;
		if ($datum['blog_intended_use'] == 'course_website' ) {
			$course_website++;
			$uses['course_website']++;
		}
		if ($datum['blog_intended_use'] == 'personal' ) $uses['personal']++;
		if ($datum['blog_intended_use'] == 'portfolio' ) $uses['portfolio']++;
		if ($datum['blog_intended_use'] == 'research' ) $uses['research']++;
		if (!(in_array($datum['blog_intended_use'], $uses))) $uses['other']++;

	}
	
	
	$total = count($data);

	echo "Register page: " . BP_REGISTER_SLUG . "<br/>";

?>	

<p><h2>This is a network admin menu page. Reports and other things will be added here soon.</h2></p>
<p>There are <?php echo $total; ?> blogs in the wp_wpnbm_data table out of <?php echo $all_blogs; ?> all blogs in the system. (<?php echo round((($total/$all_blogs)*100),2); ?>%)
<p>There are currently <?php echo $null; ?> blogs without any information entered. (<?php echo round((($null/$total)*100),2); ?>%)</p>
<p>There are currently <?php echo $professor; ?> blogs by professors. (<?php echo round((($professor/$total)*100),2); ?>%)</p>
<p>There are currently <?php echo $student; ?> blogs by students. (<?php echo round((($student/$total)*100),2); ?>%)</p>
<p>There are currently <?php echo $staff; ?> blogs by staff. (<?php echo round((($staff/$total)*100),2); ?>%)</p>
<p>There are currently <?php echo $course_website; ?> course websites. (<?php echo round((($course_website/$total)*100),2); ?>%)</p>
<br />
<br />
<br />
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="submit" value="Fill in null values for unaccounted blogs" name="do_null">
</form>
<br />
<br />
<br />
<br />
<p><b>What other reports should go here? I can do a bunch. We could also turn these things into pie charts and fancy stuff.</b></p>

CSV:<br />
<pre>
blog_id,user_role,blog_intended_use,course_title,course_number,student_major,person_department
<?php
foreach ($data as $datum) {
	foreach ( $datum as $val ) {
		echo $val.',';
	}
	echo '<br/>';
}
?>
</pre>
<?php
}
?>