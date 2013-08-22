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
		<option <?php if ( $data['program'] == "Freshman Orientation") echo 'selected';?>>Freshman</option>
		<option <?php if ( $data['program'] == "General MBA Option") echo 'selected';?>>General MBA Option</option>
		<option <?php if ( $data['program'] == "Global Studies Program") echo 'selected';?>>Global Studies Program</option>
		<option <?php if ( $data['program'] == "Health Care Administration") echo 'selected';?>>Health Care Administration</option>
		<option <?php if ( $data['program'] == "Industrial and Organizational Psychology") echo 'selected';?>>Industrial and Organizational Psychology</option>
		<option <?php if ( $data['program'] == "Information Systems (MBA)") echo 'selected';?>>Information Systems (MBA)</option>
		<option <?php if ( $data['program'] == "Information Systems (MS)") echo 'selected';?>>Information Systems (MS)</option>
		<option <?php if ( $data['program'] == "Interdisciplinary Programs and Classes") echo 'selected';?>>Interdisciplinary Programs and Classes</option>
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