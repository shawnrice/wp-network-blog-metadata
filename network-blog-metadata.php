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



// Hook the nbm_append_signup into the signup_blogform action
add_action( 'wpmu_new_blog' , 'nbm_append_signup' , 10, 0);
add_action( 'signup_blogform' , 'nbm_append_signup' , 10, 0);
function nbm_append_signup() {
// Function to append the form to the create a new blog page

//  Enqueue the javascript to reset values and hide fields
	wp_register_script( 'hide-field-js', plugins_url( '/js/hide.field.js', __FILE__ ) );
	wp_enqueue_script( 'hide-field-js' );


// Get the values from the $_POST array so as to fill them back in when a registration fails
	if (!empty( $_POST) ) {
		$nbm_err['role'] = $_POST['role'];
		$nbm_err['department'] = $_POST['department'];
		$nbm_err['major'] = $_POST['major'];
		$nbm_err['program'] = $_POST['program'];
		$nbm_err['course_website'] = $_POST['course_website'];
		$nbm_err['course_name'] = $_POST['course_name'];
		$nbm_err['course_number'] = $_POST['course_number'];
		$nbm_err['purpose'] = $_POST['purpose'];
		$nbm_err['use_other'] = $_POST['use_other'];
	}

	if (! ( isset( $_POST['submit'] ) && ( $_POST['submit'] == 'Create Site' ) ) ) {
	?>
	<h4>Metadata:</h4>
	<div id="nbm">
		<div id="nbm_intro">
			<span><p>Please take a moment to tell us a little bit about your <strong>Blogs @ Baruch site</strong>. This information will be available only to the <strong>B@B</strong> administrators and will be used simply to help us understand how our users are using our site in order to determine how we can improve the overall experience for our current and future users. You can change these answers later.</p></span>
		</div>
		<div>
			<label for="role"><?php _e( 'Role:' ) ?></label>				
			<p><select name="role" id="role">
				<option value="">---</option>
				<option<?php if ( $nbm_err['role'] == 'Professor' ) echo ' selected';?>>Professor</option>
				<option<?php if ( $nbm_err['role'] == 'Student' ) echo ' selected';?>>Student</option>
				<option<?php if ( $nbm_err['role'] == 'Staff' ) echo ' selected';?>>Staff</option>
			</select></p>
		</div>
		<div id="department" class="<?php if (!( $nbm_err['role'] == 'Professor' ) ) echo 'hide_question '; ?>professor question">
			<label for="department"><?php _e( 'Department:' ) ?></label>				
			<select name="department" class="professor">
				<option value="">---</option>
				<option <?php if ( $nbm_err['department'] == "Accountancy") echo 'selected';?>>Accountancy</option>
				<option <?php if ( $nbm_err['department'] == "American Studies") echo 'selected';?>>American Studies</option>
				<option <?php if ( $nbm_err['department'] == "Arts and Sciences Ad Hoc Programs") echo 'selected';?>>Arts and Sciences Ad Hoc Programs</option>
				<option <?php if ( $nbm_err['department'] == "Asian and Asian American Studies") echo 'selected';?>>Asian and Asian American Studies</option>
				<option <?php if ( $nbm_err['department'] == "Black and Latino Studies") echo 'selected';?>>Black and Latino Studies</option>
				<option <?php if ( $nbm_err['department'] == "Communication Studies") echo 'selected';?>>Communication Studies</option>
				<option <?php if ( $nbm_err['department'] == "Economics and Finance") echo 'selected';?>>Economics and Finance</option>
				<option <?php if ( $nbm_err['department'] == "Education") echo 'selected';?>>Education</option>
				<option <?php if ( $nbm_err['department'] == "English") echo 'selected';?>>English</option>
				<option <?php if ( $nbm_err['department'] == "Film Studies") echo 'selected';?>>Film Studies</option>
				<option <?php if ( $nbm_err['department'] == "Fine and Performing Arts") echo 'selected';?>>Fine and Performing Arts</option>
				<option <?php if ( $nbm_err['department'] == "Global Studies") echo 'selected';?>>Global Studies</option>
				<option <?php if ( $nbm_err['department'] == "History") echo 'selected';?>>History</option>
				<option <?php if ( $nbm_err['department'] == "Interdisciplinary Programs and Courses") echo 'selected';?>>Interdisciplinary Programs and Courses</option>
				<option <?php if ( $nbm_err['department'] == "Jewish Studies") echo 'selected';?>>Jewish Studies</option>
				<option <?php if ( $nbm_err['department'] == "Journalism and the Writing Professions") echo 'selected';?>>Journalism and the Writing Professions</option>
				<option <?php if ( $nbm_err['department'] == "Latin American and Caribbean Studies") echo 'selected';?>>Latin American and Caribbean Studies</option>
				<option <?php if ( $nbm_err['department'] == "Law") echo 'selected';?>>Law</option>
				<option <?php if ( $nbm_err['department'] == "Library Department") echo 'selected';?>>Library Department</option>
				<option <?php if ( $nbm_err['department'] == "Management") echo 'selected';?>>Management</option>
				<option <?php if ( $nbm_err['department'] == "Marketing and International Business") echo 'selected';?>>Marketing and International Business</option>
				<option <?php if ( $nbm_err['department'] == "Mathematics") echo 'selected';?>>Mathematics</option>
				<option <?php if ( $nbm_err['department'] == "Modern Languages and Comparative Literature") echo 'selected';?>>Modern Languages and Comparative Literature</option>
				<option <?php if ( $nbm_err['department'] == "Natural Sciences") echo 'selected';?>>Natural Sciences</option>
				<option <?php if ( $nbm_err['department'] == "Philosophy") echo 'selected';?>>Philosophy</option>
				<option <?php if ( $nbm_err['department'] == "Physical and Health Education") echo 'selected';?>>Physical and Health Education</option>
				<option <?php if ( $nbm_err['department'] == "Political Science") echo 'selected';?>>Political Science</option>
				<option <?php if ( $nbm_err['department'] == "Psychology") echo 'selected';?>>Psychology</option>
				<option <?php if ( $nbm_err['department'] == "Public Affairs") echo 'selected';?>>Public Affairs</option>
				<option <?php if ( $nbm_err['department'] == "Real Estate") echo 'selected';?>>Real Estate</option>
				<option <?php if ( $nbm_err['department'] == "Religion and Culture") echo 'selected';?>>Religion and Culture</option>
				<option <?php if ( $nbm_err['department'] == "Sociology and Anthropology") echo 'selected';?>>Sociology and Anthropology</option>
				<option <?php if ( $nbm_err['department'] == "Statistics and Computer Information Systems") echo 'selected';?>>Statistics and Computer Information Systems</option>
				<option <?php if ( $nbm_err['department'] == "Women's Studies") echo 'selected';?>>Women's Studies</option>
			</select>
		</div>
		<div id="major" class="<?php if (!( $nbm_err['role'] == 'Student' ) ) echo 'hide_question ';?> student question">
			<label for="major"><?php _e( 'Major:' ) ?></label>				
			<select name="major" class="student">
				<option value="">---</option>
				<option<?php if ( $nbm_err['major'] == "Undeclared") echo " selected";?>>Undeclared</option>
				<option<?php if ( $nbm_err['major'] == "Accountancy") echo " selected";?>>Accountancy</option>
				<option<?php if ( $nbm_err['major'] == "Arts and Sciences Ad Hoc Major") echo " selected";?>>Arts and Sciences Ad Hoc Major</option>
				<option<?php if ( $nbm_err['major'] == "Actuarial Science") echo " selected";?>>Actuarial Science</option>
				<option<?php if ( $nbm_err['major'] == "Biological and Natural Sciences") echo " selected";?>>Biological and Natural Sciences</option>
				<option<?php if ( $nbm_err['major'] == "Business Communication") echo " selected";?>>Business Communication</option>
				<option<?php if ( $nbm_err['major'] == "Business Journalism") echo " selected";?>>Business Journalism</option>
				<option<?php if ( $nbm_err['major'] == "Business Writing") echo " selected";?>>Business Writing</option>
				<option<?php if ( $nbm_err['major'] == "Corporate Communication") echo " selected";?>>Corporate Communication</option>
				<option<?php if ( $nbm_err['major'] == "Computer Information Systems") echo " selected";?>>Computer Information Systems</option>
				<option<?php if ( $nbm_err['major'] == "Economics") echo " selected";?>>Economics</option>
				<option<?php if ( $nbm_err['major'] == "English") echo " selected";?>>English</option>
				<option<?php if ( $nbm_err['major'] == "Finance") echo " selected";?>>Finance</option>
				<option<?php if ( $nbm_err['major'] == "Graphic Communication") echo " selected";?>>Graphic Communication</option>
				<option<?php if ( $nbm_err['major'] == "History") echo " selected";?>>History</option>
				<option<?php if ( $nbm_err['major'] == "Industrial and Organizational Psychology") echo " selected";?>>Industrial and Organizational Psychology</option>
				<option<?php if ( $nbm_err['major'] == "International Business") echo " selected";?>>International Business</option>
				<option<?php if ( $nbm_err['major'] == "Journalism") echo " selected";?>>Journalism</option>
				<option<?php if ( $nbm_err['major'] == "Journalism and Creative Writing") echo " selected";?>>Journalism and Creative Writing</option>
				<option<?php if ( $nbm_err['major'] == "Management") echo " selected";?>>Management</option>
				<option<?php if ( $nbm_err['major'] == "Marketing Management") echo " selected";?>>Marketing Management</option>
				<option<?php if ( $nbm_err['major'] == "Mathematics") echo " selected";?>>Mathematics</option>
				<option<?php if ( $nbm_err['major'] == "Music") echo " selected";?>>Music (including Management of Musical Enterprises)</option>
				<option<?php if ( $nbm_err['major'] == "Philosophy") echo " selected";?>>Philosophy</option>
				<option<?php if ( $nbm_err['major'] == "Political Science") echo " selected";?>>Political Science</option>
				<option<?php if ( $nbm_err['major'] == "Psychology") echo " selected";?>>Psychology</option>
				<option<?php if ( $nbm_err['major'] == "Public Affairs") echo " selected";?>>Public Affairs</option>
				<option<?php if ( $nbm_err['major'] == "Quantitative Methods and Modeling") echo " selected";?>>Quantitative Methods and Modeling</option>
				<option<?php if ( $nbm_err['major'] == "Real Estate and Metropolitan Development") echo " selected";?>>Real Estate and Metropolitan Development</option>
				<option<?php if ( $nbm_err['major'] == "Sociology") echo " selected";?>>Sociology</option>
				<option<?php if ( $nbm_err['major'] == "Spanish") echo " selected";?>>Spanish</option>
				<option<?php if ( $nbm_err['major'] == "Statistics") echo " selected";?>>Statistics (BA)</option>
				<option<?php if ( $nbm_err['major'] == "Statistics and Quantitative Modeling") echo " selected";?>>Statistics and Quantitative Modeling (BBA)</option>
			</select>
		</div>

		<div id="staff" class="<?php if (!( $nbm_err['role'] == 'Staff' ) ) echo 'hide_question ';?> staff question">
			<label for="program"><?php _e( 'Program:' ) ?></label>				
			<select name="program" class="staff">
				<option value="">---</option>
				<option <?php if ( $nbm_err['program'] == "Accountancy (MS)") echo 'selected';?>>Accountancy (MS)</option>
				<option <?php if ( $nbm_err['program'] == "Accountancy and CPA (MBA)") echo 'selected';?>>Accountancy and CPA (MBA)</option>
				<option <?php if ( $nbm_err['program'] == "American Studies Program") echo 'selected';?>>American Studies Program</option>
				<option <?php if ( $nbm_err['program'] == "Arts and Sciences Ad Hoc Programs") echo 'selected';?>>Arts and Sciences Ad Hoc Programs</option>
				<option <?php if ( $nbm_err['program'] == "Asian and Asian American Studies") echo 'selected';?>>Asian and Asian American Studies</option>
				<option <?php if ( $nbm_err['program'] == "Baruch Survey Research Unit") echo 'selected';?>>Baruch Survey Research Unit</option>
				<option <?php if ( $nbm_err['program'] == "Bernard L. Schwartz Communication Institute") echo 'selected';?>>Bernard L. Schwartz Communication Institute</option>
				<option <?php if ( $nbm_err['program'] == "Bert W. Wasserman Department of Economics and Finance") echo 'selected';?>>Bert W. Wasserman Department of Economics and Finance</option>
				<option <?php if ( $nbm_err['program'] == "CCI - Corporate Communication International") echo 'selected';?>>CCI - Corporate Communication International</option>
				<option <?php if ( $nbm_err['program'] == "Center for Equality, Pluralism and Policy") echo 'selected';?>>Center for Equality, Pluralism and Policy</option>
				<option <?php if ( $nbm_err['program'] == "Center for Innovation and Leadership in Government") echo 'selected';?>>Center for Innovation and Leadership in Government</option>
				<option <?php if ( $nbm_err['program'] == "Center for Nonprofit Strategy and Management") echo 'selected';?>>Center for Nonprofit Strategy and Management</option>
				<option <?php if ( $nbm_err['program'] == "Center for the Study of Business and Government (CSBG)") echo 'selected';?>>Center for the Study of Business and Government (CSBG)</option>
				<option <?php if ( $nbm_err['program'] == "Computer Center for Visually Impaired People") echo 'selected';?>>Computer Center for Visually Impaired People</option>
				<option <?php if ( $nbm_err['program'] == "Continuing and Professional Studies") echo 'selected';?>>Continuing and Professional Studies</option>
				<option <?php if ( $nbm_err['program'] == "CUNY Institute for Demographic Research") echo 'selected';?>>CUNY Institute for Demographic Research</option>
				<option <?php if ( $nbm_err['program'] == "Decision Sciences") echo 'selected';?>>Decision Sciences</option>
				<option <?php if ( $nbm_err['program'] == "Department of Black and Latino Studies") echo 'selected';?>>Department of Black and Latino Studies</option>
				<option <?php if ( $nbm_err['program'] == "Department of Communication Studies") echo 'selected';?>>Department of Communication Studies</option>
				<option <?php if ( $nbm_err['program'] == "Department of English") echo 'selected';?>>Department of English</option>
				<option <?php if ( $nbm_err['program'] == "Department of Fine and Performing Arts") echo 'selected';?>>Department of Fine and Performing Arts</option>
				<option <?php if ( $nbm_err['program'] == "Department of History") echo 'selected';?>>Department of History</option>
				<option <?php if ( $nbm_err['program'] == "Department of Journalism and the Writing Professions") echo 'selected';?>>Department of Journalism and the Writing Professions</option>
				<option <?php if ( $nbm_err['program'] == "Department of Law") echo 'selected';?>>Department of Law</option>
				<option <?php if ( $nbm_err['program'] == "Department of Management") echo 'selected';?>>Department of Management</option>
				<option <?php if ( $nbm_err['program'] == "Department of Marketing and International Business") echo 'selected';?>>Department of Marketing and International Business</option>
				<option <?php if ( $nbm_err['program'] == "Department of Mathematics") echo 'selected';?>>Department of Mathematics</option>
				<option <?php if ( $nbm_err['program'] == "Department of Modern Languages and Comparative Literature") echo 'selected';?>>Department of Modern Languages and Comparative Literature</option>
				<option <?php if ( $nbm_err['program'] == "Department of Natural Sciences") echo 'selected';?>>Department of Natural Sciences</option>
				<option <?php if ( $nbm_err['program'] == "Department of Philosophy") echo 'selected';?>>Department of Philosophy</option>
				<option <?php if ( $nbm_err['program'] == "Department of Political Science") echo 'selected';?>>Department of Political Science</option>
				<option <?php if ( $nbm_err['program'] == "Department of Psychology") echo 'selected';?>>Department of Psychology</option>
				<option <?php if ( $nbm_err['program'] == "Department of Sociology and Anthropology") echo 'selected';?>>Department of Sociology and Anthropology</option>
				<option <?php if ( $nbm_err['program'] == "Department of Statistics and Computer Information Systems") echo 'selected';?>>Department of Statistics and Computer Information Systems</option>
				<option <?php if ( $nbm_err['program'] == "Dual-Degree Program in Nursing Administration and Public Administration") echo 'selected';?>>Dual-Degree Program in Nursing Administration and Public Administration</option>
				<option <?php if ( $nbm_err['program'] == "Economics") echo 'selected';?>>Economics</option>
				<option <?php if ( $nbm_err['program'] == "Education Program") echo 'selected';?>>Education Program</option>
				<option <?php if ( $nbm_err['program'] == "Entrepreneurship (MS)") echo 'selected';?>>Entrepreneurship (MS)</option>
				<option <?php if ( $nbm_err['program'] == "Executive MBA Program") echo 'selected';?>>Executive MBA Program</option>
				<option <?php if ( $nbm_err['program'] == "Executive MPA") echo 'selected';?>>Executive MPA</option>
				<option <?php if ( $nbm_err['program'] == "Executive MS in Analysis of Financial Statements, Internal Operations, and Risk Assessment") echo 'selected';?>>Executive MS in Analysis of Financial Statements, Internal Operations, and Risk Assessment</option>
				<option <?php if ( $nbm_err['program'] == "Executive MS in Business Computer Information Systems") echo 'selected';?>>Executive MS in Business Computer Information Systems</option>
				<option <?php if ( $nbm_err['program'] == "Executive MS in Finance") echo 'selected';?>>Executive MS in Finance</option>
				<option <?php if ( $nbm_err['program'] == "Executive MS in Industrial and Labor Relations (MSILR)") echo 'selected';?>>Executive MS in Industrial and Labor Relations (MSILR)</option>
				<option <?php if ( $nbm_err['program'] == "Executive MS in Taxation") echo 'selected';?>>Executive MS in Taxation</option>
				<option <?php if ( $nbm_err['program'] == "Film Studies Program") echo 'selected';?>>Film Studies Program</option>
				<option <?php if ( $nbm_err['program'] == "Finance") echo 'selected';?>>Finance</option>
				<option <?php if ( $nbm_err['program'] == "General MBA Option") echo 'selected';?>>General MBA Option</option>
				<option <?php if ( $nbm_err['program'] == "Global Studies Program") echo 'selected';?>>Global Studies Program</option>
				<option <?php if ( $nbm_err['program'] == "Health Care Administration") echo 'selected';?>>Health Care Administration</option>
				<option <?php if ( $nbm_err['program'] == "Industrial and Organizational Psychology") echo 'selected';?>>Industrial and Organizational Psychology</option>
				<option <?php if ( $nbm_err['program'] == "Information Systems (MBA)") echo 'selected';?>>Information Systems (MBA)</option>
				<option <?php if ( $nbm_err['program'] == "Information Systems (MS)") echo 'selected';?>>Information Systems (MS)</option>
				<option <?php if ( $nbm_err['program'] == "Interdisciplinary Programs and Courses") echo 'selected';?>>Interdisciplinary Programs and Courses</option>
				<option <?php if ( $nbm_err['program'] == "International Business") echo 'selected';?>>International Business</option>
				<option <?php if ( $nbm_err['program'] == "Jewish Studies Center") echo 'selected';?>>Jewish Studies Center</option>
				<option <?php if ( $nbm_err['program'] == "Jewish Studies Program") echo 'selected';?>>Jewish Studies Program</option>
				<option <?php if ( $nbm_err['program'] == "Joint JD and MBA Program (external)") echo 'selected';?>>Joint JD and MBA Program (external)</option>
				<option <?php if ( $nbm_err['program'] == "Latin American and Caribbean Studies") echo 'selected';?>>Latin American and Caribbean Studies</option>
				<option <?php if ( $nbm_err['program'] == "Lawrence N. Field Center for Entrepreneurship") echo 'selected';?>>Lawrence N. Field Center for Entrepreneurship</option>
				<option <?php if ( $nbm_err['program'] == "Library Department") echo 'selected';?>>Library Department</option>
				<option <?php if ( $nbm_err['program'] == "MA in Corporate Communication") echo 'selected';?>>MA in Corporate Communication</option>
				<option <?php if ( $nbm_err['program'] == "MA in Mental Health Counseling") echo 'selected';?>>MA in Mental Health Counseling</option>
				<option <?php if ( $nbm_err['program'] == "Management and Entrepreneurship (MBA)") echo 'selected';?>>Management and Entrepreneurship (MBA)</option>
				<option <?php if ( $nbm_err['program'] == "Management and Operations Management") echo 'selected';?>>Management and Operations Management</option>
				<option <?php if ( $nbm_err['program'] == "Management and Organizational Behavior-Human Resource Management") echo 'selected';?>>Management and Organizational Behavior-Human Resource Management</option>
				<option <?php if ( $nbm_err['program'] == "Management and Sustainable Business") echo 'selected';?>>Management and Sustainable Business</option>
				<option <?php if ( $nbm_err['program'] == "Marketing (MBA)") echo 'selected';?>>Marketing (MBA)</option>
				<option <?php if ( $nbm_err['program'] == "Marketing (MS)") echo 'selected';?>>Marketing (MS)</option>
				<option <?php if ( $nbm_err['program'] == "Master of Public Administration Program") echo 'selected';?>>Master of Public Administration Program</option>
				<option <?php if ( $nbm_err['program'] == "MS in Financial Engineering") echo 'selected';?>>MS in Financial Engineering</option>
				<option <?php if ( $nbm_err['program'] == "MS in Industrial and Organizational Psychology") echo 'selected';?>>MS in Industrial and Organizational Psychology</option>
				<option <?php if ( $nbm_err['program'] == "MSEd in Educational Leadership") echo 'selected';?>>MSEd in Educational Leadership</option>
				<option <?php if ( $nbm_err['program'] == "MSEd in Higher Education Administration") echo 'selected';?>>MSEd in Higher Education Administration</option>
				<option <?php if ( $nbm_err['program'] == "MSEd Programs (SPA)") echo 'selected';?>>MSEd Programs (SPA)</option>
				<option <?php if ( $nbm_err['program'] == "National Urban Fellows — MPA") echo 'selected';?>>National Urban Fellows — MPA</option>
				<option <?php if ( $nbm_err['program'] == "New York Census Research Data Center") echo 'selected';?>>New York Census Research Data Center</option>
				<option <?php if ( $nbm_err['program'] == "Physical and Health Education") echo 'selected';?>>Physical and Health Education</option>
				<option <?php if ( $nbm_err['program'] == "Public Affairs Program") echo 'selected';?>>Public Affairs Program</option>
				<option <?php if ( $nbm_err['program'] == "Quantitative Methods and Modeling") echo 'selected';?>>Quantitative Methods and Modeling</option>
				<option <?php if ( $nbm_err['program'] == "Real Estate (MBA)") echo 'selected';?>>Real Estate (MBA)</option>
				<option <?php if ( $nbm_err['program'] == "Real Estate (MS)") echo 'selected';?>>Real Estate (MS)</option>
				<option <?php if ( $nbm_err['program'] == "Real Estate Program") echo 'selected';?>>Real Estate Program</option>
				<option <?php if ( $nbm_err['program'] == "Religion and Culture Program") echo 'selected';?>>Religion and Culture Program</option>
				<option <?php if ( $nbm_err['program'] == "Robert Zicklin Center for Corporate Integrity") echo 'selected';?>>Robert Zicklin Center for Corporate Integrity</option>
				<option <?php if ( $nbm_err['program'] == "School of Public Affairs") echo 'selected';?>>School of Public Affairs</option>
				<option <?php if ( $nbm_err['program'] == "Stan Ross Department of Accountancy") echo 'selected';?>>Stan Ross Department of Accountancy</option>
				<option <?php if ( $nbm_err['program'] == "Statistics (MBA)") echo 'selected';?>>Statistics (MBA)</option>
				<option <?php if ( $nbm_err['program'] == "Statistics (MS)") echo 'selected';?>>Statistics (MS)</option>
				<option <?php if ( $nbm_err['program'] == "Steven L. Newman Real Estate Institute") echo 'selected';?>>Steven L. Newman Real Estate Institute</option>
				<option <?php if ( $nbm_err['program'] == "Taxation (MBA)") echo 'selected';?>>Taxation (MBA)</option>
				<option <?php if ( $nbm_err['program'] == "Taxation (MS)") echo 'selected';?>>Taxation (MS)</option>
				<option <?php if ( $nbm_err['program'] == "The Baruch MBA in Health Care Administration") echo 'selected';?>>The Baruch MBA in Health Care Administration</option>
				<option <?php if ( $nbm_err['program'] == "The Professional Certificate in Taxation (PCT)") echo 'selected';?>>The Professional Certificate in Taxation (PCT)</option>
				<option <?php if ( $nbm_err['program'] == "Wasserman Trading Floor and Subotnick Financial Services Center") echo 'selected';?>>Wasserman Trading Floor and Subotnick Financial Services Center</option>
				<option <?php if ( $nbm_err['program'] == "Weissman Center for International Business") echo 'selected';?>>Weissman Center for International Business</option>
				<option <?php if ( $nbm_err['program'] == "Weissman School of Arts and Sciences") echo 'selected';?>>Weissman School of Arts and Sciences</option>
				<option <?php if ( $nbm_err['program'] == "Women's Studies Program") echo 'selected';?>>Women's Studies Program</option>
				<option <?php if ( $nbm_err['program'] == "Zicklin School Of Business") echo 'selected';?>>Zicklin School Of Business</option>
			</select>
		</div>

		<div id="course_website" class="<?php if (!( $nbm_err['role'] == 'Professor' ) ) echo 'hide_question '; ?>professor question">
			<label for="course_website"><?php _e( 'Is this a course website?' ) ?></label>				
			<select name="course_website" class="professor">
				<option value=""<?php if (is_null( $nbm_err['course_website'] ) ) echo ' selected';?>>---</option>
				<option<?php if ( $nbm_err['course_website'] == 'Yes' ) echo ' selected';?>>Yes</option>
				<option<?php if ( ( $nbm_err['role'] == 'Professor' ) && ( $nbm_err['course_website'] == 'No' ) ) echo ' selected';?>>No</option>
			</select>
		</div>
		<div id="course_name" class="<?php if (!( ( $nbm_err['role'] == 'Professor' ) && ( $nbm_err['course_website'] == 'Yes' ) ) ) echo 'hide_question '; ?>course_website question">
			<label for="course_name"><?php _e( 'Course Name:' ) ?></label>
			<input type="text" name="course_name" class="course_website professor" size="38"<?php if ( $nbm_err['course_name'] ) echo 'value="'.esc_html( $nbm_err['course_name'] ) .'"';?>>
		</div>
			<div id="course_number" class="<?php if (!( ( $nbm_err['role'] == 'Professor' ) && ( $nbm_err['course_website']== 'Yes' ) ) ) echo 'hide_question '; ?>course_website question">
			<label for="course_number"><?php _e( 'Course number (and section, if you have it):' ) ?></label>				
			<input type="text" name="course_number" class="course_website professor" size="16"<?php if ( $nbm_err['course_number'] ) echo 'value="'.esc_html( $nbm_err['course_number'] ) .'"';?>>
		</div>
		<div id="purpose" class="<?php if ( ( ( $nbm_err['role'] == 'Professor' ) && ( $nbm_err['course_website'] == 'Yes' ) ) || ( is_null($nbm_err['role'] ) ) )echo 'hide_question '; ?>purpose question">
			<label for="purpose"><?php _e( 'What will the primary purpose of this blog be?' ) ?></label>				
			<select name="purpose">
				<option value="">---</option>
				<option <?php if ( $nbm_err['purpose'] == 'Personal Blog' ) echo ' selected';?>>Personal Blog</option>
				<option <?php if ( $nbm_err['purpose'] == 'Research Blog' ) echo ' selected';?>>Research Blog</option>
				<option <?php if ( $nbm_err['purpose'] == 'Portfolio' ) echo ' selected';?>>Portfolio</option>
<?php			$purpose = $nbm_err['purpose'];?>
				<option <?php if ( $nbm_err['purpose'] == 'Other' ) echo ' selected';?>>Other</option>
			</select>
		</div>
		<div id="use_other" class="<?php if ( $nbm_err['purpose'] != 'Other' ) echo 'hide_question '; ?>use_other">
			<label for="use_other"><?php _e( 'Please specify:' ) ?></label>				
			<input name="use_other" class="purpose"<?php if ( ! is_null( $nbm_err['use_other'] ) ) echo ' value="' . esc_html( $nbm_err['use_other'] ) . '"';?>>
		</div>
	</div>
	<div>
		<p>&nbsp;</p>
	</div>
		<?php
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

			if ($_POST['course_website'] == '"Yes"') {
				$purpose = '"course_website"';
			} else if ($_POST['purpose'] == '"Other"') {
				$purpose = $_POST['use_other'];
			} else {
				$purpose = $_POST['purpose'];
			}

			// Finished replacing values within the $_POST array in order to insert the correct ones.
			// The update sql should never be called
			if ( ! ( empty( $row_exists ) ) ) {
				$sql = 'UPDATE ' . $tablename . ' 
						SET 
						`user_role` = ' . $_POST["role"] . ',
						`blog_intended_use` = ' . $purpose . ',
						`course_name` = ' . $_POST["course_name"] . ',
						`course_number` = ' . $_POST["course_number"] . ',
						`major` = ' . $_POST["major"] . ',
						`department` = ' . $_POST["department"] . ',
						`program` = ' . $_POST["program"] . '
						WHERE `blog_id` = ' . $blog_id;
			} else {
				$sql = 'INSERT INTO ' . $tablename . ' VALUES (' .
						$blog_id . ', ' .
						$_POST["role"] . ', ' .
						$purpose . ', ' .
						$_POST["course_name"] . ', ' .
						$_POST["course_number"] . ', ' . '
						`major` = ' . $_POST["major"] . ', 
						`department` = ' . $_POST["department"] . ',
						`program` = ' . $_POST["program"] . ')';
			}
			$wpdb->query($wpdb->prepare($sql)); // Insert into the DB after preparing it.
		}
}

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
		echo "<div id='my_admin_notice' class='updated fade'><p>".__('Please take a moment to fill out some information about your blog on the ')."<a href=\"$url/wp-admin/options-general.php?page=nbm_answers\">settings page</a>.</p></div>";
    }
}
add_action('admin_notices', 'nbm_empty_settings_flag');


function nbm_admin_menu() {				
	// Hooks into the dashboard to create the per-site Admin Menu

	$dir = plugins_url( 'images/data_16.png' , __FILE__ );
    $page_hook_suffix = add_options_page( 'NBM Options', 'Network Blog Metadata', 'manage_options', 'nbm_answers', 'nbm_manage_menu', $dir );

    add_action('admin_print_scripts-' . $page_hook_suffix, 'nbm_admin_scripts');
}

function nbm_manage_menu() {			
	// Function that processes the form variables for the per-site Admin Menu
	// it also calls on the function to write the content of the per-site Admin Men
	   	global $wpdb, $blog_id;
	   	$tablename = $wpdb->base_prefix . "nbm_data"; // This is a site-wide table
	
		// These next calls should be coming from the network admin on an install script or activation script or something like that...
		// The creation of the table shouldn't exist in the regular user admin menus
		$table_exists = $wpdb->get_results("SHOW TABLES LIKE '".$tablename."'");
		if (empty($table_exists)) {	
			// Again, just checks to make sure that the table exists... I could add a "die" function here and return a message saying that the network admin needs to fix the installation. What should we do here? Right now it just creates the table if it doesn't exist.
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
		} else if ($_POST['purpose'] == '"Other"') {
			if (is_null($_POST['use_other'])) $purpose = '"Other"';
			else $purpose = $_POST['use_other'];
		} else {
			$purpose = $_POST['purpose'];
		}
		
		// Finished replacing values within the $_POST array in order to insert the correct ones.
		if (!(empty($row_exists))) {
			$sql = 'UPDATE ' . $tablename . ' 
					SET 
					`role` = ' . $_POST["role"] . ',
					`purpose` = ' . $purpose . ',
					`course_name` = ' . $_POST["course_name"] . ',
					`course_number` = ' . $_POST["course_number"] . ',
					`major` = ' . $_POST["major"] . ',
					`department` = ' . $_POST["department"] . ',
					`program` = ' . $_POST["program"] . ' WHERE `blog_id` = ' . $blog_id;
		} else {
			$sql = 'INSERT INTO ' . $tablename . ' VALUES (' .
				$blog_id . ', ' .
				$_POST["role"] . ', ' .
				$purpose . ', ' .
				$_POST["course_name"] . ', ' .
				$_POST["course_number"] . ', ' . '
				`major` = ' . $_POST["major"] . ', 
				`department` = ' . $_POST["department"] . ')';
		}


		$wpdb->query($wpdb->prepare($sql)); // Insert into the DB after preparing it.
		echo '<div class="updated fade" style="margin: 13px;">Thank you for submitting the metadata.</div>';
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
	
	
	global $wpdb, $blog_id;

	$tablename = $wpdb->base_prefix . "nbm_data"; // This is a site-wide table


	//  Enqueue the javascript to reset values and hide fields
		wp_register_script( 'hide-field-js', plugins_url( '/js/hide.field.js', __FILE__ ) );
		wp_enqueue_script( 'hide-field-js' );

	// Setup the SQL query
		$sql = 	'SELECT * from ' . $tablename .
				' WHERE `blog_id` = ' . $blog_id;
		
		$data = $wpdb->get_row($sql , ARRAY_A); 			// get_row method works here because there is only ever one row that matches.
			
		ob_start();	// Put this into an output buffer so that we can return the entire text to whichever function needs it.
		 nbm_update_sql_table(); // minor check that will be taken out soon. !!!!!!!

?>

   <div class="wrap">

<?php 
	$dir = plugins_url( 'images/data_32.png' , __FILE__ );
   	echo '<div id="icon-themes" class="icon32" style="background: url(\''.$dir.'\') no-repeat; background-size: 95%;"><br></div>'; 
?>

    <h2>Blog Metadata</h2>
	<form method="post" class="standard-form" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
	<div id="nbm">
		<div id="nbm_intro">
			<span><p>Please take a moment to tell us a little bit about your <strong>Blogs @ Baruch site</strong>. This information will be available only to the <strong>B@B</strong> administrators and will be used simply to help us understand how our users are using our site in order to determine how we can improve the overall experience for our current and future users. You can change these answers later.</p></span>
		</div>
		<div>
		<div>
			<label for="role"><?php _e( 'Role:' ) ?></label>				
			<p><select name="role" id="role">
				<option value="">---</option>
				<option<?php if ( $data['role'] == 'Professor' ) echo ' selected';?>>Professor</option>
				<option<?php if ( $data['role'] == 'Student' ) echo ' selected';?>>Student</option>
				<option<?php if ( $data['role'] == 'Staff' ) echo ' selected';?>>Staff</option>
			</select></p>
		</div>
		<div id="department" class="<?php if (!( $data['role'] == 'Professor' ) ) echo 'hide_question '; ?>professor question">
			<label for="department"><?php _e( 'Department:' ) ?></label>				
			<select name="department" class="professor">
				<option value="">---</option>
				<option <?php if ( $data['department'] == "Accountancy") echo 'selected';?>>Accountancy</option>
				<option <?php if ( $data['department'] == "American Studies") echo 'selected';?>>American Studies</option>
				<option <?php if ( $data['department'] == "Arts and Sciences Ad Hoc Programs") echo 'selected';?>>Arts and Sciences Ad Hoc Programs</option>
				<option <?php if ( $data['department'] == "Asian and Asian American Studies") echo 'selected';?>>Asian and Asian American Studies</option>
				<option <?php if ( $data['department'] == "Black and Latino Studies") echo 'selected';?>>Black and Latino Studies</option>
				<option <?php if ( $data['department'] == "Communication Studies") echo 'selected';?>>Communication Studies</option>
				<option <?php if ( $data['department'] == "Economics and Finance") echo 'selected';?>>Economics and Finance</option>
				<option <?php if ( $data['department'] == "Education") echo 'selected';?>>Education</option>
				<option <?php if ( $data['department'] == "English") echo 'selected';?>>English</option>
				<option <?php if ( $data['department'] == "Film Studies") echo 'selected';?>>Film Studies</option>
				<option <?php if ( $data['department'] == "Fine and Performing Arts") echo 'selected';?>>Fine and Performing Arts</option>
				<option <?php if ( $data['department'] == "Global Studies") echo 'selected';?>>Global Studies</option>
				<option <?php if ( $data['department'] == "History") echo 'selected';?>>History</option>
				<option <?php if ( $data['department'] == "Interdisciplinary Programs and Courses") echo 'selected';?>>Interdisciplinary Programs and Courses</option>
				<option <?php if ( $data['department'] == "Jewish Studies") echo 'selected';?>>Jewish Studies</option>
				<option <?php if ( $data['department'] == "Journalism and the Writing Professions") echo 'selected';?>>Journalism and the Writing Professions</option>
				<option <?php if ( $data['department'] == "Latin American and Caribbean Studies") echo 'selected';?>>Latin American and Caribbean Studies</option>
				<option <?php if ( $data['department'] == "Law") echo 'selected';?>>Law</option>
				<option <?php if ( $data['department'] == "Library Department") echo 'selected';?>>Library Department</option>
				<option <?php if ( $data['department'] == "Management") echo 'selected';?>>Management</option>
				<option <?php if ( $data['department'] == "Marketing and International Business") echo 'selected';?>>Marketing and International Business</option>
				<option <?php if ( $data['department'] == "Mathematics") echo 'selected';?>>Mathematics</option>
				<option <?php if ( $data['department'] == "Modern Languages and Comparative Literature") echo 'selected';?>>Modern Languages and Comparative Literature</option>
				<option <?php if ( $data['department'] == "Natural Sciences") echo 'selected';?>>Natural Sciences</option>
				<option <?php if ( $data['department'] == "Philosophy") echo 'selected';?>>Philosophy</option>
				<option <?php if ( $data['department'] == "Physical and Health Education") echo 'selected';?>>Physical and Health Education</option>
				<option <?php if ( $data['department'] == "Political Science") echo 'selected';?>>Political Science</option>
				<option <?php if ( $data['department'] == "Psychology") echo 'selected';?>>Psychology</option>
				<option <?php if ( $data['department'] == "Public Affairs") echo 'selected';?>>Public Affairs</option>
				<option <?php if ( $data['department'] == "Real Estate") echo 'selected';?>>Real Estate</option>
				<option <?php if ( $data['department'] == "Religion and Culture") echo 'selected';?>>Religion and Culture</option>
				<option <?php if ( $data['department'] == "Sociology and Anthropology") echo 'selected';?>>Sociology and Anthropology</option>
				<option <?php if ( $data['department'] == "Statistics and Computer Information Systems") echo 'selected';?>>Statistics and Computer Information Systems</option>
				<option <?php if ( $data['department'] == "Women's Studies") echo 'selected';?>>Women's Studies</option>
			</select>
		</div>
		<div id="major" class="<?php if (!( $data['role'] == 'Student' ) ) echo 'hide_question ';?> student question">
			<label for="major"><?php _e( 'Major:' ) ?></label>				
			<select name="major" class="student">
				<option value="">---</option>
				<option<?php if ( $data['major'] == "Undeclared") echo " selected";?>>Undeclared</option>
				<option<?php if ( $data['major'] == "Accountancy") echo " selected";?>>Accountancy</option>
				<option<?php if ( $data['major'] == "Arts and Sciences Ad Hoc Major") echo " selected";?>>Arts and Sciences Ad Hoc Major</option>
				<option<?php if ( $data['major'] == "Actuarial Science") echo " selected";?>>Actuarial Science</option>
				<option<?php if ( $data['major'] == "Biological and Natural Sciences") echo " selected";?>>Biological and Natural Sciences</option>
				<option<?php if ( $data['major'] == "Business Communication") echo " selected";?>>Business Communication</option>
				<option<?php if ( $data['major'] == "Business Journalism") echo " selected";?>>Business Journalism</option>
				<option<?php if ( $data['major'] == "Business Writing") echo " selected";?>>Business Writing</option>
				<option<?php if ( $data['major'] == "Corporate Communication") echo " selected";?>>Corporate Communication</option>
				<option<?php if ( $data['major'] == "Computer Information Systems") echo " selected";?>>Computer Information Systems</option>
				<option<?php if ( $data['major'] == "Economics") echo " selected";?>>Economics</option>
				<option<?php if ( $data['major'] == "English") echo " selected";?>>English</option>
				<option<?php if ( $data['major'] == "Finance") echo " selected";?>>Finance</option>
				<option<?php if ( $data['major'] == "Graphic Communication") echo " selected";?>>Graphic Communication</option>
				<option<?php if ( $data['major'] == "History") echo " selected";?>>History</option>
				<option<?php if ( $data['major'] == "Industrial and Organizational Psychology") echo " selected";?>>Industrial and Organizational Psychology</option>
				<option<?php if ( $data['major'] == "International Business") echo " selected";?>>International Business</option>
				<option<?php if ( $data['major'] == "Journalism") echo " selected";?>>Journalism</option>
				<option<?php if ( $data['major'] == "Journalism and Creative Writing") echo " selected";?>>Journalism and Creative Writing</option>
				<option<?php if ( $data['major'] == "Management") echo " selected";?>>Management</option>
				<option<?php if ( $data['major'] == "Marketing Management") echo " selected";?>>Marketing Management</option>
				<option<?php if ( $data['major'] == "Mathematics") echo " selected";?>>Mathematics</option>
				<option<?php if ( $data['major'] == "Music") echo " selected";?>>Music (including Management of Musical Enterprises)</option>
				<option<?php if ( $data['major'] == "Philosophy") echo " selected";?>>Philosophy</option>
				<option<?php if ( $data['major'] == "Political Science") echo " selected";?>>Political Science</option>
				<option<?php if ( $data['major'] == "Psychology") echo " selected";?>>Psychology</option>
				<option<?php if ( $data['major'] == "Public Affairs") echo " selected";?>>Public Affairs</option>
				<option<?php if ( $data['major'] == "Quantitative Methods and Modeling") echo " selected";?>>Quantitative Methods and Modeling</option>
				<option<?php if ( $data['major'] == "Real Estate and Metropolitan Development") echo " selected";?>>Real Estate and Metropolitan Development</option>
				<option<?php if ( $data['major'] == "Sociology") echo " selected";?>>Sociology</option>
				<option<?php if ( $data['major'] == "Spanish") echo " selected";?>>Spanish</option>
				<option<?php if ( $data['major'] == "Statistics") echo " selected";?>>Statistics (BA)</option>
				<option<?php if ( $data['major'] == "Statistics and Quantitative Modeling") echo " selected";?>>Statistics and Quantitative Modeling (BBA)</option>
			</select>
		</div>

		<div id="staff" class="<?php if (!( $data['role'] == 'Staff' ) ) echo 'hide_question ';?> staff question">
			<label for="program"><?php _e( 'Program:' ) ?></label>				
			<select name="program" class="staff">
				<option value="">---</option>
				<option <?php if ( $data['program'] == "Accountancy (MS)") echo 'selected';?>>Accountancy (MS)</option>
				<option <?php if ( $data['program'] == "Accountancy and CPA (MBA)") echo 'selected';?>>Accountancy and CPA (MBA)</option>
				<option <?php if ( $data['program'] == "American Studies Program") echo 'selected';?>>American Studies Program</option>
				<option <?php if ( $data['program'] == "Arts and Sciences Ad Hoc Programs") echo 'selected';?>>Arts and Sciences Ad Hoc Programs</option>
				<option <?php if ( $data['program'] == "Asian and Asian American Studies") echo 'selected';?>>Asian and Asian American Studies</option>
				<option <?php if ( $data['program'] == "Baruch Survey Research Unit") echo 'selected';?>>Baruch Survey Research Unit</option>
				<option <?php if ( $data['program'] == "Bernard L. Schwartz Communication Institute") echo 'selected';?>>Bernard L. Schwartz Communication Institute</option>
				<option <?php if ( $data['program'] == "Bert W. Wasserman Department of Economics and Finance") echo 'selected';?>>Bert W. Wasserman Department of Economics and Finance</option>
				<option <?php if ( $data['program'] == "CCI - Corporate Communication International") echo 'selected';?>>CCI - Corporate Communication International</option>
				<option <?php if ( $data['program'] == "Center for Equality, Pluralism and Policy") echo 'selected';?>>Center for Equality, Pluralism and Policy</option>
				<option <?php if ( $data['program'] == "Center for Innovation and Leadership in Government") echo 'selected';?>>Center for Innovation and Leadership in Government</option>
				<option <?php if ( $data['program'] == "Center for Nonprofit Strategy and Management") echo 'selected';?>>Center for Nonprofit Strategy and Management</option>
				<option <?php if ( $data['program'] == "Center for the Study of Business and Government (CSBG)") echo 'selected';?>>Center for the Study of Business and Government (CSBG)</option>
				<option <?php if ( $data['program'] == "Computer Center for Visually Impaired People") echo 'selected';?>>Computer Center for Visually Impaired People</option>
				<option <?php if ( $data['program'] == "Continuing and Professional Studies") echo 'selected';?>>Continuing and Professional Studies</option>
				<option <?php if ( $data['program'] == "CUNY Institute for Demographic Research") echo 'selected';?>>CUNY Institute for Demographic Research</option>
				<option <?php if ( $data['program'] == "Decision Sciences") echo 'selected';?>>Decision Sciences</option>
				<option <?php if ( $data['program'] == "Department of Black and Latino Studies") echo 'selected';?>>Department of Black and Latino Studies</option>
				<option <?php if ( $data['program'] == "Department of Communication Studies") echo 'selected';?>>Department of Communication Studies</option>
				<option <?php if ( $data['program'] == "Department of English") echo 'selected';?>>Department of English</option>
				<option <?php if ( $data['program'] == "Department of Fine and Performing Arts") echo 'selected';?>>Department of Fine and Performing Arts</option>
				<option <?php if ( $data['program'] == "Department of History") echo 'selected';?>>Department of History</option>
				<option <?php if ( $data['program'] == "Department of Journalism and the Writing Professions") echo 'selected';?>>Department of Journalism and the Writing Professions</option>
				<option <?php if ( $data['program'] == "Department of Law") echo 'selected';?>>Department of Law</option>
				<option <?php if ( $data['program'] == "Department of Management") echo 'selected';?>>Department of Management</option>
				<option <?php if ( $data['program'] == "Department of Marketing and International Business") echo 'selected';?>>Department of Marketing and International Business</option>
				<option <?php if ( $data['program'] == "Department of Mathematics") echo 'selected';?>>Department of Mathematics</option>
				<option <?php if ( $data['program'] == "Department of Modern Languages and Comparative Literature") echo 'selected';?>>Department of Modern Languages and Comparative Literature</option>
				<option <?php if ( $data['program'] == "Department of Natural Sciences") echo 'selected';?>>Department of Natural Sciences</option>
				<option <?php if ( $data['program'] == "Department of Philosophy") echo 'selected';?>>Department of Philosophy</option>
				<option <?php if ( $data['program'] == "Department of Political Science") echo 'selected';?>>Department of Political Science</option>
				<option <?php if ( $data['program'] == "Department of Psychology") echo 'selected';?>>Department of Psychology</option>
				<option <?php if ( $data['program'] == "Department of Sociology and Anthropology") echo 'selected';?>>Department of Sociology and Anthropology</option>
				<option <?php if ( $data['program'] == "Department of Statistics and Computer Information Systems") echo 'selected';?>>Department of Statistics and Computer Information Systems</option>
				<option <?php if ( $data['program'] == "Dual-Degree Program in Nursing Administration and Public Administration") echo 'selected';?>>Dual-Degree Program in Nursing Administration and Public Administration</option>
				<option <?php if ( $data['program'] == "Economics") echo 'selected';?>>Economics</option>
				<option <?php if ( $data['program'] == "Education Program") echo 'selected';?>>Education Program</option>
				<option <?php if ( $data['program'] == "Entrepreneurship (MS)") echo 'selected';?>>Entrepreneurship (MS)</option>
				<option <?php if ( $data['program'] == "Executive MBA Program") echo 'selected';?>>Executive MBA Program</option>
				<option <?php if ( $data['program'] == "Executive MPA") echo 'selected';?>>Executive MPA</option>
				<option <?php if ( $data['program'] == "Executive MS in Analysis of Financial Statements, Internal Operations, and Risk Assessment") echo 'selected';?>>Executive MS in Analysis of Financial Statements, Internal Operations, and Risk Assessment</option>
				<option <?php if ( $data['program'] == "Executive MS in Business Computer Information Systems") echo 'selected';?>>Executive MS in Business Computer Information Systems</option>
				<option <?php if ( $data['program'] == "Executive MS in Finance") echo 'selected';?>>Executive MS in Finance</option>
				<option <?php if ( $data['program'] == "Executive MS in Industrial and Labor Relations (MSILR)") echo 'selected';?>>Executive MS in Industrial and Labor Relations (MSILR)</option>
				<option <?php if ( $data['program'] == "Executive MS in Taxation") echo 'selected';?>>Executive MS in Taxation</option>
				<option <?php if ( $data['program'] == "Film Studies Program") echo 'selected';?>>Film Studies Program</option>
				<option <?php if ( $data['program'] == "Finance") echo 'selected';?>>Finance</option>
				<option <?php if ( $data['program'] == "General MBA Option") echo 'selected';?>>General MBA Option</option>
				<option <?php if ( $data['program'] == "Global Studies Program") echo 'selected';?>>Global Studies Program</option>
				<option <?php if ( $data['program'] == "Health Care Administration") echo 'selected';?>>Health Care Administration</option>
				<option <?php if ( $data['program'] == "Industrial and Organizational Psychology") echo 'selected';?>>Industrial and Organizational Psychology</option>
				<option <?php if ( $data['program'] == "Information Systems (MBA)") echo 'selected';?>>Information Systems (MBA)</option>
				<option <?php if ( $data['program'] == "Information Systems (MS)") echo 'selected';?>>Information Systems (MS)</option>
				<option <?php if ( $data['program'] == "Interdisciplinary Programs and Courses") echo 'selected';?>>Interdisciplinary Programs and Courses</option>
				<option <?php if ( $data['program'] == "International Business") echo 'selected';?>>International Business</option>
				<option <?php if ( $data['program'] == "Jewish Studies Center") echo 'selected';?>>Jewish Studies Center</option>
				<option <?php if ( $data['program'] == "Jewish Studies Program") echo 'selected';?>>Jewish Studies Program</option>
				<option <?php if ( $data['program'] == "Joint JD and MBA Program (external)") echo 'selected';?>>Joint JD and MBA Program (external)</option>
				<option <?php if ( $data['program'] == "Latin American and Caribbean Studies") echo 'selected';?>>Latin American and Caribbean Studies</option>
				<option <?php if ( $data['program'] == "Lawrence N. Field Center for Entrepreneurship") echo 'selected';?>>Lawrence N. Field Center for Entrepreneurship</option>
				<option <?php if ( $data['program'] == "Library Department") echo 'selected';?>>Library Department</option>
				<option <?php if ( $data['program'] == "MA in Corporate Communication") echo 'selected';?>>MA in Corporate Communication</option>
				<option <?php if ( $data['program'] == "MA in Mental Health Counseling") echo 'selected';?>>MA in Mental Health Counseling</option>
				<option <?php if ( $data['program'] == "Management and Entrepreneurship (MBA)") echo 'selected';?>>Management and Entrepreneurship (MBA)</option>
				<option <?php if ( $data['program'] == "Management and Operations Management") echo 'selected';?>>Management and Operations Management</option>
				<option <?php if ( $data['program'] == "Management and Organizational Behavior-Human Resource Management") echo 'selected';?>>Management and Organizational Behavior-Human Resource Management</option>
				<option <?php if ( $data['program'] == "Management and Sustainable Business") echo 'selected';?>>Management and Sustainable Business</option>
				<option <?php if ( $data['program'] == "Marketing (MBA)") echo 'selected';?>>Marketing (MBA)</option>
				<option <?php if ( $data['program'] == "Marketing (MS)") echo 'selected';?>>Marketing (MS)</option>
				<option <?php if ( $data['program'] == "Master of Public Administration Program") echo 'selected';?>>Master of Public Administration Program</option>
				<option <?php if ( $data['program'] == "MS in Financial Engineering") echo 'selected';?>>MS in Financial Engineering</option>
				<option <?php if ( $data['program'] == "MS in Industrial and Organizational Psychology") echo 'selected';?>>MS in Industrial and Organizational Psychology</option>
				<option <?php if ( $data['program'] == "MSEd in Educational Leadership") echo 'selected';?>>MSEd in Educational Leadership</option>
				<option <?php if ( $data['program'] == "MSEd in Higher Education Administration") echo 'selected';?>>MSEd in Higher Education Administration</option>
				<option <?php if ( $data['program'] == "MSEd Programs (SPA)") echo 'selected';?>>MSEd Programs (SPA)</option>
				<option <?php if ( $data['program'] == "National Urban Fellows — MPA") echo 'selected';?>>National Urban Fellows — MPA</option>
				<option <?php if ( $data['program'] == "New York Census Research Data Center") echo 'selected';?>>New York Census Research Data Center</option>
				<option <?php if ( $data['program'] == "Physical and Health Education") echo 'selected';?>>Physical and Health Education</option>
				<option <?php if ( $data['program'] == "Public Affairs Program") echo 'selected';?>>Public Affairs Program</option>
				<option <?php if ( $data['program'] == "Quantitative Methods and Modeling") echo 'selected';?>>Quantitative Methods and Modeling</option>
				<option <?php if ( $data['program'] == "Real Estate (MBA)") echo 'selected';?>>Real Estate (MBA)</option>
				<option <?php if ( $data['program'] == "Real Estate (MS)") echo 'selected';?>>Real Estate (MS)</option>
				<option <?php if ( $data['program'] == "Real Estate Program") echo 'selected';?>>Real Estate Program</option>
				<option <?php if ( $data['program'] == "Religion and Culture Program") echo 'selected';?>>Religion and Culture Program</option>
				<option <?php if ( $data['program'] == "Robert Zicklin Center for Corporate Integrity") echo 'selected';?>>Robert Zicklin Center for Corporate Integrity</option>
				<option <?php if ( $data['program'] == "School of Public Affairs") echo 'selected';?>>School of Public Affairs</option>
				<option <?php if ( $data['program'] == "Stan Ross Department of Accountancy") echo 'selected';?>>Stan Ross Department of Accountancy</option>
				<option <?php if ( $data['program'] == "Statistics (MBA)") echo 'selected';?>>Statistics (MBA)</option>
				<option <?php if ( $data['program'] == "Statistics (MS)") echo 'selected';?>>Statistics (MS)</option>
				<option <?php if ( $data['program'] == "Steven L. Newman Real Estate Institute") echo 'selected';?>>Steven L. Newman Real Estate Institute</option>
				<option <?php if ( $data['program'] == "Taxation (MBA)") echo 'selected';?>>Taxation (MBA)</option>
				<option <?php if ( $data['program'] == "Taxation (MS)") echo 'selected';?>>Taxation (MS)</option>
				<option <?php if ( $data['program'] == "The Baruch MBA in Health Care Administration") echo 'selected';?>>The Baruch MBA in Health Care Administration</option>
				<option <?php if ( $data['program'] == "The Professional Certificate in Taxation (PCT)") echo 'selected';?>>The Professional Certificate in Taxation (PCT)</option>
				<option <?php if ( $data['program'] == "Wasserman Trading Floor and Subotnick Financial Services Center") echo 'selected';?>>Wasserman Trading Floor and Subotnick Financial Services Center</option>
				<option <?php if ( $data['program'] == "Weissman Center for International Business") echo 'selected';?>>Weissman Center for International Business</option>
				<option <?php if ( $data['program'] == "Weissman School of Arts and Sciences") echo 'selected';?>>Weissman School of Arts and Sciences</option>
				<option <?php if ( $data['program'] == "Women's Studies Program") echo 'selected';?>>Women's Studies Program</option>
				<option <?php if ( $data['program'] == "Zicklin School Of Business") echo 'selected';?>>Zicklin School Of Business</option>
			</select>
		</div>
		<div id="course_website" class="<?php if (!( $data['role'] == 'Professor' ) ) echo 'hide_question '; ?>professor question">
			<label for="course_website"><?php _e( 'Is this a course website?' ) ?></label>				
			<select name="course_website" class="professor">
				<option value=""<?php if (is_null( $data['purpose'] ) ) echo ' selected';?>>---</option>
				<option<?php if ( $data['purpose'] == 'course_website' ) echo ' selected';?>>Yes</option>
				<option<?php if ( ( $data['role'] == 'Professor' ) && ( $data['purpose'] != 'course_website' ) ) echo ' selected';?>>No</option>
			</select>
		</div>
		<div id="course_name" class="<?php if (!( ( $data['role'] == 'Professor' ) && ( $data['purpose'] == 'course_website' ) ) ) echo 'hide_question '; ?>course_website question">
			<label for="course_name"><?php _e( 'Course Name:' ) ?></label>
			<input type="text" name="course_name" class="course_website professor" size="38"<?php if ( $data['course_name'] ) echo 'value="'.esc_html( $data['course_name'] ) .'"';?>>
		</div>
			<div id="course_number" class="<?php if (!( ( $data['role'] == 'Professor' ) && ( $data['purpose']== 'course_website' ) ) ) echo 'hide_question '; ?>course_website question">
			<label for="course_number"><?php _e( 'Course number (and section, if you have it):' ) ?></label>				
			<input type="text" name="course_number" class="course_website professor" size="16"<?php if ( $data['course_number'] ) echo 'value="'.esc_html( $data['course_number'] ) .'"';?>>
		</div>
		<div id="purpose" class="<?php if ( ( ( $data['role'] == 'Professor' ) && ( $data['purpose'] == 'course_website' ) ) || ( is_null($data['role'] ) ) )echo 'hide_question '; ?>purpose question">
			<label for="purpose"><?php _e( 'What will the primary purpose of this blog be?' ) ?></label>				
			<select name="purpose">
				<option value="">---</option>
				<option <?php if ( $data['purpose'] == 'Personal Blog' ) echo ' selected';?>>Personal Blog</option>
				<option <?php if ( $data['purpose'] == 'Research Blog' ) echo ' selected';?>>Research Blog</option>
				<option <?php if ( $data['purpose'] == 'Portfolio' ) echo ' selected';?>>Portfolio</option>
<?php			$purpose = $data['purpose'];?>
<?php 			$uses = array( 'Personal Blog' , 'Research Blog' , 'Portfolio' , 'course_website' , '' ); ?>
				<option <?php if ( !in_array( $data['purpose'] , $uses ) ) echo ' selected';?>>Other</option>
			</select>
		</div>
		<div id="use_other" class="<?php if ( in_array( $data['purpose'] , $uses ) ) echo 'hide_question '; ?>use_other">
			<label for="use_other"><?php _e( 'Please specify:' ) ?></label>				
			<input name="use_other" class="<?php if ( in_array( $data['purpose'] , $uses ) ) echo 'hide_question '; ?>purpose"<?php if ( !in_array( $data['purpose'] , $uses ) ) echo ' value="' . esc_html( $data['purpose'] ) . '"';?>>
		</div>
	</div>
	<div>
		<p>&nbsp;</p>
	</div>
	<div class="buttons">
		<input type="submit" />
	</div>
	</form>
</div>
	
	<?php
	$buffer = ob_get_contents(); 	// Put the output buffer into a variable
  	ob_end_clean();					// Stop capturing output and remove the output buffer to reduce memory usage

	return $buffer;					// Returns the text form

}


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

		$uses = array( 'course_website' => 0 , 'Personal Blog' => 0 , 'Portfolio' => 0 , 'Research Blog' => 0 , 'Other' => 0 ); // An array for the uses to check for the "Other field"

		// foreach statements that pulls the data from the SQL query into a usable array
		foreach ( $data as $datum ) {
			if ( ! ( isset( $null ) ) ) $null = 0;
			if ( ! ( isset( $student ) ) ) $student = 0;
			if ( ! ( isset( $professor ) ) ) $professor = 0;
			if ( ! ( isset( $staff ) ) ) $staff = 0;
			if ( ! ( isset( $course_website ) ) ) $course_website = 0;		

			if (is_null($datum['role'])) $null++;
			if ($datum['role'] == 'Student' ) $student++;
			if ($datum['role'] == 'Staff' ) $staff++;
			if ($datum['role'] == 'Professor' ) $professor++;
			if ($datum['purpose'] == 'course_website' ) {
				$course_website++;
				$uses['course_website']++;
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
						'course_name' ,
						'course_number',
						'major',
						'department',
						'program'
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
blog_id,role,purpose,course_name,course_number,major,department,program
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


// init
function nbm_array_to_csv_download($array, $header='', $filename = "blog_metadata.csv", $delimiter=",") {

	// Add a datestamp to the front of the filename.
	$filename = date('ymdHi') . '-' . $filename;

    // open raw memory as file so no temp files needed
    $f = fopen('php://memory', 'w'); 

    //input the header
    fputcsv($f, $header, $delimiter);

    // loop over the input array
    foreach ($array as $line) { 
        // generate csv lines from the inner arrays
        fputcsv($f, $line, $delimiter); 
    }
    // rewrind the "file" with the csv lines
    fseek($f, 0);
    // tell the browser it's going to be a csv file
    header('Content-Type: application/csv');
    // tell the browser we want to save it instead of displaying it
    header('Content-Disposition: attachement; filename="'.$filename.'"');
    // make php send the generated csv lines to the browser
    fpassthru($f);
    die();
}


function nbm_populate_null() {
	// Function populates null values in the wp_wpnbm_data table for each blog that doesn't exist in there.
	// I can hook this into an install function later.
	
	global $wpdb;
	$tablename = $wpdb->base_prefix . "nbm_data";
	
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
		$sql = 'INSERT INTO ' . $tablename . ' VALUES( ' . $id . ' , NULL , NULL , NULL , NULL , NULL , NULL , NULL )';
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


/***
****
Setup and teardown functions.
****

nbm_create_table(): creates the table
nbm_install(): install script
nbm_update_db_check(): checks to make sure the table schema is the correct version
nbm_uninstall(): needs to be written

***/

// Make sure that these options are for the base table and not a per-blog table.

global $nbm_db_version;
$nbm_db_version = '1.1'; // Current version

function nbm_create_table() {
	// Function to create the data table
	
   global $wpdb;
   $tablename = $wpdb->base_prefix . "nbm_data"; // General tablename
	
	add_option( "nbm_db_version", $nbm_db_version );	
	// Hard coded table, for now.
	// Changed column names: purpose, course_name, major, department
	$sql = "CREATE TABLE $tablename (
			  `blog_id` INT NOT NULL ,
			  `role` VARCHAR(45) NULL ,
			  `purpose` VARCHAR(45) NULL , 
			  `course_name` VARCHAR(128) NULL ,
			  `course_number` VARCHAR(45) NULL ,
			  `major` VARCHAR(128) NULL ,
			  `department` VARCHAR(128) NULL ,
			  `program` VARCHAR(128) NULL ,			  
			  PRIMARY KEY (`blog_id`) ,
			  UNIQUE KEY `blog_id_UNIQUE` (`blog_id` ASC)
			);";


		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' ); // To upgrade the table schema later
		dbDelta( $sql );
		
		update_option( "nbm_db_version", $nbm_db_version ); // Updates the table schema version
	  nbm_update_sql_table();
}

function nbm_update_sql_table() {

   global $wpdb;
   $tablename = $wpdb->base_prefix . "nbm_data"; // General tablename

	$t = count($wpdb->get_results("show columns from `$tablename` like 'program'"));

  	if (! $t ) {
  		$sql = ("ALTER TABLE `$tablename` ADD program VARCHAR(128) NULL");
  		$wpdb->get_results($sql);
   }
}


function nbm_install() {

	global $wpdb;
	$table_name = $wpdb->base_prefix . "nbm_data"; // Site-wide table
	$installed_db_version = get_option( "nbm_db_version" );
	
	if( $installed_db_version != $nbm_db_version ) {
		nbm_create_table(); // This function might just need to be incorporated here.
	}
	
}
register_activation_hook( __FILE__, 'nbm_install' );

function nbm_update_db_check() {
    global $nbm_db_version;
    if (get_site_option( 'nbm_db_version' ) != $nbm_db_version) {
        nbm_install();
    }
}
add_action( 'plugins_loaded', 'nbm_update_db_check' );

function nbm_uninstall() {

// Write function to drop the table, add in a js confirmation.

// Directions below:

// <script type="text/javascript">
// 		alert('Do you want to delete the NBM tables?');
// 		capture the output of the alert (or we might need to replace this with a different dialog.
//		Delete the tables if yes. Don't if no.
// </script>
// Return a message
// Data for NBM removed from the database.	
	
}

?>