
<section class="content-header">
    <h1>
        karyawan
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">karyawan</a></li>
        <li class="active">List</li>
    </ol>
</section><br>
<?php echo form_open('karyawan/delete');?>
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
                                <a href="<?php echo base_url(); ?>Karyawan/input" ><button type="button" class="btn btn-default btn-sm btn-flat" title="Tambah Data"><i class="fa fa-plus-square"></i></button></a>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body tabel-box">
                        <table class="table table-striped" id="example1">
                            <thead>
                            <tr>
                                <th width="8%"></th>
                                <th>Karyawan</th>
                                <th>Alamat</th>
                                <th>No Hp</th>
                                <th>Jabatan</th>
                                <th>User Level</th>
                                <th>Opsi</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php foreach (@$karyawan as $value) {?>
                         <tr>
                            <td><input class="checkbox id_checkbox" type="checkbox" name="id[]" value="<?php echo $value->id; ?>"></td>
                            <td><?php echo $value->nama_karyawan?></td>
                            <td><?php echo $value->alamat?></td>
                            <td><?php echo $value->no_hp?></td>
                            <td><?php echo $value->jabatan?></td>
                            <td><?php if ($value->status==0){
                                echo "-";
                            }else{
                                switch ($value->level) {
                                    case 1:
                                        echo "Admin";
                                        break;
                                    case 2:
                                        echo "Fotografer";
                                        break;
                                    case 3:
                                        echo "Owner/Manager";
                                        break;
                                    
                                    default:
                                        echo "-";
                                        break;
                                }
                            }?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>Karyawan/edit/<?php echo $value->id?>"><button type="button" class="btn btn-xs btn-warning btn-flat" title="edit data"><i class="fa fa-edit"></i></button></a>
                                <?php if($value->status==0){?>
                                <a href="<?php echo base_url(); ?>users/input/<?php echo $value->id?>"><button type="button" class="btn btn-xs btn-primary btn-flat" title="Create user login"><i class="fa fa-pencil"></i> Create Login</button></a>
                                <?php
                                }else{?>
                                <a href="<?php echo base_url(); ?>users/edit/<?php echo $value->id?>"><button type="button" class="btn btn-xs btn-success btn-flat" title="Update user login"><i class="fa fa-edit"></i> Update Login</button></a>
                                <a href="<?php echo base_url(); ?>users/delete/<?php echo $value->id?>"><button type="button" class="btn btn-xs btn-danger btn-flat" title="Hapus user login"><i class="fa fa-trash-o"></i> Hapus Login</button></a>
                                <?php
                                }
                                ?>
                                </td>
                            </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div>
        </div>
        <div class="modal fade" id="hapus">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus karyawan??</h4>
              </div>
              <div class="modal-body">
                Ketika menghapus data karyawan,semua data login yang digunakan oleh karyawan akan ikut terhapus,Apakah anda yakin? 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" name="hapus" class="btn btn-danger">Hapus karyawan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
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