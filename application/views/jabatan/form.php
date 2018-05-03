<div class="col-md-9">
	<?php
		echo "<div class='form-group'>";
			echo form_label('Jabatan','jabatan');
		    echo form_input(array(
		    	'type'=>'text',
		    	'name'=>'jabatan',
		    	'value'=>@$jabatan['jabatan'],
		    	'class'=>'form-control',
		    	'placeholder'=>'Jabatan Karyawan',
		    	'required'=>'yes'
			));
		echo "</div>";
	?>

</div>
