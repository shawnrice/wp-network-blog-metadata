<?php

require_once('network-blog-metadata.php');

/***********
For the per-site Admin Menu
***********/

add_action( 'admin_init', 'nbm_admin_init' );
add_action( 'admin_menu', 'nbm_admin_menu' );						// Adds the Admin Menu for each blog

function nbm_admin_init() {				
	// Registers the javascript and css for the per-site Admin Menu
    wp_register_script( 'hide-field-js', plugins_url( '/js/hide.field.js', __FILE__ ) );
    wp_register_style( 'hide-questions', plugins_url( '/nbm-style.css', __FILE__ ) );

}

function nbm_admin_scripts() {			
	// Enqueues the javascript and css for the per-site Admin Menu
    wp_enqueue_script( 'hide-field-js' );
	wp_enqueue_style( 'hide-questions' );
}

function nbm_admin_menu() {				
	// Hooks into the dashboard to create the per-site Admin Menu
    $page_hook_suffix = add_menu_page( 'NBM Options', 'Network Blog Metadata', 'manage_options', 'nbm_answers', 'nbm_manage_menu', 'wp-content/plugins/network-blog-metadata/images/data.png' );

    add_action('admin_print_scripts-' . $page_hook_suffix, 'nbm_admin_scripts');
}

function nbm_manage_menu() {			
	// Function that processes the form variables for the per-site Admin Menu
	// it also calls on the function to write the content of the per-site Admin Men
	   	global $wpdb;
	   	$tablename = $wpdb->base_prefix . "wpnbm_data"; // This is a site-wide table
	
		// These next calls should be coming from the network admin on an install script or activation script or something like that...
		// The creation of the table shouldn't exist in the regular user admin menus
		$table_exists = $wpdb->get_results("SHOW TABLES LIKE '".$tablename."'");
		if (empty($table_exists)) {	
			// Again, just checks to make sure that the table exists... I could add a "die" function here and return a message saying that the network admin needs to fix the installation. What should we do here? Right now it just creates the table if it doesn't exist.
			nbm_create_table();
		}
		
		global $blog_id;

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
		} else if ($_POST['purpose'] == 'other') {
			if (is_null($_POST['use_other'])) $purpose = '"other"';
			else $purpose = $_POST['use_other'];
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
					`person_department` = ' . $_POST["department"] . '  WHERE `blog_id` = ' . $blog_id;
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
		echo '<div class="updated fade">Thank you for submitting the metadata.</div>';
		$buffer = print_nbm_data(); 					// Actually prints the content of the per-site Admin Menu
	 	echo $buffer;
    } else {
		$buffer = print_nbm_data(); 					// Actually prints the content of the per-site Admin Menu
		echo $buffer;
	}
}


	
/* 

	Function to print the data/form
	There should be a derivative function to call just the form so that we needn't parse through things on the add new site page.

*/


function print_nbm_data() {					
	// Function that prints the per-site Admin Menu
		
	//	I need to reimplement this for security reasons
	//
	//	if ( !current_user_can( 'manage_options' ) )  {
	//		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	//	}
	
   	global $wpdb, $blog_id, $return_bp;
   	$tablename = $wpdb->base_prefix . "wpnbm_data"; // This is a site-wide table


			$sql = 	'SELECT * from ' . $tablename .
					' WHERE `blog_id` = ' . $blog_id;
					
			$data = $wpdb->get_row($sql , ARRAY_A); 			// get_row method works here because there is only ever one row that matches.

	ob_start(); // Put this into an output buffer so that we can return the entire text to whichever function needs it.
	
	?>

	
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<div class="wpnbm">
			<p>Please take a moment to tell us a little bit about your <b>Blogs @ Baruch site</b>. This information will be available only to the <b>B@B</b> administrators and will be used simply to help us understand how our users are using our site in order to determine how we can improve the overall experience for our current and future users.</p>
			<div class="role-data"> <?php 	// Start left column ?>
				<div id="role" name="role">
					<h3>Who are you?</h3>

					<div class="question">
					<span style="margin: 0px 0px 5px -5px;">I'm a ...</span><br />
						<select name="role">
							<option value="">---</option>
							<option<?php if ($data['user_role'] == 'Professor') echo ' selected';?>>Professor</option>
							<option<?php if ($data['user_role'] == 'Student') echo ' selected';?>>Student</option>
							<option<?php if ($data['user_role'] == 'Staff') echo ' selected';?>>Staff</option>
						</select>
					</div>
				</div>

				<div id="department" class="<?php if (!(($data['user_role'] == 'Professor') || ($data['user_role'] == 'Staff'))) echo 'hide_question '; ?>professor-staff question">
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

				<div class="<?php if (!($data['user_role'] == 'Student')) echo 'hide_question ';?> student question">
					What is your major?<br />
					<select name="major" class="<?php if (!($data['user_role'] == 'Student')) echo 'hide_question ';?>student">
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
						<option<?php if ($data['student_major'] == "Industrial/Organizational Psychology") echo " selected";?>>Industrial/Organizational Psychology</option>
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
				<div class="<?php if (!($data['user_role'] == 'Professor')) echo 'hide_question '; ?>professor question">
					Is this a course website? <br />
					<select name="course_website" class="professor">
						<option value=""<?php if (is_null($data['blog_intended_use'])) echo ' selected';?>>---</option>
						<option<?php if ($data['blog_intended_use'] == 'course_website') echo ' selected';?>>Yes</option>
						<option<?php if (($data['user_role'] == 'Professor') && (!(is_null($data['blog_intended_use']))) && ($data['blog_intended_use'] != 'course_website')) echo ' selected';?>>No</option>
					</select>
				</div>

				<div class="<?php if (!(($data['user_role'] == 'Professor') && ($data['blog_intended_use'] == 'course_website'))) echo 'hide_question '; ?>course_website question">
					Course Name:
					<input type="text" name="course_name" class="course_website professor" size="38"<?php if ($data['course_title']) echo 'value="'.$data['course_title'].'"';?>>
				</div>

				<div class="<?php if (!(($data['user_role'] == 'Professor') && ($data['blog_intended_use']== 'course_website'))) echo 'hide_question '; ?>course_website question">
					Course Number (and section if you have it):
					<input type="text" name="course_number" class="course_website professor" size="16"<?php if ($data['course_number']) echo 'value="'.$data['course_number'].'"';?>>
				</div>

				<div class="<?php if (($data['user_role'] == 'Professor') && ($data['blog_intended_use']== 'course_website')) echo 'hide_question '; ?>purpose question">
					What is the primary use for this blog?<br />
					<select name="purpose">
						<option value="">---</option>
						<option value="personal"<?php if ($data['blog_intended_use'] == 'personal') echo ' selected';?>>Personal Blog</option>
						<option value="research"<?php if ($data['blog_intended_use'] == 'research') echo ' selected';?>>Research Blog</option>
						<option value="portfolio"<?php if ($data['blog_intended_use'] == 'portfolio') echo ' selected';?>>Portfolio</option>
<?php
						$blog_intended_use = $data['blog_intended_use'];
						$uses = array('course_website' , 'personal' , 'porfolio' , 'research' , 'other');?>
						<option value="other"<?php 
						if (((!(is_null($blog_intended_use))) && (!(in_array($blog_intended_use, $uses)))) || ($blog_intended_use == 'other')) echo ' selected';
						?>>Other</option>
					</select>
					<br />
					<div class="<?php if (((is_null($blog_intended_use))) || (!(in_array($blog_intended_use, $uses)))) echo 'hide_question '; ?>use_other">
						Please specify: <input name="use_other" class="purpose"<?php 
							if ((!(is_null($blog_intended_use))) && (!(in_array($blog_intended_use, $uses)))) echo ' value="' . $blog_intended_use . '"';
						?>>
					</div>
				</div>
			</div> <? // End the second column that shows the use-data -- right column ?>

		</div>
		<div class="buttons">
			<input type="submit" />
		</div>
	</form>
	
	<?php
	$buffer = ob_get_contents(); 	// Put the output buffer into a variable
  	ob_end_clean();					// Stop capturing output and remove the output buffer to reduce memory usage

	return $buffer;					// Returns the text form

}