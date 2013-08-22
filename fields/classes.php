		<div id="class_site" class="<?php if (!( $data['role'] == 'Faculty' ) ) echo 'hide_question '; ?>faculty question">
			<label for="class_site"><?php _e( 'Is this site for a class?' ) ?></label>				
			<select name="class_site" class="faculty">
				<option value=""<?php if (is_null( $data['class_site'] ) ) echo ' selected';?>>---</option>
				<option<?php if ( $data['class_site'] == 'Yes' ) echo ' selected';?>>Yes</option>
				<option<?php if ( ( $data['role'] == 'Faculty' ) && ( $data['class_site'] == 'No' ) ) echo ' selected';?>>No</option>
			</select>
		</div>
		<div id="class_name" class="<?php if (!( ( $data['role'] == 'Faculty' ) && ( $data['class_site'] == 'Yes' ) ) ) echo 'hide_question '; ?>class_site question">
			<label for="class_name"><?php _e( 'Class Name:' ) ?></label>
			<input type="text" name="class_name" class="class_site faculty" size="38"<?php if ( $data['class_name'] ) echo 'value="'.esc_html( $data['class_name'] ) .'"';?>>
		</div>
			<div id="class_number" class="<?php if (!( ( $data['role'] == 'Faculty' ) && ( $data['class_site']== 'Yes' ) ) ) echo 'hide_question '; ?>class_site question">
			<label for="class_number"><?php _e( 'Class number (and section, if you have it):' ) ?></label>				
			<input type="text" name="class_number" class="class_site faculty" size="16"<?php if ( $data['class_number'] ) echo 'value="'.esc_html( $data['class_number'] ) .'"';?>>
		</div>

		<div id="class_type" class="<?php if (!( ( $data['role'] == 'Faculty' ) && ( $data['class_site'] == 'Yes' ) ) ) echo 'hide_question '; ?>class_site question">
			<label for="class_type"><?php _e( 'Is the class...' ) ?></label>				
			<select name="class_type" id="class_type" class="class_site faculty" >
				<option value="">---</option>
				<option<?php if ( $data['class_type'] == 'Face to Face' ) echo ' selected';?>>Face to Face</option>
				<option<?php if ( $data['class_type'] == 'Hybrid' ) echo ' selected';?>>Hybrid</option>
				<option<?php if ( $data['class_type'] == 'Fully Online' ) echo ' selected';?>>Fully Online</option>
			</select>
		</div>