		<div id="purpose" class="<?php if ( ( ( $data['role'] == 'Faculty' ) && ( $data['class_site'] == 'Yes' ) ) || ( is_null($data['role'] ) ) ) echo 'hide_question '; ?>purpose question">
			<label for="purpose"><?php _e( 'What kind of site will this be?' ) ?></label>				
			<select id="nbm_purpose" name="purpose">
				<option value="">---</option>
				<option <?php if ( $data['purpose'] == 'Personal Blog' ) echo ' selected';?>>Personal Blog</option>
				<option <?php if ( $data['purpose'] == 'Research Blog' ) echo ' selected';?>>Research Blog</option>
				<option <?php if ( $data['purpose'] == 'Portfolio' ) echo ' selected';?>>Portfolio</option>
<?php			$purpose = $data['purpose'];?>
				<option <?php if ( $purpose_other ) echo ' selected';?>>Other</option>
			</select>
		</div>
		<div id="use_other" class="<?php if ( ! $purpose_other ) echo 'hide_question '; ?>use_other">
			<label for="use_other" class="purpose"><?php _e( 'Please specify:' ) ?></label>				
			<input name="use_other" class="purpose"<?php if ( $purpose_other )  echo ' value="' . esc_html( $data['purpose'] ) . '"';?>>
		</div>