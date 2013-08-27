		<div>
			<label for="role"><?php _e( 'Role:' ) ?></label>				
			<p><select name="role" id="role">
				<option value="">---</option>
				<option<?php if ( $data['role'] == 'Faculty' ) echo ' selected';?>>Faculty</option>
				<option<?php if ( $data['role'] == 'Student' ) echo ' selected';?>>Student</option>
				<option<?php if ( $data['role'] == 'Staff' ) echo ' selected';?>>Staff</option>
				<option<?php if ( $role_other ) echo ' selected';?>>Other</option>
			</select></p>
		</div>

		<div id="other_role" class="<?php if (! $role_other ) echo 'hide_question '; ?> other_role question">
			<label for="other_role"><?php _e( 'Please specify:' ) ?></label>				
			<input name="other_role" class="other_role"<?php if ( $role_other ) echo ' value="' . esc_html( $data['role'] ) . '"';?>>
		</div>