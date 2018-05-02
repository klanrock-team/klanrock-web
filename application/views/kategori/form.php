<div class="col-md-9">
	<?php
		echo "<div class='form-group'>";
			echo form_label('Layanan','layanan');
		    echo form_input(array(
		    	'type'=>'text',
		    	'name'=>'kategori',
		    	'value'=>@$kategori['kategori'],
		    	'class'=>'form-control',
		    	'placeholder'=>'Kategori Paket',
		    	'required'=>'yes'
			));
		echo "</div>";
	?>
</div>
