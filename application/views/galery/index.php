
<section class="content-header">
    <h1>
        Galery
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Galery</a></li>
        <li class="active">List</li>
    </ol>
</section><br>
<?php echo form_open('galery/delete');?>
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
                        <div class="col-sm-2 well" style="margin-bottom: 0px;">
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle btn-flat" title="Select All"><i class="fa fa-square-o"></i></button>
                            <div class="btn-group">
                                <a href="#" data-toggle="modal" data-target="#hapus"><button type="button" class="btn btn-default btn-flat btn-sm " title="Hapus"><i class="fa fa-trash-o"></i></button></a>
                                <a href="<?php echo base_url(); ?>galery/input" ><button type="button" class="btn btn-default btn-sm btn-flat" title="Tambah Data"><i class="fa fa-plus-square"></i></button></a>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body tabel-box">
                        <table class="table table-striped" id="example1">
                            <thead>
                            <tr>
                                <th width="8%"></th>
                                <th>Nama Galery</th>
                                <th width="30%">Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach (@$galery as $value) {?>
                                 <tr>
                                    <td><input class="checkbox id_checkbox" type="checkbox" name="id[]" value="<?php echo $value->id; ?>"></td>
                                    <td><?php echo $value->nama_galery?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>galery/edit/<?php echo $value->id?>"><button type="button" class="btn btn-xs btn-warning btn-flat" title="edit"><i class="fa fa-edit"></i></button></a>
                                        <a href="<?php echo base_url(); ?>galery/galeryphoto/<?php echo $value->id?>"><button type="button" class="btn btn-xs btn-success btn-flat" title="Tambah Foto"><i class="fa fa-camera"></i> Add Photo</button></a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal fade" id="hapus">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Hapus Galery??</h4>
                      </div>
                      <div class="modal-body">
                        Ketika menghapus data galery,semua foto yang ada di dalam galery ini juga akan ikut terhapus,Apakah anda yakin? 
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <button type="submit" name="hapus" class="btn btn-danger">Hapus Galery</button>
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
<?php echo form_close();?>
<script type="text/javascript">
    $(function () {
        $('.tabel-box input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_flat-red',
                radioClass: 'iradio_flat-red'
        });
    });
</script>