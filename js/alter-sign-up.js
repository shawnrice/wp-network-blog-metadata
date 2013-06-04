/*
 * Add new field in /wp-admin/network/site-new.php
 * URI: http://stackoverflow.com/a/10372861/1287812
 */
(function($) {
    $(document).ready(function() {
$('<p></p><div class="wpnbm">').append($(	
'<span>Please take a moment to tell us a little bit about your <b>Blogs @ Baruch site</b>. This information will be available only to the <b>B@B</b> administrators and will be used simply to help us understand how our users are using our site in order to determine how we can improve the overall experience for our current and future users. You can change these answers later.</span>')).append($(
'<span style="margin: 0px 0px 5px -5px;">I\'m a ...</span><br />')).append($(
'<div class="role-data">')).append($(
'<div id="role" name="role">')).append($(
'<h3>Who are you?</h3>')).append($(
'<div class="question">')).append($(
'<span style="margin: 0px 0px 5px -5px;">I\'m a ...</span><br />')).append($(
'<input type="radio" name="role" value="professor"> Professor<br />')).append($(
'<input type="radio" name="role" value="student"> Student<br />')).append($(
'<input type="radio" name="role" value="staff"> Staff<br />')).append($(
'</div>')).append($(
'</div>')).append($(
'<div id="department" class="hide_question professor-staff question" placeholder="" title="department">')).append($(
'<span>What department are you in?</span><br /><select name="department" class="professor-staff"><option value="">---</option><option>Accountancy</option><option>American Studies</option><option>Arts and Sciences Ad Hoc Programs</option><option>Asian and Asian American Studies</option><option>Black and Latino Studies</option><option>Communication Studies</option><option>Economics and Finance</option><option>Education</option><option>English</option><option>Film Studies</option><option>Fine and Performing Arts</option><option>Global Studies</option><option>History</option><option>Interdisciplinary Programs and Courses</option><option>Jewish Studies</option><option>Journalism and the Writing Professions</option><option>Latin American and Caribbean Studies</option><option>Law</option><option>Library Department</option><option>Management</option><option>Marketing and International Business</option><option>Mathematics</option><option>Modern Languages and Comparative Literature</option><option>Natural Sciences</option><option>Philosophy</option><option>Physical and Health Education</option><option>Political Science</option><option>Psychology</option><option>Public Affairs</option><option>Real Estate</option><option>Religion and Culture</option><option>Sociology and Anthropology</option><option>Statistics and Computer Information Systems</option><option>Women\'s Studies</option></select>')).append($(
'</div>')).append($(
'<div class="hide_question student question"><span>What is your major?</span><br /><select name="major" class="hide_question student"><option value="">---</option><option>Undeclared</option><option>Accountancy</option><option>Ad Hoc Major</option><option>Actuarial Science</option><option>Art History and Theatre (Ad Hoc)</option><option>Arts Administration (Ad Hoc)</option><option>Asian & Asian American Studies (Ad Hoc)</option><option>Biological Sciences</option><option>Business Journalism</option><option>Business Writing</option><option>Computer Information Systems</option><option>Corporate Communication</option><option>Economics</option><option>English</option><option>Finance</option><option>Graphic Communication</option><option>History</option><option>Industrial/Organizational Psychology</option><option>International Business</option><option>Journalism</option><option>Management</option><option>Management of Musical Enterprises</option><option>Marketing Management</option><option>Mathematics</option><option>Modern Languages & Comparative Literature (Ad Hoc)</option><option>Music</option><option>Natural Sciences (Ad Hoc)</option><option>Philosophy</option><option>Political Science</option><option>Psychology</option><option>Public Affairs</option><option>Real Estate</option><option>Religion and Culture (Ad Hoc)</option><option>Sociology</option><option>Spanish</option><option>Statistics</option><option>Statistics & Quantitative Modeling</option></select>')).append($(
'</div>')).append($(
'</div>')).append($(
'<div class="hide_question use-data temp">')).append($(
'<h3>Using this site</h3>')).append($(
'<div class="hide_question professor question">')).append($(
'<span>Is this a course website?</span><br />')).append($(
'<select name="course_website" class="professor"><option value="">---</option><option>Yes</option><option>No</option></select>')).append($(
'</div>')).append($(
'<div class="hide_question course_website question">')).append($(
'<span>Course Name:</span>')).append($(
'<input type="text" name="course_name" class="course_website" size="38">')).append($(
'</div>')).append($(
'<div class="hide_question course_website question">')).append($(
'<span>Course Number (and section if you have it):</span>')).append($(
'<input type="text" name="course_number" class="course_website" size="16">')).append($(
'</div>')).append($(
'<div class="hide_question purpose question">')).append($(
'<span>What is the primary use for this blog?</span><br />')).append($(
'<select name="purpose"><option value="">---</option><option value="personal">Personal Blog</option><option value="research">Research Blog</option><option value="portfolio">Portfolio</option><option value="other">Other</option></select>')).append($(
'<br />')).append($(
'<div class="hide_question use_other">')).append($(
'Please specify: <input name="use_other" class="purpose">')).append($(
'</div>')).append($(
'</div>')).append($(
'</div>')).append($(
'</div>'))
.insertAfter('#wpbody-content table');
	    });
	})(jQuery);
	/*
			
			



*/