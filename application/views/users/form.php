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

</div>
