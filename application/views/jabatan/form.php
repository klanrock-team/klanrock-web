<div class="col-md-9">
	<?php
		echo "<div class='form-group'>";
			echo form_label('Jabatan','jabatan');
		    echo form_input(array(
		    	'type'=>'text',
		    	'name'=>'Jabatan',
		    	'value'=>@$jabatan['jabatan'],
		    	'class'=>'form-control',
		    	'placeholder'=>'Jabatan',
		    	'required'=>'yes'
			));
		echo "</div>";
	?>

</div>
