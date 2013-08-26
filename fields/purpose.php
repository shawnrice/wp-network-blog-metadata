		<div id="purpose" class="<?php if ( ( ( $data['role'] == 'Faculty' ) && ( $data['class_site'] == 'Yes' ) ) || ( is_null($data['role'] ) ) ) echo 'hide_question '; ?>purpose question">
			<label for="purpose"><?php _e( 'What kind of site will this be?' ) ?></label>

			<select id="nbm_purpose" name="purpose">
<?php
			if ( $data['role'] == 'Student' ) {
?>
				<option value="">---</option>
				<option value="Class website" <?php if ( $data['purpose'] == 'Class website' ) echo ' selected';?>>Class website</option>
				<option value="Club site" <?php if ( $data['purpose'] == 'Club site' ) echo ' selected';?>>Club site</option>
				<option value="Portfolio" <?php if ( $data['purpose'] == 'Portfolio' ) echo ' selected';?>>Portfolio</option>
				<option value="Personal/group blog" <?php if ( $data['purpose'] == 'Personal/group blog' ) echo ' selected';?>>Personal/group blog</option>
				<option value="Other"  <?php if ( $purpose_other ) echo ' selected';?>>Other</option>
<?php
			}

			if ( $data['role'] == 'Staff' ) {
?>	
				<option value="">---</option>
				<option value="Departmental site" <?php if ( $data['purpose'] == 'Departmental site' ) echo ' selected';?>>Departmental site</option>
				<option value="Project site" <?php if ( $data['purpose'] == 'Project site' ) echo ' selected';?>>Project site</option>
				<option value="Personal/group blog" <?php if ( $data['purpose'] == 'Personal/group blog' ) echo ' selected';?>>Personal/group blog</option>
				<option value="Other" <?php if ( $purpose_other ) echo ' selected';?>>Other</option>	
<?php
			}

			if ( ( ! is_null( $data['role'] ) ) && ( $data['role'] != 'Faculty' ) && ( $data['role'] != 'Staff' ) && ( $data['role'] != 'Student' ) )  {
?>	
				<option value="">---</option>
				<option value="Project site" <?php if ( $data['purpose'] == 'Project site' ) echo ' selected';?>>Project site</option>
				<option value="Personal/group blog" <?php if ( $data['purpose'] == 'Personal/group blog' ) echo ' selected';?>>Personal/group blog</option>
				<option value="Other"  <?php if ( $purpose_other ) echo ' selected';?>>Other</option>	
<?php
			}

			
			if ( $data['role'] == 'Faculty' ) {
?>
				<option value="">---</option>
				<option value="Departmental site" <?php if ( $data['purpose'] == 'Departmental site' ) echo ' selected';?>>Departmental site</option>
				<option value="Project site" <?php if ( $data['purpose'] == 'Project site' ) echo ' selected';?>>Project site</option>
				<option value="Personal/group blog" <?php if ( $data['purpose'] == 'Personal/group blog' ) echo ' selected';?>>Personal/group blog</option>
				<option value="Other"  <?php if ( $purpose_other ) echo ' selected';?>>Other</option>

<?php
			}
?>
			</select>
		</div>
		<div id="use_other" class="<?php if ( ! $purpose_other ) echo 'hide_question '; ?>use_other">
			<label for="use_other" class="use_other"><?php _e( 'Please specify:' ) ?></label>				
			<input name="use_other" class="use_other"<?php if ( $purpose_other )  echo ' value="' . esc_html( $data['purpose'] ) . '"';?>>
		</div>