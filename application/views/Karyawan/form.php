<div class="col-md-9">
	<?php
		echo "<div class='form-group'>";
			echo form_label('Nama','Nama');
		    echo form_input(array(
		    	'type'=>'text',
		    	'name'=>'Nama_Karyawan',
		    	'value'=>@$karyawan['nama_karyawan'],
		    	'class'=>'form-control',
		    	'placeholder'=>'Nama Karyawan',
		    	'required'=>'yes'
			));
		echo "</div>";
	?>
	<?php
		echo "<div class='form-group'>";
			echo form_label('Alamat','Alamat');
		    echo form_input(array(
		    	'type'=>'text',
		    	'name'=>'Alamat_Karyawan',
		    	'value'=>@$karyawan['alamat'],
		    	'class'=>'form-control',
		    	'placeholder'=>'Alamat',
		    	'required'=>'yes'
			));
		echo "</div>";
	?>
	<?php
		echo "<div class='form-group'>";
			echo form_label('No Hp','No Hp');
		    echo form_input(array(
		    	'type'=>'number',
		    	'name'=>'No_HP_Karyawan',
		    	'value'=>@$karyawan['no_hp'],
		    	'class'=>'form-control',
		    	'placeholder'=>'No Hp',
		    	'required'=>'yes'
			));
		echo "</div>";
	?>
	<div class='form-group'>
		<label for="Id_Jabatan">Jabatan</label>
		<select class="form-control" name="Id_Jabatan" required>
			<?php foreach ($jabatan as $list) {?>
				<option value="<?php echo $list->id?>">
				<?php echo $list->jabatan?></option>" ;
			<?php
			}
			?>
		</select>
	</div>
</div>
