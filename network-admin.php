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

function nbm_network_admin_tabs( $current = 'start' ) {
    $tabs = array( 'general' => 'General', 'table' => 'Table View', 'export' => 'Export' , 'manage' => 'Manage Form' );
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=nbm_answers&tab=$tab'>$name</a>";
    }
    echo '</h2>';
}

function nbm_network_manage_menu() {
	
	$tab = $_GET['tab']; // Get the current tab

	// Set the header for the tabs
	if ( isset ( $tab ) )
		nbm_network_admin_tabs( $tab );
	else nbm_network_admin_tabs( 'general' );

	// Print the tab content
	if ( $tab == 'general' ) 
		nbm_network_manage_general_tab();
	else if ( $tab == 'export' )
		nbm_network_admin_export_tab();
	else if ( $tab == 'table' ) 
		nbm_network_admin_table_tab();
	else
		nbm_network_manage_general_tab();
				
}

function nbm_network_manage_general_tab() {
	
		// The content for the genreal network admin menu page
		global $wpdb;
		$tablename = $wpdb->base_prefix . "wpnbm_data";

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

<?php
	
}

function nbm_network_admin_table_tab() {
	if( ! class_exists( 'WP_List_Table' ) ) {
	    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
	}	
	
	require_once( dirname( __FILE__ ) . '/table.list.class.php' );
	
  
   //Create an instance of our package class...
   $metaTable = new Network_Blog_Metadata_Table();
   //Fetch, prepare, sort, and filter our data...
   $metaTable->prepare_items();
   
   ?>
   <div class="wrap">
       
       <div id="icon-users" class="icon32"><br/></div>
       <h2>Blog Metadata</h2>      
       <form id="blog_metadata" method="get">
           <!-- For plugins, we also need to ensure that the form posts back to our current page -->
           <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
           <!-- Now we can render the completed list table -->
           <?php $metaTable->display() ?>
       </form>
       
   </div>
   <?php
	
}


function nbm_network_admin_export_tab() {
// The content for the "export" tab
// Turn make it so that you can download this as a file.

	global $wpdb;
	$tablename = $wpdb->base_prefix . "wpnbm_data";

	$table_exists = $wpdb->get_results("SHOW TABLES LIKE '".$tablename."'");
	if (empty($table_exists)) { // Just make sure that the table doesn't exist already.
		nbm_create_table();		// If not, create the table
	}

	$data = $wpdb->get_results('SELECT * from ' . $tablename , ARRAY_A);				// Selects all the roles in the wpnbm_data table

?>
CSV:<br />
-------------
<pre style="border: 1px dotted gray; padding: 20px; max-width: 800px;">
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
-------------
<br />
End Preliminary CSV Data
<?php
}


function nbm_populate_null() {
	// Function populates null values in the wp_wpnbm_data table for each blog that doesn't exist in there.
	// I can hook this into an install function later.
	
	global $wpdb;
	$tablename = $wpdb->base_prefix . "wpnbm_data";
	
	$sql = 'SELECT * from ' . $tablename;
	$data = $wpdb->get_results($sql, ARRAY_A);

	$sql = 'SELECT `blog_id` from wp_blogs';
	$ids = $wpdb->get_results($sql, ARRAY_N);
	array_walk($ids,'flatten_array');
	$ids = array_flip($ids);

	foreach ($data as $datum) {
		if ( in_array( $datum['blog_id'] , array_keys($ids) )) {
			unset($ids[$datum['blog_id']]);
		}
	}
	$ids = array_flip($ids);
	$count = 0;
	foreach ( $ids as $id ) {
		$sql = 'INSERT INTO ' . $tablename . ' VALUES( ' . $id . ' , NULL , NULL , NULL , NULL , NULL , NULL )';
		$result = $wpdb->get_results($sql);
		$count++;
	}
	
	// Message to appear declaring completion of null population
	echo '<div class="updated fade">' . $count . ' blogs with null values added into the database.</div>';	
		
}


function flatten_array(&$item) { 				
// Quick helper callback function to deal with arrays from the reports
// Basically, it matches up the numeric array keys to the blog ids

	$item = $item[0];
	
}


?>