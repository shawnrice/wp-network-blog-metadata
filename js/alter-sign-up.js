/*
 
	Adds new fields in the register and create new blog forms

 */

(function($) {
	$(document).ready(function() {
		$('<table id="nbm_table_form" class="standard-form" style="width:100%"><tbody><tr id="nbm_intro_message"><th colspan="2"><span>Please take a moment to tell us a little bit about your <b>Blogs @ Baruch site</b>. This information will be available only to the <b>B@B</b> administrators and will be used simply to help us understand how our users are using our site in order to determine how we can improve the overall experience for our current and future users. You can change these answers later.</span></th></tr><tr class="form-field"><th>I\'m a... </th><td><select name="role" class="role"><option value="">---</option><option>Professor</option><option>Student</option><option>Staff</option></select></td></tr><tr id="department" class="hide_question professor-staff question" placeholder="" title="department"><th>What department are you in?</th><br /><td><select name="department" class="professor-staff"><option value="">---</option><option>Accountancy</option><option>American Studies</option><option>Arts and Sciences Ad Hoc Programs</option><option>Asian and Asian American Studies</option><option>Black and Latino Studies</option><option>Communication Studies</option><option>Economics and Finance</option><option>Education</option><option>English</option><option>Film Studies</option><option>Fine and Performing Arts</option><option>Global Studies</option><option>History</option><option>Interdisciplinary Programs and Courses</option><option>Jewish Studies</option><option>Journalism and the Writing Professions</option><option>Latin American and Caribbean Studies</option><option>Law</option><option>Library Department</option><option>Management</option><option>Marketing and International Business</option><option>Mathematics</option><option>Modern Languages and Comparative Literature</option><option>Natural Sciences</option><option>Philosophy</option><option>Physical and Health Education</option><option>Political Science</option><option>Psychology</option><option>Public Affairs</option><option>Real Estate</option><option>Religion and Culture</option><option>Sociology and Anthropology</option><option>Statistics and Computer Information Systems</option><option>Women\'s Studies</option></select></td></tr><tr class="hide_question student question"><th>What is your major?</th><td><select name="major" class="hide_question student"><option value="">---</option><option>Undeclared</option><option>Accountancy</option><option>Ad Hoc Major</option><option>Actuarial Science</option><option>Art History and Theatre (Ad Hoc)</option><option>Arts Administration (Ad Hoc)</option><option>Asian & Asian American Studies (Ad Hoc)</option><option>Biological Sciences</option><option>Business Journalism</option><option>Business Writing</option><option>Computer Information Systems</option><option>Corporate Communication</option><option>Economics</option><option>English</option><option>Finance</option><option>Graphic Communication</option><option>History</option><option>Industrial/Organizational Psychology</option><option>International Business</option><option>Journalism</option><option>Management</option><option>Management of Musical Enterprises</option><option>Marketing Management</option><option>Mathematics</option><option>Modern Languages & Comparative Literature (Ad Hoc)</option><option>Music</option><option>Natural Sciences (Ad Hoc)</option><option>Philosophy</option><option>Political Science</option><option>Psychology</option><option>Public Affairs</option><option>Real Estate</option><option>Religion and Culture (Ad Hoc)</option><option>Sociology</option><option>Spanish</option><option>Statistics</option><option>Statistics & Quantitative Modeling</option></select></td></tr><tr class="hide_question professor question"><th>Is this a course website?</th><td><select name="course_website" class="professor"><option value="">---</option><option>Yes</option><option>No</option></select></td></tr><tr class="hide_question course_website question"><th>Course Name:</th><td><input type="text" name="course_name" class="course_website professor" size="38"></td></tr><tr class="hide_question course_website question"><th>Course Number (and section if you have it):</th><td><input type="text" name="course_number" class="course_website professor" size="16"></td></tr><tr class="hide_question purpose question"><th>What is the primary use for this blog?</th><td><select class="purpose" name="purpose"><option value="">---</option><option value="personal">Personal Blog</option><option value="research">Research Blog</option><option value="portfolio">Portfolio</option><option value="other">Other</option></select></tr><tr class="hide_question use_other"><th class="hide_question use_other">Please specify:</th><td><input name="use_other" class="purpose"></td></tr></tbody></table>').insertBefore('.submit')}
)})(jQuery);

(function($) {
	$(document).ready(function() {
		
		
		/* Checks to see if this is a create a new site page */
		if ( document.getElementById('setupform') ) {
//			alert('Create New Blog Page');

		}
		/* Checks to see if this is a register a new user page */
		if ( document.getElementById('signup_form') ) {
			$('#nbm_table_form').addClass('hide_question');
			$('input[name="signup_with_blog"]').change(function(){
					if ( $(this).prop('checked') == true ) { /* If sign up with blog is checked, then show the form table */
						$('#nbm_table_form').show();
					} else if ( $(this).prop('checked') == false ) { /* If it is unchecked, then reset values and hide the form table */
						$('#nbm_table_form').hide();
						$('.professor , .staff , .student , .professor-staff , .use_other , .purpose , .course_website input').hide();
						$('.professor , .student , .professor-staff , .use_other , .purpose select').hide();
						$('.professor , .student , .use_other , .purpose , .staff , .role , .professor-staff , .course_website input').val('');
						$('.professor , .student , .professor-staff , .purpose , .use_other , .role select').val('');
					}
			});
			if ( $('input[name="signup_with_blog"]').prop('checked') == true) { /* If the box is already checked, then make the form table visible */
				$('#nbm_table_form').removeClass('hide_question');
			}
			
		}
		
		/* General methods to handle the table form itself in regards to visibility of fields (dependency) and resetting values */
		$('select[name="role"]').change(function() {
			if ($(this).val() === "Professor") {
				$('.student , .staff , .purpose').hide();
				$('.student , .staff , .purpose select').val('');
				setTimeout(function(){
						$('.professor , .professor-staff').show();}, 10);
			}
			else if ($(this).val() === "Student") {
				$('.professor , .staff, .professor-staff , .course_website').hide();
				// Reset some values if they were put in...
				$('.professor , .staff , .professor-staff , course_website input').val('');
				$('.professor , .professor-staff select').val('');

				setTimeout(function(){
					$('.student , .purpose').show();}, 10);
			}
			else if ($(this).val() === "Staff") {
				$('.professor , .student').hide();		
				// Reset some values if they were put in...
				$('.course_website , .professor , .student input').val('');
				$('.course_website , .student select').val('');
				setTimeout(function(){
					$('.staff , .professor-staff , .purpose').show();}, 10);

			}
			else if ($(this).val() === "") {
				$('.professor , .staff , .student , .professor-staff , .use_other , .purpose , .course_website input').hide();
				$('.professor , .student , .professor-staff , .use_other , .purpose select').hide();
				$('.professor , .student , .use_other , .purpose , .staff , .professor-staff , .course_website input').val('');
				$('.professor , .student , .professor-staff , .purpose , .use_other select').val('');
			}
		});
		$('select[name="course_website"]').change(function() {
			if ($(this).val() === "Yes") {
				$('.purpose').hide();
				$('.purpose select').val('');
				setTimeout(function(){
					$('.course_website').show();}, 10);
			}
			else if ($(this).val() === "No") {
				$('.course_website').hide();
				$('.course_website input').val('');
				setTimeout(function(){
					$('.purpose').show();}, 10);

				// Reset some values if they were put in...
			}
			else if ($(this).val() === "") {
				$('.course_website , .purpose').hide();

				// Reset some values if they were put in...
				$('.course_website input').val('');
				$('.purpose select').val('');
			}
		});

		$('select[name="purpose"]').change(function() {
			if ($(this).val() === "other") {
				$('.use_other , .use-other').show();		
			}
			else {
				$('.use_other').hide();
			}
		});
	}
)})(jQuery);

