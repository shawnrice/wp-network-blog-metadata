<?php

/*
Plugin Name: Network Blog Metadata
Plugin URI: https://github.com/shawnrice/wp-network-blog-metadata
Description: A plugin to COOLECT collect usage data about individual blogs on a network installation.
Version: .1-alpha
Author: Shawn Rice
Author URI: 
License: GPL2 ? Which is best?
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
	  `course_enrollment` INT NULL ,
	  `course_multiple_section` BINARY NULL ,
	  `course_writing_intensive` BINARY NULL ,
	  `course_interactive` VARCHAR(45) NULL ,
	  `visibility` VARCHAR(45) NULL ,
	  `research_area` VARCHAR(128) NULL ,
	  `portfolio_professional` BINARY NULL ,
	  `portfolio_content_type` VARCHAR(128) NULL ,
	  `student_level` VARCHAR(20) NULL ,
	  `student_major` VARCHAR(128) NULL ,
	  `person_department` VARCHAR(128) NULL ,
	  `class_project_course` VARCHAR(128) NULL ,
	  `class_project_description` MEDIUMTEXT NULL ,
	</pre>

*****														 *****
*****														 *****/


/*


If we have populated answers, then we can always just not apply the css to hide the questions that shouldn't be available.


*/

/*
http://codex.wordpress.org/Function_Reference/register_activation_hook
<?php register_activation_hook( $file, $function ); ?> 

<?php add_action('network_admin_menu', 'function_name'); ?>

*/

/***

I'm opting to store the information in a separate table as we discussed. At least for B@B, this seems to be the best solution in that we can use the table to run reports on but won't have to tax the database as much in order to get B@B-wide information

***/

add_action( 'admin_init', 'nbm_admin_init' );
add_action( 'admin_menu', 'nbm_admin_menu' );
add_action('network_admin_menu', 'nbm_network_admin_menu');

function nbm_network_admin_menu() {
	
	$page_hook_suffix = add_menu_page( 'NBM Options', 'Network Blog Metadata', 'manage_options', 'nbm_answers', 'nbm_network_manage_menu', 'wp-content/plugins/network-blog-metadata/images/data.png' );
	
}


function nbm_populate_null() {
	// Function populates null values in the wp_wpnbm_data table for each blog that doesn't exist in there.
	// I can hook this into an install function later.
	
	global $wpdb;
	$tablename = $wpdb->prefix . "wpnbm_data";
	
	$sql = 'SELECT * from ' . $tablename;
	$data = $wpdb->get_results($sql, ARRAY_A);

	$sql = 'SELECT `blog_id` from wp_blogs';
	$ids = $wpdb->get_results($sql, ARRAY_N);
	array_walk($ids,'flatten_array');
	$ids = array_flip($ids);

	foreach ($data as $datum) :
		if ( in_array( $datum['blog_id'] , array_keys($ids) )) :
			unset($ids[$datum['blog_id']]);
		endif;
	endforeach;
	$ids = array_flip($ids);
	$count = 0;
	foreach ( $ids as $id ) :
		$sql = 'INSERT INTO ' . $tablename . ' VALUES( ' . $id . ' , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL )';
		$result = $wpdb->get_results($sql);
		$count++;
	endforeach;
	
	
	echo '<div class="updated">' . $count . ' blogs with null values added into the database.</div>';
		
}
// Only add the script for the page site-new.php (the page hook).
add_action( "admin_print_scripts-site-new.php", 'my_admin_scripts' );

function my_admin_scripts() {
    wp_register_script('sign-up-extend', plugins_url('alter-sign-up.js', __FILE__));
    wp_enqueue_script('sign-up-extend');
}
function add_new_blog_field($blog_id, $user_id, $domain, $path, $site_id, $meta) {

    // Make sure the user can perform this action and the request came from the correct page.
//	global $blog_id;

	switch_to_blog($blog_id);
   
	$path = $path . 'wp-admin/admin.php?page=nbm_answers';
//	wp_redirect($path);
//	exit;
				
//	echo "What what?";
//	http://localhost/~Sven/invest/onemoretimea/

    // Use a default value here if the field was not submitted.
    $new_field_value = 'default';

    if ( !empty($_POST['blog']['new_field']) )
        $new_field_value = $_POST['blog']['new_field'];

    // save option into the database
    update_option( 'new_field', $new_field_value);

    restore_current_blog();
}

add_action( 'wpmu_new_blog', 'add_new_blog_field' , 10, 6);

function flatten_array(&$item) {

	$item = $item[0];
	
}

function nbm_network_manage_menu() {
	global $wpdb;
	$tablename = $wpdb->prefix . "wpnbm_data";
	
	if (!(empty($_POST))) :
		if ( isset( $_POST['do_null'] ) ) :
			nbm_populate_null();
		endif;
	endif;

	$all_blogs = count($wpdb->get_results('SELECT `blog_id` from wp_blogs' , ARRAY_A));

	$data = $wpdb->get_results('SELECT * from ' . $tablename , ARRAY_A);

	foreach ( $data as $datum ) :
		if ( ! ( isset( $null ) ) ) $null = 0;
		if ( ! ( isset( $student ) ) ) $student = 0;
		if ( ! ( isset( $professor ) ) ) $professor = 0;
		if ( ! ( isset( $staff ) ) ) $staff = 0;
		if ( ! ( isset( $course_website ) ) ) $course_website = 0;		
						
		if (is_null($datum['user_role'])) $null++;
		if ($datum['user_role'] == 'student' ) $student++;
		if ($datum['user_role'] == 'staff' ) $staff++;
		if ($datum['user_role'] == 'professor' ) $professor++;
		if ($datum['blog_intended_use'] == 'course_website' ) $course_website++;										
	endforeach;
	
	$total = count($data);
	
?>

This is a network admin menu page. Reports and other things will be added here soon. <br />
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

function nbm_admin_init() {
    /* Register our script. */
    wp_register_script( 'hide-field-js', plugins_url( '/js/hide.field.js', __FILE__ ) );
    wp_register_style( 'hide-questions', plugins_url( '/nbm-style.css', __FILE__ ) );

}

function nbm_admin_menu() {
    /* Add our plugin submenu and administration screen */
    $page_hook_suffix = add_menu_page( 'NBM Options', 'Network Blog Metadata', 'manage_options', 'nbm_answers', 'nbm_manage_menu', 'wp-content/plugins/network-blog-metadata/images/data.png' );

    /*
      * Use the retrieved $page_hook_suffix to hook the function that links our script.
      * This hook invokes the function only on our plugin administration screen,
      * see: http://codex.wordpress.org/Administration_Menus#Page_Hook_Suffix
      */
    add_action('admin_print_scripts-' . $page_hook_suffix, 'nbm_admin_scripts');
}

function nbm_admin_scripts() {
    /* Link our already registered script to a page */
    wp_enqueue_script( 'hide-field-js' );
	wp_enqueue_style( 'hide-questions' );
}

function nbm_create_table() {

	   global $wpdb;

	   $tablename = $wpdb->base_prefix . "wpnbm_data"; 
	
	
$sql = "CREATE TABLE $tablename (
		  `blog_id` INT NOT NULL ,
		  `user_role` VARCHAR(45) NULL ,
		  `blog_intended_use` VARCHAR(45) NULL ,
		  `course_title` VARCHAR(128) NULL ,
		  `course_number` VARCHAR(45) NULL ,
		  `course_enrollment` INT NULL ,
		  `course_multiple_section` BINARY NULL ,
		  `course_writing_intensive` BINARY NULL ,
		  `course_interactive` VARCHAR(45) NULL ,
		  `visibility` VARCHAR(45) NULL ,
		  `research_area` VARCHAR(128) NULL ,
		  `portfolio_professional` BINARY NULL ,
		  `portfolio_content_type` VARCHAR(128) NULL ,
		  `student_level` VARCHAR(20) NULL ,
		  `student_major` VARCHAR(128) NULL ,
		  `person_department` VARCHAR(128) NULL ,
		  `class_project_course` VARCHAR(128) NULL ,
		  `class_project_description` MEDIUMTEXT NULL ,
		  PRIMARY KEY (`blog_id`) ,
		  UNIQUE KEY `blog_id_UNIQUE` (`blog_id` ASC)
		);";


	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
	

function nbm_manage_menu() {

	   	global $wpdb;

	   	$tablename = $wpdb->base_prefix . "wpnbm_data"; // This is a site-wide table
	
		// These next calls should be coming from the network admin on an install script or activation script or something like that...
		// The creation of the table shouldn't exist in the regular user admin menus
		$table_exists = $wpdb->get_results("SHOW TABLES LIKE '".$tablename."'");
		if (empty($table_exists)) :
			nbm_create_table();
		endif;
		
		global $blog_id;

		$row_exists = $wpdb->get_var('SELECT COUNT(*) from ' . $tablename . ' WHERE `blog_id` = ' . $blog_id);

    if ( $_SERVER["REQUEST_METHOD"] == "POST" ){ // For processing the form if submitted

		// Start processing the data in order to put into a SQL Query	
		foreach ($_POST as $key => $val) :
			if (!($val == NULL)) :
				$_POST[$key] = '"' . $val . '"';
			else : 
				$_POST[$key] = "NULL";
			endif;
		endforeach;
		
		if ($_POST['course_website'] == '"Yes"') :
			$purpose = '"course_website"';
		elseif ($_POST['purpose'] == '"other"') :
			$purpose = $_POST['use_other'];
		else :
			$purpose = $_POST['purpose'];
		endif;
		
		// Finished replacing values within the $_POST array in order to insert the correct ones.
		if (!(empty($row_exists))) :
			$sql = 'UPDATE ' . $tablename . ' 
					SET 
					`user_role` = ' . $_POST["role"] . ',
					`blog_intended_use` = ' . $purpose . ',
					`course_title` = ' . $_POST["course_name"] . ',
					`course_number` = ' . $_POST["course_number"] . ',
					`course_enrollment` = NULL,
					`course_multiple_section` = NULL,
					`course_writing_intensive` = NULL,
					`course_interactive` = NULL,
					`visibility` = NULL,
					`research_area` = NULL,
					`portfolio_professional` = NULL,
					`portfolio_content_type` = NULL,
					`student_level` = NULL,
					`student_major` = ' . $_POST["major"] . ',
					`person_department` = ' . $_POST["department"] . ',
					`class_project_course` = NULL,
					`class_project_description` = NULL  WHERE `blog_id` = ' . $blog_id;
		else :
			$sql = 'INSERT INTO ' . $tablename . ' VALUES (' .
				$blog_id . ', ' .
				$_POST["role"] . ', ' .
				$purpose . ', ' .
				$_POST["course_name"] . ', ' .
				$_POST["course_number"] . ', ' . '
				NULL,
				NULL,
				NULL,
				NULL,
				NULL,
				NULL,
				NULL,
				NULL,
				NULL,
				`student_major` = ' . $_POST["major"] . ', 
				`person_department` = ' . $_POST["department"] . ', 
				NULL,
				NULL)';
		endif;


		$wpdb->query($wpdb->prepare($sql)); // Insert into the DB after preparing it.
		echo '<div class="updated">Thank you for submitting the metadata.</div>';
		print_nbm_data();
	 

    } else {
	 print_nbm_data();
	}
}

function print_nbm_data() {
	
   	global $wpdb, $blog_id;
	
   	$tablename = $wpdb->base_prefix . "wpnbm_data"; // This is a site-wide table
	
	
	    	/* Display our administration screen */

			/*  Currently, the classes are the name of the field the question is dependent on.
				We should find a more intelligent way to do this...

				Class structures:
					1)	hide_question -- hides initially
					2)	dependent-on	
					3)	role (to erase)
			*/

			$sql = 	'SELECT * from ' . $tablename .
					' WHERE `blog_id` = ' . $blog_id;
					
			$data = $wpdb->get_row($sql , ARRAY_A); // get_row method works here because there is only ever one row that matches.

	?>
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<div class="wpnbm">
			<p>Please take a moment to tell us a little bit about your <b>Blogs @ Baruch site</b>. This information will be available only to the <b>B@B</b> administrators and will be used simply to help us understand how our users are using our site in order to determine how we can improve the overall experience for our current and future users.</p>


			<div class="role-data"> <?php 	// Start left column ?>
				<div id="role" name="role">
					<h3>Who are you?</h3>

					<div class="question">
					<span style="margin: 0px 0px 5px -5px;">I'm a ...</span><br />
						<input type="radio" name="role" value="professor"<?php if ($data['user_role'] == 'professor') echo ' checked';?>> Professor<br />
						<input type="radio" name="role" value="student"<?php if ($data['user_role'] == 'student') echo ' checked';?>> Student<br />
						<input type="radio" name="role" value="staff"<?php if ($data['user_role'] == 'staff') echo ' checked';?>> Staff<br />
					</div>
				</div>

				<div id="department" class="<?php if (!(($data['user_role'] =='professor') || ($data['user_role'] == 'staff'))) echo 'hide_question '; ?>professor-staff question">
					What department are you in?<br />
						<select name="department" class="professor-staff">
							<option value="">---</option>
							<option <?php if ($data['person_department'] == "Accountancy") echo 'selected';?>>Accountancy</option>
							<option <?php if ($data['person_department'] == "American Studies") echo 'selected';?>>American Studies</option>
							<option <?php if ($data['person_department'] == "Arts and Sciences Ad Hoc Programs") echo 'selected';?>>Arts and Sciences Ad Hoc Programs</option>
							<option <?php if ($data['person_department'] == "Asian and Asian American Studies") echo 'selected';?>>Asian and Asian American Studies</option>
							<option <?php if ($data['person_department'] == "Black and Latino Studies") echo 'selected';?>>Black and Latino Studies</option>
							<option <?php if ($data['person_department'] == "Communication Studies") echo 'selected';?>>Communication Studies</option>
							<option <?php if ($data['person_department'] == "Economics and Finance") echo 'selected';?>>Economics and Finance</option>
							<option <?php if ($data['person_department'] == "Education") echo 'selected';?>>Education</option>
							<option <?php if ($data['person_department'] == "English") echo 'selected';?>>English</option>
							<option <?php if ($data['person_department'] == "Film Studies") echo 'selected';?>>Film Studies</option>
							<option <?php if ($data['person_department'] == "Fine and Performing Arts") echo 'selected';?>>Fine and Performing Arts</option>
							<option <?php if ($data['person_department'] == "Global Studies") echo 'selected';?>>Global Studies</option>
							<option <?php if ($data['person_department'] == "History") echo 'selected';?>>History</option>
							<option <?php if ($data['person_department'] == "Interdisciplinary Programs and Courses") echo 'selected';?>>Interdisciplinary Programs and Courses</option>
							<option <?php if ($data['person_department'] == "Jewish Studies") echo 'selected';?>>Jewish Studies</option>
							<option <?php if ($data['person_department'] == "Journalism and the Writing Professions") echo 'selected';?>>Journalism and the Writing Professions</option>
							<option <?php if ($data['person_department'] == "Latin American and Caribbean Studies") echo 'selected';?>>Latin American and Caribbean Studies</option>
							<option <?php if ($data['person_department'] == "Law") echo 'selected';?>>Law</option>
							<option <?php if ($data['person_department'] == "Library Department") echo 'selected';?>>Library Department</option>
							<option <?php if ($data['person_department'] == "Management") echo 'selected';?>>Management</option>
							<option <?php if ($data['person_department'] == "Marketing and International Business") echo 'selected';?>>Marketing and International Business</option>
							<option <?php if ($data['person_department'] == "Mathematics") echo 'selected';?>>Mathematics</option>
							<option <?php if ($data['person_department'] == "Modern Languages and Comparative Literature") echo 'selected';?>>Modern Languages and Comparative Literature</option>
							<option <?php if ($data['person_department'] == "Natural Sciences") echo 'selected';?>>Natural Sciences</option>
							<option <?php if ($data['person_department'] == "Philosophy") echo 'selected';?>>Philosophy</option>
							<option <?php if ($data['person_department'] == "Physical and Health Education") echo 'selected';?>>Physical and Health Education</option>
							<option <?php if ($data['person_department'] == "Political Science") echo 'selected';?>>Political Science</option>
							<option <?php if ($data['person_department'] == "Psychology") echo 'selected';?>>Psychology</option>
							<option <?php if ($data['person_department'] == "Public Affairs") echo 'selected';?>>Public Affairs</option>
							<option <?php if ($data['person_department'] == "Real Estate") echo 'selected';?>>Real Estate</option>
							<option <?php if ($data['person_department'] == "Religion and Culture") echo 'selected';?>>Religion and Culture</option>
							<option <?php if ($data['person_department'] == "Sociology and Anthropology") echo 'selected';?>>Sociology and Anthropology</option>
							<option <?php if ($data['person_department'] == "Statistics and Computer Information Systems") echo 'selected';?>>Statistics and Computer Information Systems</option>
							<option <?php if ($data['person_department'] == "Women's Studies") echo 'selected';?>>Women's Studies</option>
						</select>
				</div>

				<div  class="hide_question student question">
					What is your major?<br />
					<select name="major" class="<?php if (!($data['user_role'] =='student')) echo 'hide_question'; ?>student">
						<option value="">---</option>
						<option<?php if ($data['student_major'] == "Undeclared") echo " selected";?>>Undeclared</option>
						<option<?php if ($data['student_major'] == "Accountancy") echo " selected";?>>Accountancy</option>
						<option<?php if ($data['student_major'] == "Ad Hoc Major") echo " selected";?>>Ad Hoc Major</option>
						<option<?php if ($data['student_major'] == "Actuarial Science") echo " selected";?>>Actuarial Science</option>
						<option<?php if ($data['student_major'] == "Art History and Theatre (Ad Hoc)") echo " selected";?>>Art History and Theatre (Ad Hoc)</option>
						<option<?php if ($data['student_major'] == "Arts Administration (Ad Hoc)") echo " selected";?>>Arts Administration (Ad Hoc)</option>
						<option<?php if ($data['student_major'] == "Asian & Asian American Studies (Ad Hoc)") echo " selected";?>>Asian & Asian American Studies (Ad Hoc)</option>
						<option<?php if ($data['student_major'] == "Biological Sciences") echo " selected";?>>Biological Sciences</option>
						<option<?php if ($data['student_major'] == "Business Journalism") echo " selected";?>>Business Journalism</option>
						<option<?php if ($data['student_major'] == "Business Writing") echo " selected";?>>Business Writing</option>
						<option<?php if ($data['student_major'] == "Computer Information Systems") echo " selected";?>>Computer Information Systems</option>
						<option<?php if ($data['student_major'] == "Corporate Communication") echo " selected";?>>Corporate Communication</option>
						<option<?php if ($data['student_major'] == "Economics") echo " selected";?>>Economics</option>
						<option<?php if ($data['student_major'] == "English") echo " selected";?>>English</option>
						<option<?php if ($data['student_major'] == "Finance") echo " selected";?>>Finance</option>
						<option<?php if ($data['student_major'] == "Graphic Communication") echo " selected";?>>Graphic Communication</option>
						<option<?php if ($data['student_major'] == "History") echo " selected";?>>History</option>
						<option>Industrial/Organizational Psychology</option>
						<option<?php if ($data['student_major'] == "International Business") echo " selected";?>>International Business</option>
						<option<?php if ($data['student_major'] == "Journalism") echo " selected";?>>Journalism</option>
						<option<?php if ($data['student_major'] == "Management") echo " selected";?>>Management</option>
						<option<?php if ($data['student_major'] == "Management of Musical Enterprises") echo " selected";?>>Management of Musical Enterprises</option>
						<option<?php if ($data['student_major'] == "Marketing Management") echo " selected";?>>Marketing Management</option>
						<option<?php if ($data['student_major'] == "Mathematics") echo " selected";?>>Mathematics</option>
						<option<?php if ($data['student_major'] == "Modern Languages & Comparative Literature (Ad Hoc)") echo " selected";?>>Modern Languages & Comparative Literature (Ad Hoc)</option>
						<option<?php if ($data['student_major'] == "Music") echo " selected";?>>Music</option>
						<option<?php if ($data['student_major'] == "Natural Sciences (Ad Hoc)") echo " selected";?>>Natural Sciences (Ad Hoc)</option>
						<option<?php if ($data['student_major'] == "Philosophy") echo " selected";?>>Philosophy</option>
						<option<?php if ($data['student_major'] == "Political Science") echo " selected";?>>Political Science</option>
						<option<?php if ($data['student_major'] == "Psychology") echo " selected";?>>Psychology</option>
						<option<?php if ($data['student_major'] == "Public Affairs") echo " selected";?>>Public Affairs</option>
						<option<?php if ($data['student_major'] == "Real Estate") echo " selected";?>>Real Estate</option>
						<option<?php if ($data['student_major'] == "Religion and Culture (Ad Hoc)") echo " selected";?>>Religion and Culture (Ad Hoc)</option>
						<option<?php if ($data['student_major'] == "Sociology") echo " selected";?>>Sociology</option>
						<option<?php if ($data['student_major'] == "Spanish") echo " selected";?>>Spanish</option>
						<option<?php if ($data['student_major'] == "Statistics") echo " selected";?>>Statistics</option>
						<option<?php if ($data['student_major'] == "Statistics & Quantitative Modeling") echo " selected";?>>Statistics & Quantitative Modeling</option>
					</select>
				</div>
			</div> <?php 	// End the person / role / info div -- left column ?>
	
			<div class="<?php if (!($data['user_role'])) echo 'hide_question ';?>use-data temp"> <?php 	// Start right column ?>
			<h3>Using this site</h3>
				<div class="<?php if (!($data['user_role'] =='professor')) echo 'hide_question '; ?>professor question">
					Is this a course website? <br />
					<select name="course_website" class="professor">
						<option value="">---</option>
						<option<?php if ($data['blog_intended_use'] == 'course_website') echo ' selected';?>>Yes</option>
						<option<?php if (($data['user_role'] == 'professor') && (!(is_null($data['blog_intended_use']))) && ($data['blog_intended_use'] != 'course_website')) echo ' selected';?>>No</option>
					</select>
				</div>

				<div class="<?php if (!(($data['user_role'] =='professor') && ($data['blog_intended_use']== 'course_website'))) echo 'hide_question '; ?>course_website question">
					Course Name:
					<input type="text" name="course_name" class="course_website" size="38">
				</div>

				<div class="<?php if (!(($data['user_role'] =='professor') && ($data['blog_intended_use']== 'course_website'))) echo 'hide_question '; ?>course_website question">
					Course Number (and section if you have it):
					<input type="text" name="course_number" class="course_website" size="16">
				</div>

				<div class="<?php if (($data['user_role'] =='professor') && ($data['blog_intended_use']== 'course_website')) echo 'hide_question '; ?>purpose question">
					What is the primary use for this blog?<br />
					<select name="purpose">
						<option value="">---</option>
						<option value="personal"<?php if ($data['blog_intended_use'] == 'personal') echo ' selected';?>>Personal Blog</option>
						<option value="research"<?php if ($data['blog_intended_use'] == 'research') echo ' selected';?>>Research Blog</option>
						<option value="portfolio"<?php if ($data['blog_intended_use'] == 'portfolio') echo ' selected';?>>Portfolio</option>
<?php
						$blog_intended_use = $data['blog_intended_use'];
						$uses = array('course_website' , 'personal' , 'porfolio' , 'research' , 'other');?>
						 echo "Regular use!<br/>";?>
						<option value="other"<?php if (!(in_array($blog_intended_use, $uses))) echo ' selected';?>>Other</option>
					</select>
					<br />
					<div class="<?php if ((in_array($blog_intended_use, $uses))) echo 'hide_question '; ?>use_other">
						Please specify: <input name="use_other" class="purpose"<?php if (!(in_array($blog_intended_use, $uses))) echo ' value="' . $blog_intended_use . '"';?>>
					</div>
				</div>
			</div> <? // End the second column that shows the use-data -- right column ?>

		</div>
		<div class="buttons">
			<input type="submit" />
		</div>
	</form>
	<?php
}

function nbm_menu() {
	// Add the new admin menu and page and save the returned hook suffix
	$hook_suffix = add_menu_page( 'NBM Options', 'Network Blog Metadata', 'manage_options', 'nbm_answers', 'nbm_options', 'wp-content/plugins/network-blog-metadata/images/data.png' );
	
	// Use the hook suffix to compose the hook and register an action executed when plugin's options page is loaded
	add_action( 'load-' . $hook_suffix , 'nbm_load_function' );
	

}

function nbm_options() {
//	if ( !current_user_can( 'manage_options' ) )  {
	//		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
//	}


	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}
/*
function nbm_admin_notices() {
	echo "<div id='notice' class='updated fade'><p>My Plugin is not configured yet. Please do it now.</p></div>\n";
}

function nbm_load_function() {
	// Current admin page is the options page for our plugin, so do not display the notice
	// (remove the action responsible for this)
	remove_action( 'admin_notices', 'nbm_admin_notices' );
}

*/

/* Table Schema

Change "invest" to database name and add prefix

CREATE  TABLE `invest`.`nbm-data` (
  `blog_id` INT NOT NULL ,
  `user_role` VARCHAR(45) NULL ,
  `blog_intended_use` VARCHAR(45) NULL ,
  `course_title` VARCHAR(128) NULL ,
  `course_number` VARCHAR(45) NULL ,
  `course_enrollment` INT NULL ,
  `course_multiple_section` BINARY NULL ,
  `course_writing_intensive` BINARY NULL ,
  `course_interactive` VARCHAR(45) NULL ,
  `visibility` VARCHAR(45) NULL ,
  `research_area` VARCHAR(128) NULL ,
  `portfolio_professional` BINARY NULL ,
  `portfolio_content_type` VARCHAR(128) NULL ,
  `student_level` VARCHAR(20) NULL ,
  `student_major` VARCHAR(128) NULL ,
  `person_department` VARCHAR(128) NULL ,
  `class_project_course` VARCHAR(128) NULL ,
  `class_project_description` MEDIUMTEXT NULL ,
  PRIMARY KEY (`blog_id`) ,
  UNIQUE INDEX `blog_id_UNIQUE` (`blog_id` ASC) );

*/

?>