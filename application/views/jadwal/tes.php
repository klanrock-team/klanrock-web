
<section class="content-header">
    <h1>
        Laporan
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan</li>
    </ol>
</section><br>
<?php echo form_open('laporan/delete');?>
<div class="col-md-12">

        <?php if($this->session->flashdata()){echo "<div class='alert alert-info'>".$this->session->flashdata('message')."</div>";}?>
        <div class="box box-primary">
            <div class="box-header">
                <div class="col-sm-4 well">
                    <h4>Tampilkan Laporan</h4>
                    <div class="col-sm-12">
                        <label>Filter</label>
                        <select class="select2 form-control" name="filter" id="filter">
                            <option value="<?php echo "H-".date("Y-m-d");?>" selected>Transaksi Hari Ini</option>
                            <option value="<?php echo "H-".date("Y-m-d",mktime(0,0,0,date('m'),date('d')-1,date('Y')));?>">Transaksi Kemarin</option>
                            <option value="<?php echo "B-".date("Y-m-d",mktime(0,0,0,date('m'),date('d'),date('Y')));?>">Bulan Ini</option>
                            <option value="<?php echo "B-".date("Y-m-d",mktime(0,0,0,date('m')-1,date('d'),date('Y')));?>">Bulan Kemarin</option>
                            <option value="<?php echo "zz-".date("Y-m-d");?>">Semua Transaksi</option>
                        </select>
                    </div>
                    <div class="col-sm-12" style="margin-top: 15px;">
                        <span class="jumlah_pilih">0 Dipilih</span>
                        <a href="#" data-toggle="modal" data-target='#hapus'><button type="button" name="delete" id="hapus_record" class="btn btn-primary pull-right"><i class="fa fa-trash"> HAPUS</i></button></a>
                    </div>
                </div>
                <div class="col-sm-7 col-md-7 well pull-right">
                    <h4>Cari berdasarkan range waktu</h4>
                    <div class="col-md-6">
                         <label>Mulai</label>
                        <input type="date" name="mulai" class="form-control mulai" id="mulai" >
                    </div>
                    <div class="col-md-6">
                        <label>Sampai</label>
                        <input type="date" name="sampai" class="form-control sampai" id="sampai">
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <button type="button" class="btn btn-success pull-right" id="cari" style="margin-top: 10px;"><i class="fa fa-search"></i> Cari</button>
                    </div>
                      
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="Tabel_Data table table-striped">
                    <thead>
                    <tr>
                        <th width="8%">
                            <input type="checkbox" class="checkbox btn pilih_semua">#</th>
                        <th>Tanggal Transaksi</th>
                        <th>Harga</th>
                        <th>Layanan</th>
                    </tr>
                    </thead>
                    <tbody id="laporan">     
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
                <h4 class="modal-title">Hapus Data Transaksi??</h4>
              </div>
              <div class="modal-body">
                Transaksi yang telah dihapus tidak dapat dikembalikan<br>
                Apakah anda yakin? 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" name="hapus" class="btn btn-danger">Hapus Transaksi</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<?php echo form_close();?>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>/desain/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        total();   //pemanggilan fungsi tampil barang.
        // $('.mydata').dataTable();
        //fungsi tampil barang
        function total(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url()?>laporan/data_laporan',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    var total=0;
                    for(i=0; i<data.length; i++){
                        $hrg = parseInt(data[i].harga);
                        html += '<tr>'+
                                '<td><input class=\"checkbox id_checkbox\" type=\"checkbox\" name=\"id[]\" value=\"'+data[i].id+'\"></td>'+
                                '<td>'+data[i].tanggal+'</td>'+
                                '<td>'+$hrg.toLocaleString()+'</td>'+
                                '<td>'+data[i].layanan+'</td>'+
                                '</tr>';
                        total =  parseInt(total)+parseInt(data[i].harga);
                    }
                    html += '<tr style=\'background-color:#3c8dbc;color:white;\'>'+
                            '<td></td>'+
                            '<td><center><b>Total</b></center></td>'+
                            '<td>'+total.toLocaleString()+"</td>"+
                            '<td></td>'+
                            '</tr>';
                    $('#laporan').html(html);
                }
 
            });
        }
        $("#filter").change(function(){
            var param=$(this).val();
            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>laporan/data_filter',
                async : false,
                dataType : 'json',
                data:{param:param},
                success: function(data){
                    var html = '';
                    var i;
                    var total=0;
                    for(i=0; i<data.length; i++){
                        $hrg = parseInt(data[i].harga);
                        html += '<tr>'+
                                '<td><input class=\"checkbox id_checkbox\" type=\"checkbox\" name=\"id[]\" value=\"'+data[i].id+'\"></td>'+
                                '<td>'+data[i].tanggal+'</td>'+
                                '<td>'+$hrg.toLocaleString()+'</td>'+
                                '<td>'+data[i].layanan+'</td>'+
                                '</tr>';
                        total =  parseInt(total)+parseInt(data[i].harga);
                    }
                    html += '<tr style=\'background-color:#3c8dbc;color:white;\'>'+
                            '<td></td>'+
                            '<td><center><b>Total</b></center></td>'+
                            '<td>'+total.toLocaleString()+"</td>"+
                            '<td></td>'+
                            '</tr>';
                    $('#laporan').html(html);
                }
            })

        });
        $("#cari").click(function(){
            var mulai=$(".mulai").val();
            var sampai=$(".sampai").val();
            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>laporan/data_range',
                async : false,
                dataType : 'json',
                data:{mulai:mulai,sampai:sampai},
                success: function(data){
                    var html = '';
                    var i;
                    var total=0;
                    for(i=0; i<data.length; i++){
                        $hrg = parseInt(data[i].harga);
                        html += '<tr>'+
                                '<td><input class=\"checkbox id_checkbox\" type=\"checkbox\" name=\"id[]\" value=\"'+data[i].id+'\"></td>'+
                                '<td>'+data[i].tanggal+'</td>'+
                                '<td>'+$hrg.toLocaleString()+'</td>'+
                                '<td>'+data[i].layanan+'</td>'+
                                '</tr>';
                        total =  parseInt(total)+parseInt(data[i].harga);
                    }
                    html += '<tr style=\'background-color:#3c8dbc;color:white;\'>'+
                            '<td></td>'+
                            '<td><center><b>Total</b></center></td>'+
                            '<td>'+total.toLocaleString()+"</td>"+
                            '<td></td>'+
                            '</tr>';
                    $('#laporan').html(html);
                }
            })
        })
    });

</script>