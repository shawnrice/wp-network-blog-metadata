<div id="department" class="<?php if (!( $data['role'] == 'Faculty' ) ) echo 'hide_question '; ?>faculty question">
	<label for="department"><?php _e( 'Department:' ) ?></label>				
	<select name="department" class="faculty">
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
		<option <?php if ( $data['program'] == "Freshman Orientation") echo 'selected';?>>Freshman</option>
		<option <?php if ( $data['department'] == "Global Studies") echo 'selected';?>>Global Studies</option>
		<option <?php if ( $data['department'] == "History") echo 'selected';?>>History</option>
		<option <?php if ( $data['department'] == "Interdisciplinary Programs and Classes") echo 'selected';?>>Interdisciplinary Programs and Classes</option>
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