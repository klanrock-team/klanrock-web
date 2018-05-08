<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 26/01/2018
 * Time: 23.12
 */
?>
<section class="content-header">
    <h1>
        Galery photo for <?php echo $galery['nama_galery'];?>
        <small>preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">galery</a></li>
        <li class="active">add photo</li>
    </ol>
</section><br>

<?php echo form_open('galery/proses_gambar',array('id'=>'form_upload','enctype'=>'multipart/form-data'))?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
                <?php if($this->session->flashdata()){?>
                        <?php echo $this->session->flashdata('message');?>    
                <?php
                    }
                ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="col-md-6">
                        <label>Nama Galery : </label><br>
                        <?php echo @$galery['nama_galery']?><br><br>
                    </div>
                    <div class="col-md-6">
                        <label>Keterangan : </label>
                        <?php echo @$galery['keterangan'];?>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                                <?php echo form_hidden('id', $this->uri->segment(3));?>
                                <div class="col-md-3"></div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <input type="file" name="filefoto" class="form-control dropify">
                                    </div>
                                    <center><input type="submit" class="btn btn-primary btn-flat" name="upload_gambar" value="UPLOAD"></center><br><br>                                
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-12">
                                    <div class="col-md-2 well" style="margin-bottom: 0px;">
                                        <button type="button" class="btn btn-default btn-sm checkbox-toggle btn-flat" title="Select All">
                                            <i class="fa fa-square-o"></i>
                                        </button>
                                        <a href="#" data-toggle="modal" data-target="#hapus">
                                            <button type="button" class="btn btn-danger btn-flat btn-sm" title="Hapus">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-md-12 col-sm-12 tabel-box container-galery">
                                        
                                        <?php
                                            $i=1;
                                            if (@$gambar==null) {
                                                echo "<br><br><center><i><center>Tidak ada gambar untuk ditampilkan</i></center><br><br>";
                                            }else{
                                            foreach (@$gambar as $value) {?>
                                                <div class="col-md-4 col-sm-4 galery">
                                                    <a href="<?php echo base_url()?>assets/images/<?php echo $value->nama_gambar?>" data-fancybox="group" data-caption="<?php echo $galery['nama_galery']?> - photo<?php echo $i?>" >
                                                        <img src="<?php echo base_url()?>assets/images/<?php echo $value->nama_gambar?>">
                                                    </a><br><br>
                                                    <input type="checkbox" class="checkbox id_checkbox" name="id_gambar[]" value="<?php echo $value->id;?>" >
                                                </div>                                           
                                        <?php
                                            $i++;
                                            }
                                        }
                                        ?>
                                            
                                    </div>
                                    <br><br><a href="<?php echo base_url()?>galery/"><button type="button" class="btn btn-default"><i class="fa fa-backward"></i> Kembali</button></a>
                                </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            <div class="modal fade" id="hapus">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Hapus Photo??</h4>
                      </div>
                      <div class="modal-body">
                        Hapus semua photo yang terpilih? 
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <input type="submit" name="hapus_gambar" class="btn btn-danger" value="Hapus Gambar">
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
        </div>
    </div>
</section>
<?php echo form_close()?>
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
        // $('#form_upload').submit(function(e){
        //     e.preventDefault(); 
        //         $.ajax({
        //             url:'<?php echo base_url();?>upload/galery/do_upload',
        //             type:"post",
        //             data:new FormData(this),
        //             processData:false,
        //             contentType:false,
        //             cache:false,
        //             async:false,
        //             success: function(data){
        //                 alert("Upload Image Berhasil.");
        //         }
        //     });
        // });
    });   
</script>