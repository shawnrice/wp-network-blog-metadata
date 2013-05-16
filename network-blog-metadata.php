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

add_action( 'admin_init', 'nbm_admin_init' );
add_action( 'admin_menu', 'nbm_admin_menu' );

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

	   $table_name = $wpdb->base_prefix . "wpnbm_data"; 
	
$sql = "CREATE TABLE $table_name (
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

	   	$table_name = $wpdb->base_prefix . "wpnbm_data"; // This is a site-wide table
	
		// These next calls should be coming from the network admin on an install script or activation script or something like that...
		// The creation of the table shouldn't exist in the regular user admin menus
		$table_exists = $wpdb->get_results("SHOW TABLES LIKE '".$table_name."'");
		if (empty($table_exists)) :
			nbm_create_table();
		endif;


    if ( $_SERVER["REQUEST_METHOD"] == "POST" ){ // For processing the form if submitted
		global $blog_id;

// Start processing the data in order to put into a SQL Query		
		foreach ($_POST as $key => $val) :
			if (!($val == NULL)) :
				$_POST[$key] = '"' . $val . '"';
			else : 
				$_POST[$key] = "NULL";
			endif;
		endforeach;
		
		if ($_POST['course_website'] == '"Yes"') :
			$purpose = $_POST['course_website'];
		elseif ($_POST['purpose'] == '"other"') :
			$purpose = $_POST['use-other'];
		else :
			$purpose = $_POST['purpose'];
		endif;
// Finished replacing values within the $_POST array in order to insert the correct ones.
		
		$sql = 'UPDATE ' . $table_name . '
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
				`class_project_description` = NULL
				WHERE blog_id = ' . $blog_id;

		$wpdb->query($wpdb->prepare($sql)); // Insert into the DB after preparing it.

    } else {
	    	/* Display our administration screen */

			/*  Currently, the classes are the name of the field the question is dependent on.
				We should find a more intelligent way to do this...

				Class structures:
					1)	hide_question -- hides initially
					2)	dependent-on	
					3)	role (to erase)
			*/
	?>
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<div class="wpnbm">
			<p>Please take a moment to tell us a little bit about your <b>Blogs @ Baruch site</b>. This information will be available only to the <b>B@B</b> administrators and will be used simply to help us understand how our users are using our site in order to determine how we can improve the overall experience for our current and future users.</p>



			<div class="role-data"> <?php 	// Start left column ?>
				<div id="role" name="role">
					<h3>Who are you?</h3>

					<div class="question">
					<span style="margin: 0px 0px 5px -5px;">I'm a ...</span><br />
						<input type="radio" name="role" value="professor"> Professor<br />
						<input type="radio" name="role" value="student"> Student<br />
						<input type="radio" name="role" value="staff"> Staff<br />
					</div>
				</div>

				<div id="department" class="hide_question professor-staff question">
					What department are you in?<br />
						<select name="department" class="professor-staff">
						<option value="">---</option>
						<option>Accountancy</option>
						<option>American Studies</option>
						<option>Arts and Sciences Ad Hoc Programs</option>
						<option>Asian and Asian American Studies</option>
						<option>Black and Latino Studies</option>
						<option>Communication Studies</option>
						<option>Economics and Finance</option>
						<option>Education</option>
						<option>English</option>
						<option>Film Studies</option>
						<option>Fine and Performing Arts</option>
						<option>Global Studies</option>
						<option>History</option>
						<option>Interdisciplinary Programs and Courses</option>
						<option>Jewish Studies</option>
						<option>Journalism and the Writing Professions</option>
						<option>Latin American and Caribbean Studies</option>
						<option>Law</option>
						<option>Library Department</option>
						<option>Management</option>
						<option>Marketing and International Business</option>
						<option>Mathematics</option>
						<option>Modern Languages and Comparative Literature</option>
						<option>Natural Sciences</option>
						<option>Philosophy</option>
						<option>Physical and Health Education</option>
						<option>Political Science</option>
						<option>Psychology</option>
						<option>Public Affairs</option>
						<option>Real Estate</option>
						<option>Religion and Culture</option>
						<option>Sociology and Anthropology</option>
						<option>Statistics and Computer Information Systems</option>
						<option>Women's Studies</option>
					</select>
				</div>

				<div  class="hide_question student question">
					What is your major?<br />
					<select name="major" class="student">
						<option value="">---</option>
						<option>Undeclared</option>
						<option>Accountancy</option>
						<option>Ad Hoc Major</option>
						<option>Actuarial Science</option>
						<option>Art History and Theatre (Ad Hoc)</option>
						<option>Arts Administration (Ad Hoc)</option>
						<option>Asian & Asian American Studies (Ad Hoc)</option>
						<option>Biological Sciences</option>
						<option>Business Journalism</option>
						<option>Business Writing</option>
						<option>Computer Information Systems</option>
						<option>Corporate Communication</option>
						<option>Economics</option>
						<option>English</option>
						<option>Finance</option>
						<option>Graphic Communication</option>
						<option>History</option>
						<option>Industrial/Organizational Psychology</option>
						<option>International Business</option>
						<option>Journalism</option>
						<option>Management</option>
						<option>Management of Musical Enterprises</option>
						<option>Marketing Management</option>
						<option>Mathematics</option>
						<option>Modern Languages & Comparative Literature (Ad Hoc)</option>
						<option>Music</option>
						<option>Natural Sciences (Ad Hoc)</option>
						<option>Philosophy</option>
						<option>Political Science</option>
						<option>Psychology</option>
						<option>Public Affairs</option>
						<option>Real Estate</option>
						<option>Religion and Culture (Ad Hoc)</option>
						<option>Sociology</option>
						<option>Spanish</option>
						<option>Statistics</option>
						<option>Statistics & Quantitative Modeling</option>
					</select>
				</div>
			</div> <?php 	// End the person / role / info div -- left column ?>
	
			<div class="use-data temp hide_question"> <?php 	// Start right column ?>
			<h3>Using this site</h3>
				<div class="hide_question professor question">
					Is this a course website? <br />
					<select name="course_website" class="professor">
						<option value="">---</option>
						<option>Yes</option>
						<option>No</option>
					</select>
				</div>

				<div class="hide_question course_website question">
				Course Name:
				<input type="text" name="course_name" class="course_website" size="38">
				</div>

				<div class="course_website hide_question question">
					Course Number (and section if you have it):
					<input type="text" name="course_number" class="course_website" size="16">
				</div>

				<div class="hide_question purpose question">
					What is the primary use for this blog?<br />
					<select name="purpose">
						<option value="">---</option>
						<option value="personal">Personal Blog</option>
						<option value="research">Research Blog</option>
						<option value="portfolio">Portfolio</option>
						<option value="other">Other</option>
					</select>
					<br />
					<div class="hide_question use_other">
						Please specify: <input name="use-other" class="purpose">
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