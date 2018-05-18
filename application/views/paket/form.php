<div class="col-md-9">
	<?php
		echo "<div class='form-group'>";
			echo form_label('Nama Paket','nama_paket');
		    echo form_input(array(
		    	'type'=>'text',
		    	'name'=>'nama_paket',
		    	'value'=>@$paket['nama_paket'],
		    	'class'=>'form-control',
		    	'placeholder'=>'Nama Paket',
		    	'required'=>'yes'
			));
			echo "</div>";
			?>
			<?php
		echo "<div class='form-group'>";
			echo form_label('Harga','harga');
		    echo form_input(array(
		    	'type'=>'number',
		    	'name'=>'harga',
		    	'value'=>@$paket['harga'],
		    	'class'=>'form-control',
		    	'placeholder'=>'0',
		    	'required'=>'yes'
			));
			echo "</div>";
			?>
			<?php
		echo "<div class='form-group'>";
			echo form_label('Jumlah Orang','jumlah_orang');
		    echo form_input(array(
		    	'type'=>'number',
		    	'name'=>'jumlah_orang',
		    	'value'=>@$paket['jumlah_orang'],
		    	'class'=>'form-control',
		    	'placeholder'=>'0',
		    	'required'=>'yes'
			));
			echo "</div>";
			?>
			<?php
		echo "<div class='form-group'>";
			echo form_label('Lama Waktu (jam)','lama_waktu');
		    echo form_input(array(
		    	'type'=>'number',
		    	'name'=>'lama_waktu',
		    	'value'=>@$paket['lama_waktu'],
		    	'class'=>'form-control',
		    	'placeholder'=>'0ddd',
		    	'required'=>'yes'
			));
			echo "</div>";
			?>
		<div class="form-group">
			<label>Keterangan (optional)</label>
			<textarea class="ckeditor" id="ckeditor" name="keterangan"><?php echo @$paket['keterangan'];?></textarea>
		</div>
		<div class='form-group'>
		<label for="kategori_id">Kategori Paket</label>
		<select class="form-control" name="kategori_id">
			<?php foreach ($kategori as $list) {?>
				<option value="<?php echo $list->id?>">
				<?php echo $list->kategori ?></option>" ;
			<?php
			}
			?>
		</select>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.dropify').dropify({
            messages: {
                default: 'Drag and drop or click untuk memilih gambar',
                replace: 'Ganti',
                remove:  'Hapus',
                error:   'error'
            }
        });
        $('.tabel-box input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_flat-red',
                radioClass: 'iradio_flat-red'
        });
    });   
</script>