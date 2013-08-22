<?php

/***********
For the Network Admin Menu 
**********/

add_action('network_admin_menu', 'nbm_network_admin_menu');			// Adds the Network Admin Menu
function nbm_network_admin_menu() {									
	// Hook to add in the Network Admin Menu
	$dir = plugins_url( 'images/data_16.png' , __FILE__ );
	$page_hook_suffix = add_submenu_page( 'settings.php' , 'NBM Options', 'Network Blog Metadata', 'manage_options', 'nbm_answers', 'nbm_network_manage_menu', $dir );

}

function nbm_network_admin_tabs( $current = 'start' ) {
	$dir=plugins_url( 'images/data_32.png' , __FILE__ );
    $tabs = array( 'general' => 'General', 'table' => 'Table View', 'export' => 'Export' );
    echo '<div id="icon-themes" class="icon32" style="background: url(\''.$dir.'\') no-repeat; background-size: 95%;"><br></div>';
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
	else if ( $tab == 'table' ) 
		nbm_network_admin_table_tab();
	else if ( $tab == 'export' )
		nbm_network_admin_export_tab();
	else
		nbm_network_manage_general_tab();
				
}

function nbm_network_manage_general_tab() {
	
		// The content for the genreal network admin menu page
		global $wpdb;
		$tablename = $wpdb->base_prefix . 'nbm_data';

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

		$uses = array( 'class_site' => 0 , 'Personal Blog' => 0 , 'Portfolio' => 0 , 'Research Blog' => 0 , 'Other' => 0 ); // An array for the uses to check for the "Other field"

		// foreach statements that pulls the data from the SQL query into a usable array
		foreach ( $data as $datum ) {
			if ( ! ( isset( $null ) ) ) $null = 0;
			if ( ! ( isset( $student ) ) ) $student = 0;
			if ( ! ( isset( $faculty ) ) ) $faculty = 0;
			if ( ! ( isset( $staff ) ) ) $staff = 0;
			if ( ! ( isset( $class_site ) ) ) $class_site = 0;		

			if (is_null($datum['role'])) $null++;
			if ($datum['role'] == 'Student' ) $student++;
			if ($datum['role'] == 'Staff' ) $staff++;
			if ($datum['role'] == 'Faculty' ) $faculty++;
			if ($datum['purpose'] == 'class_site' ) {
				$class_site++;
				$uses['class_site']++;
			}
			if ($datum['purpose'] == 'Personal Blog' ) $uses['Personal Blog']++;
			if ($datum['purpose'] == 'Portfolio' ) $uses['Portfolio']++;
			if ($datum['purpose'] == 'Research Blog' ) $uses['Research Blog']++;
			if (!(in_array($datum['purpose'], $uses))) $uses['Other']++;

		}


		$total = count($data);

	?>	

	<p><h2>This is a network admin menu page. Reports and Other things will be added here soon.</h2></p>
	<p>There are <?php echo $total; ?> blogs in the wp_wpnbm_data table out of <?php echo $all_blogs; ?> all blogs in the system. (<?php echo round((($total/$all_blogs)*100),2); ?>%)
	<p><strong>Note: some of the values below are not accurate because of changes in the table structure and changed value names. Everything else works, but this hasn't been updated.</strong></p>
	<p>There are currently <?php echo $null; ?> blogs without any information entered. (<?php echo round((($null/$total)*100),2); ?>%)</p>
	<p>There are currently <?php echo $faculty; ?> blogs by faculty. (<?php echo round((($faculty/$total)*100),2); ?>%)</p>
	<p>There are currently <?php echo $student; ?> blogs by students. (<?php echo round((($student/$total)*100),2); ?>%)</p>
	<p>There are currently <?php echo $staff; ?> blogs by staff. (<?php echo round((($staff/$total)*100),2); ?>%)</p>
	<p>There are currently <?php echo $class_site; ?> class sites. (<?php echo round((($class_site/$total)*100),2); ?>%)</p>
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
	<p><b>What Other reports should go here? I can do a bunch. We could also turn these things into pie charts and fancy stuff.</b></p>

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
   
   
   		echo "<div class='wrap'>";
       	$dir=plugins_url( 'images/data_32.png' , __FILE__ );
    	echo '<div id="icon-themes" class="icon32" style="background: url(\''.$dir.'\') no-repeat; background-size: 95%;"><br></div>';
       ?>
       <h2>Blog Metadata</h2>      
       <form id="blog_metadata" method="get">
           <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
           <?php $metaTable->display() ?>
       </form>
       
   </div>
   <?php
	
}

add_action( 'init', 'nbm_check_for_csv_download' );
function nbm_check_for_csv_download( $wp ) {

    if ( ( isset($_GET['page']) && $_GET['page'] == 'nbm_answers' ) && ( isset($_GET['tab']) && $_GET['tab'] == 'export' ) ) {

    	if ( isset($_POST['Download_CSV']) && $_POST['Download_CSV'] = 'Download CSV' ) {
    		
    		nbm_download_csv_blogs_meta();
    	}
	}

}

function nbm_download_csv_blogs_meta() {

	global $wpdb;
	$tablename = $wpdb->base_prefix . "nbm_data";

	$table_exists = $wpdb->get_results("SHOW TABLES LIKE '".$tablename."'");
	if (empty($table_exists)) { // Just make sure that the table doesn't exist already.
		nbm_create_table();		// If not, create the table
	}

	$data = $wpdb->get_results('SELECT * from ' . $tablename , ARRAY_A);				// Selects all the roles in the wpnbm_data table

	$header = array( 	'blog_id' ,
						'role'	,
						'purpose' ,
						'class_name' ,
						'class_number',
						'major',
						'department',
						'program',
						'class_type'
			);

	nbm_array_to_csv_download( $data , $header , 'blog_metadata.csv' , ',' );


}

function nbm_network_admin_export_tab() {
// The content for the "export" tab
// Turn make it so that you can download this as a file.

	global $wpdb;
	$tablename = $wpdb->base_prefix . "nbm_data";

	$table_exists = $wpdb->get_results("SHOW TABLES LIKE '".$tablename."'");
	if (empty($table_exists)) { // Just make sure that the table doesn't exist already.
		nbm_create_table();		// If not, create the table
	}

	$data = $wpdb->get_results('SELECT * from ' . $tablename . ' LIMIT 0, 50', ARRAY_A);				// Selects all the roles in the wpnbm_data table



?>
CSV: (showing first 50 entries)<br />
-------------
<pre style="border: 1px dotted gray; padding: 20px; max-width: 800px;">
blog_id,role,purpose,class_name,class_number,major,department,program,class_type
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

<p>
<form method="post" action="">
	<input type="submit" name="Download CSV" value="Download CSV">
</form>
</p>
<?php
}
