		<div id="major" class="<?php if ( !( $data['role'] == 'Student' ) ) echo 'hide_question ';?> student question">
			<label for="major"><?php _e( 'Major:' ) ?></label>
			<select name="major" class="student">
				<option value="">---</option>
				<option<?php if ( $data['major'] == "Undeclared" ) echo " selected";?>>Undeclared</option>
				<option<?php if ( $data['major'] == "Accountancy" ) echo " selected";?>>Accountancy</option>
				<option<?php if ( $data['major'] == "Arts and Sciences Ad Hoc Major" ) echo " selected";?>>Arts and Sciences Ad Hoc Major</option>
				<option<?php if ( $data['major'] == "Actuarial Science" ) echo " selected";?>>Actuarial Science</option>
				<option<?php if ( $data['major'] == "Biological and Natural Sciences" ) echo " selected";?>>Biological and Natural Sciences</option>
				<option<?php if ( $data['major'] == "Business Communication" ) echo " selected";?>>Business Communication</option>
				<option<?php if ( $data['major'] == "Business Journalism" ) echo " selected";?>>Business Journalism</option>
				<option<?php if ( $data['major'] == "Business Writing" ) echo " selected";?>>Business Writing</option>
				<option<?php if ( $data['major'] == "Corporate Communication" ) echo " selected";?>>Corporate Communication</option>
				<option<?php if ( $data['major'] == "Computer Information Systems" ) echo " selected";?>>Computer Information Systems</option>
				<option<?php if ( $data['major'] == "Economics" ) echo " selected";?>>Economics</option>
				<option<?php if ( $data['major'] == "English" ) echo " selected";?>>English</option>
				<option<?php if ( $data['major'] == "Finance" ) echo " selected";?>>Finance</option>
				<option<?php if ( $data['major'] == "Graphic Communication" ) echo " selected";?>>Graphic Communication</option>
				<option<?php if ( $data['major'] == "History" ) echo " selected";?>>History</option>
				<option<?php if ( $data['major'] == "Industrial and Organizational Psychology" ) echo " selected";?>>Industrial and Organizational Psychology</option>
				<option<?php if ( $data['major'] == "International Business" ) echo " selected";?>>International Business</option>
				<option<?php if ( $data['major'] == "Journalism" ) echo " selected";?>>Journalism</option>
				<option<?php if ( $data['major'] == "Journalism and Creative Writing" ) echo " selected";?>>Journalism and Creative Writing</option>
				<option<?php if ( $data['major'] == "Management" ) echo " selected";?>>Management</option>
				<option<?php if ( $data['major'] == "Marketing Management" ) echo " selected";?>>Marketing Management</option>
				<option<?php if ( $data['major'] == "Mathematics" ) echo " selected";?>>Mathematics</option>
				<option<?php if ( $data['major'] == "Music" ) echo " selected";?>>Music (including Management of Musical Enterprises)</option>
				<option<?php if ( $data['major'] == "Philosophy" ) echo " selected";?>>Philosophy</option>
				<option<?php if ( $data['major'] == "Political Science" ) echo " selected";?>>Political Science</option>
				<option<?php if ( $data['major'] == "Psychology" ) echo " selected";?>>Psychology</option>
				<option<?php if ( $data['major'] == "Public Affairs" ) echo " selected";?>>Public Affairs</option>
				<option<?php if ( $data['major'] == "Quantitative Methods and Modeling" ) echo " selected";?>>Quantitative Methods and Modeling</option>
				<option<?php if ( $data['major'] == "Real Estate and Metropolitan Development" ) echo " selected";?>>Real Estate and Metropolitan Development</option>
				<option<?php if ( $data['major'] == "Sociology" ) echo " selected";?>>Sociology</option>
				<option<?php if ( $data['major'] == "Spanish" ) echo " selected";?>>Spanish</option>
				<option<?php if ( $data['major'] == "Statistics" ) echo " selected";?>>Statistics (BA)</option>
				<option<?php if ( $data['major'] == "Statistics and Quantitative Modeling" ) echo " selected";?>>Statistics and Quantitative Modeling (BBA)</option>
			</select>
		</div>
