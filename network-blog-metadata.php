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

function nbm_manage_menu() {
    /* Display our administration screen */
	echo '<div class="wrap">';
?>
<p>Please take a moment to tell us a little bit about your <b>Blogs @ Baruch site</b>. This information will be available only to the <b>B@B</b> administrators and will be used simply to help us understand how our users are using our site in order to determine how we can improve the overall experience for our current and future users.</p>
	Who are you?<br />

<?php
	/*  Currently, the classes are the name of the field the question is dependent on.
		We should find a more intelligent way to do this...
	*/
?>

<?php

	/*
	Class structures:
	1)	hide_question -- hides initially
	2)	dependent-on	
	3)	role (to erase)
	*/
?>
	
	<div id="role" name="role" style="margin: 5px 0 0 10px;">
		I'm a...<br />
		<input type="radio" name="role" value="professor"> Professor<br />
		<input type="radio" name="role" value="student"> Student<br />
		<input type="radio" name="role" value="staff"> Staff<br />
	</div>

	<div name="department" class="hide_question professor-staff">
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

	<div class="hide_question professor">
		Is this a course website? <br />
		<select name="course_website" class="professor">
			<option value="">---</option>
			<option>Yes</option>
			<option>No</option>
		</select>
	</div>


	<div class="hide_question course_website">
	Course Name:
	<input type="text" name="course_name" class="course_website" size="48">
	</div>


	<div class="course_website hide_question">
		Course Number (and section if you have it):
		<input type="text" name="course_number" class="course_website" size="24">
	</div>


	<div  class="hide_question student">
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

	<div class="hide_question purpose">
		What is the primary use for this blog?<br />
		<select name="purpose">
			<option value="">---</option>
			<option value="personal">Personal Blog</option>
			<option value="research">Research Blog</option>
			<option value="portfolio">Portfolio</option>
			<option value="other">Other</option>
		</select>
		<div id="use-other" class="hide_question">
			Please specify: <input name="use-other" class="purpose">
		</div>
	</div>
</div>
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