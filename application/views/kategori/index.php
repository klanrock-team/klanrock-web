
<section class="content-header">
    <h1>
        kategori
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">kategori</a></li>
        <li class="active">List</li>
    </ol>
</section><br>
<?php echo form_open('kategori/delete');?>
<div class="col-md-12">

        <?php if($this->session->flashdata()){echo "<div class='alert alert-info'>".$this->session->flashdata('message')."</div>";}?>
        <div class="box box-primary">
            <div class="box-header">
                <div class="col-sm-4 well">
                    <span class="jumlah_pilih">0 Dipilih</span>
                    <a href="<?php echo base_url(); ?>kategori/input" >
                        <button class="btn btn-success pull-right" type="button">
                            <div>
                                <i class="fa fa-plus-square"></i> TAMBAH
                            </div>
                        </button>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#hapus"><button type="button" name="delete" id="hapus_record" class="btn btn-primary pull-right"><i class="fa fa-trash"> HAPUS</i></button></a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="Tabel_Data table table-striped">
                    <thead>
                    <tr>
                        <th width="8%">
                            <input type="checkbox" class="checkbox pilih_semua">
                            #</i></th>
                        <th>Kategori</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach (@$kategori as $value) {?>
                         <tr>
                            <td><input class="checkbox id_checkbox" type="checkbox" name="id[]" value="<?php echo $value->id; ?>"></td>
                            <td><?php echo $value->kategori?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>kategori/edit/<?php echo $value->id?>"><button type="button" class="btn btn-xs btn-warning btn-flat" title="edit"><i class="fa fa-edit"></i></button></a>
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
                <h4 class="modal-title">Hapus kategori??</h4>
              </div>
              <div class="modal-body">
                Ketika menghapus kategori,semua transaksi yang menggunakan kategori akan ikut terhapus<br>
                Apakah anda yakin? 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" name="hapus" class="btn btn-danger">Hapus kategori</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<?php echo form_close();?>