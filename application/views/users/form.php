<div class="col-md-9">
			<?php
		echo "<div class='form-group'>";
			echo form_label('Username','nama');
		    echo form_input(array(
		    	'type'=>'text',
		    	'name'=>'username',
		    	'value'=>@$users['username'],
		    	'class'=>'form-control',
		    	'placeholder'=>'Username',
		    	'required'=>'yes'
			));
			echo "</div>";
			?>
			<?php
		echo "<div class='form-group'>";
			echo form_label('password','password');
		    echo form_input(array(
		    	'type'=>'password',
		    	'name'=>'password',
		    	'value'=>@$users['password'],
		    	'class'=>'form-control',
		    	'placeholder'=>'********',
		    	'required'=>'yes'
			));
			echo "</div>";
			?>
		<div class="form-group">
			<label>Level User</label>
			<SELECT required name="level" class="form-control">
				<option value="1" <?php if (@$users['level']==1) {echo "selected";}?>>Admin</option>
				<option value="2" <?php if (@$users['level']==2) {echo "selected";}?>>Fotografer</option>
				<option value="3" <?php if (@$users['level']==3) {echo "selected";}?>>Owner/Manager</option>
			</SELECT>
		</div>

</div>
