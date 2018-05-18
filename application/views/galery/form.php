<div class="col-md-9">
	<?php
		echo "<div class='form-group'>";
			echo form_label('Nama Galery','galery');
		    echo form_input(array(
		    	'type'=>'text',
		    	'name'=>'galery',
		    	'value'=>@$galery['nama_galery'],
		    	'class'=>'form-control',
		    	'placeholder'=>'Nama Galery',
		    	'required'=>'yes'
			));
		echo "</div>";
	?>
	<div class="form-group">
		<label>Keterangan (optional)</label>
		<textarea class="ckeditor" id="ckeditor" name="keterangan"><?php echo @$galery['keterangan'];?></textarea>
	</div>
</div>
