
<section class="content-header">
    <h1>
        Transaksi Valid
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Traksaksi</a></li>
        <li class="active">Transaksi valid</li>
    </ol>
</section><br>
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
                        <!-- <div class="col-sm-4 ">
                          <h4>Tampilkan Transaksi</h4>
                              <select class="select2 form-control" name="filter" id="filter">
                                  <option value="<?php echo date("Y-m-d");?>" selected>Hari Ini</option>
                                  <option value="">Semua Transaksi</option>
                              </select>
                          </div>
                          <div class="col-sm-4 col-md-4">
                                <h4>Transaksi Ditanggal Tertentu</h4>
                                    <input type="date" name="mulai" class="form-control mulai" id="mulai" ><button type="button" class="btn btn-success" id="cari" style="margin-top: 10px;"><i class="fa fa-search"></i> Cari</button>
                          </div>
                          <div class="col-sm-4 col-md-4">
                          </div> -->
                    </div><!-- /.box-header -->
                    <div class="box-body tabel-box">
                        <table class="table table-striped Tabel_Data" id="Tabel_Data">
                            <thead>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <th>Pilihan Paket</th>
                                <th>Tanggal Foto</th>
                                <th>Jam</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                    </thead>
                    <tbody id="tbody_transaksi">    
                    </tbody>
                    </table>
                    </div><!-- /.box-body -->
                    <div class="overlay" style="display: none" id="loading">
                      <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
        </div>
        <div class="modal fade" id="detail">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail Transaksi</h4>
              </div>
              <div class="modal-body">
                    <section class="invoice">
                          <!-- title row -->
                          <div class="row">
                            <div class="col-xs-12">
                              <h2 class="page-header">
                                <i class="fa fa-globe"></i> KlanrocK Studio
                                <small class="pull-right">Date: <span id="d_date"></span></small>
                              </h2>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- info row -->
                          <div class="row invoice-info">
                            <div class="col-sm-12 invoice-col">
                              Customers,
                              <address>
                                <strong id="dnama"></strong><br>
                                Phone : <span id="phone"></span><br>
                              </address>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <!-- Table row -->
                          <div class="row">
                            <div class="col-xs-12 table-responsive">
                              <table class="table table-striped">
                                <thead>
                                <tr>
                                  <th>Pilihan Paket</th>
                                  <th>Harga</th>
                                  <th>Keterangan</th>
                                  <th>Total</th>
                                </tr>
                                </thead>
                                <tbody id="tdetail">
                                </tbody>
                              </table>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                          <div class="row">
                            <div class="col-xs-12">
                              <p class="lead">Detail Pembayaran</p>
                              <div class="table-responsive">
                                <table class="table" id="d_pembayaran">
                                </table>
                              </div>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                    </section>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="bayar">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Bayar Sisa Tagihan</h4>
              </div>
              <div class="modal-body">
                    <section class="invoice">
                          <!-- title row -->
                          <div class="row">
                            <div class="col-xs-12">
                              <h2 class="page-header">
                                <i class="fa fa-globe"></i> KlanrocK Studio
                              </h2>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- info row -->
                          <div class="row invoice-info">
                            <div class="col-sm-12 invoice-col">
                              Customers,
                              <address>
                                <strong id="p_nama"></strong><br>
                                Phone: <span id="p_phone"></span><br>
                              </address>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <div class="row">
                            <div class="col-xs-12">
                              <p class="lead">Detail Pembayaran</p>

                              <div class="table-responsive">
                                <table class="table" id="t_pembayaran">
                                </table>
                              </div>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                            <!-- this row will not appear when printing -->
                          <div class="row no-print">
                            <div class="col-xs-12">
                              <a id="t_bayar" class="">
                              <button type="button" class="btn btn-success pull-right"><i class="fa fa-money" ></i> Pembayaran Lunas 
                              </button></a>
                            </div>
                          </div>
                     
                    </section>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>     
</section>
<script>
  $(function () {
        list_transaksi_today();   //pemanggilan fungsi tampil event.
        //fungsi tampil event
        function list_transaksi_today(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url()?>transaksi/get_transaksi',
                async : false,
                dataType : 'json',
                beforeSend:function(){
                  $("#loading").css("display","block")
                },
                success : function(data){
                    var html = '';
                    var tombol = '';
                    var style = '';
                    var i;
                    if (data.length==0) {
                      html += '<tr align="center">'+
                              '<td colspan="7">Belum ada tansaksi untuk hari ini</td>'+
                              '</tr>';
                    }else{
                      for(i=0; i<data.length; i++){
                            if (data[i].status=="dp") {
                                style = 'style="background-color:#E87E04;color: white"';
                                tombol = '<a href="#" id="'+data[i].id+'" class="detail" data-toggle="modal" data-target="#detail"><button type="button" class="btn btn-xs btn-primary btn-flat" title="detail transaksi"><i class="fa fa-eye"></i> Show Detail</button></a> <a href="#" id="'+data[i].id+'" class="lunasi" data-toggle="modal" data-target="#bayar"><button type="button" class="btn btn-xs btn-success btn-flat" title="Bayar sisa dp"><i class="fa fa-money"></i> Bayar Sisa </button></a>'
                            }else{
                                style = 'style="background-color:#00B16A;color:white"';
                                tombol = '<a href="#" class="detail" id="'+data[i].id+'" data-toggle="modal" data-target="#detail"><button type="button" class="btn btn-xs btn-primary btn-flat" title="detail transaksi"><i class="fa fa-eye"></i> Show Detail</button></a>'
                            }
                            html += '<tr>'+
                                  '<td>'+data[i].nama_pelanggan+'</td>'+
                                  '<td>'+data[i].paket+'</td>'+
                                  '<td>'+data[i].tanggal+'</td>'+
                                  '<td>'+data[i].jam+'</td>'+
                                  '<td>'+data[i].total+'</td>'+
                                  '<td '+style+' align="center">'+data[i].status+'</td>'+
                                  '<td>'+tombol+'</td>'+
                                  '</tr>';
                      }
                    }
                    $('#tbody_transaksi').html(html);
                    $("#loading").css("display","none");
                }

 
            })
        }
         $("#filter").change(function(){
            var param=$(this).val();
            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>transaksi/get_transaksi',
                async : false,
                dataType : 'json',
                data:{param:param},
                beforeSend:function(){
                  $("#loading").css("display","block");
                },
                success : function(data){
                    var html = '';
                    var tombol = '';
                    var style = '';
                    var i;
                    if (data.length==0) {
                      html += '<tr align="center">'+
                              '<td colspan="7">Belum ada tansaksi untuk hari ini</td>'+
                              '</tr>';
                    }else{
                      for(i=0; i<data.length; i++){
                            if (data[i].status=="dp") {
                                style = 'style="background-color:#E87E04;color: white"';
                                tombol = '<a href="#" id="'+data[i].id+'" class="detail" data-toggle="modal" data-target="#detail"><button type="button" class="btn btn-xs btn-primary btn-flat" title="detail transaksi"><i class="fa fa-eye"></i> Show Detail</button></a> <a href="#" id="'+data[i].id+'" class="lunasi" data-toggle="modal" data-target="#bayar"><button type="button" class="btn btn-xs btn-success btn-flat" title="Bayar sisa dp"><i class="fa fa-money"></i> Bayar Sisa </button></a>'
                            }else{
                                style = 'style="background-color:#00B16A;color:white"';
                                tombol = '<a href="#" class="detail" id="'+data[i].id+'" data-toggle="modal" data-target="#detail"><button type="button" class="btn btn-xs btn-primary btn-flat" title="detail transaksi"><i class="fa fa-eye"></i> Show Detail</button></a>'
                            }
                            html += '<tr>'+
                                  '<td>'+data[i].nama_pelanggan+'</td>'+
                                  '<td>'+data[i].paket+'</td>'+
                                  '<td>'+data[i].tanggal+'</td>'+
                                  '<td>'+data[i].jam+'</td>'+
                                  '<td>'+data[i].total+'</td>'+
                                  '<td '+style+' align="center">'+data[i].status+'</td>'+
                                  '<td>'+tombol+'</td>'+
                                  '</tr>';
                      }
                    }
                    $('#tbody_transaksi').html(html);
                    $("#loading").css("display","none");
                }
            })

        });

        $("#cari").click(function(){
            var param=$(".mulai").val();
            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>transaksi/get_transaksi',
                async : false,
                dataType : 'json',
                data:{param:param},
                success : function(data){
                    var html = '';
                    var tombol = '';
                    var style = '';
                    var i;
                    if (data.length==0) {
                      html += '<tr align="center">'+
                              '<td colspan="7">Tidak ada transaksi pada tanggal dipilih</td>'+
                              '</tr>';
                    }else{
                      for(i=0; i<data.length; i++){
                            if (data[i].status=="dp") {
                                style = 'style="background-color:#E87E04;color: white"';
                                tombol = '<a href="#" id="'+data[i].id+'" class="detail" data-toggle="modal" data-target="#detail"><button type="button" class="btn btn-xs btn-primary btn-flat" title="detail transaksi"><i class="fa fa-eye"></i> Show Detail</button></a> <a href="#" id="'+data[i].id+'" class="lunasi" data-toggle="modal" data-target="#bayar"><button type="button" class="btn btn-xs btn-success btn-flat" title="Bayar sisa dp"><i class="fa fa-money"></i> Bayar Sisa </button></a>'
                            }else{
                                style = 'style="background-color:#00B16A;color:white"';
                                tombol = '<a href="#" class="detail" id="'+data[i].id+'" data-toggle="modal" data-target="#detail"><button type="button" class="btn btn-xs btn-primary btn-flat" title="detail transaksi"><i class="fa fa-eye"></i> Show Detail</button></a>'
                            }
                            html += '<tr>'+
                                  '<td>'+data[i].nama_pelanggan+'</td>'+
                                  '<td>'+data[i].paket+'</td>'+
                                  '<td>'+data[i].tanggal+'</td>'+
                                  '<td>'+data[i].jam+'</td>'+
                                  '<td>'+data[i].total+'</td>'+
                                  '<td '+style+' align="center">'+data[i].status+'</td>'+
                                  '<td>'+tombol+'</td>'+
                                  '</tr>';
                      }
                    }
                    $('#tbody_transaksi').html(html);
                    $("#loading").css("display","none");
                }
            })
        });

        $(".detail").click(function(){
            var id=$(this).attr("id");
            // alert("id transaksi : "+id);
            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>transaksi/get_detail',
                async : false,
                dataType : 'json',
                data:{id:id},
                success : function(data){
                    var detail_paket = '';
                    var data_pembayaran = '';
                    detail_paket += '<tr>'+
                                  '<td>'+data[0].paket+'</td>'+
                                  '<td>'+data[0].harga+'</td>'+
                                  '<td>'+data[0].keterangan+'</td>'+
                                  '<td>'+data[0].total+'</td>'+
                                  '</tr>';
                    data_pembayaran +=  
                                  '<tr><th style="width:50%">Total:</th>'+
                                      '<td>'+data[0].total+'</td>'+
                                  '</tr>'+
                                  '<tr><th>Bayar</th>'+
                                    '<td>'+data[0].bayar+'</td>'+
                                  '</tr>'+
                                  '<tr>'+
                                    '<th>Sisa</th>'+
                                    '<td>'+data[0].sisa+'</td>'+
                                  '</tr>'+
                                  '<tr>'+
                                    '<th>Status Pembayaran</th>'+
                                    '<td>'+data[0].status+'</td>'+
                                  '</tr>';
                    $("#d_pembayaran").html(data_pembayaran);
                    $("#d_date").html(data[0].tanggal);
                    $('#dnama').html(data[0].nama_pelanggan);
                    $("#phone").html(data[0].tlp);
                    $("#tdetail").html(detail_paket);
                    $("#loading").css("display","none");
                }
            })
        });


        $(".lunasi").click(function(){
            var id=$(this).attr("id");
            // alert(id);
            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>transaksi/get_detail',
                async : false,
                dataType : 'json',
                data:{id:id},
                success : function(data){
                    var data_pembayaran = '';
                    data_pembayaran +=  
                                  '<tr><th style="width:50%">Total:</th>'+
                                      '<td>'+data[0].total+'</td>'+
                                  '</tr>'+
                                  '<tr><th>Bayar</th>'+
                                    '<td>'+data[0].bayar+'</td>'+
                                  '</tr>'+
                                  '<tr>'+
                                    '<th>Sisa</th>'+
                                    '<td>'+data[0].sisa+'</td>'+
                                  '</tr>';
                    $("#t_pembayaran").html(data_pembayaran);
                    $('#p_nama').html(data[0].nama_pelanggan);
                    $("#p_phone").html(data[0].tlp);
                    $("#t_bayar").attr("href","<?php echo base_url()?>transaksi/bayar_sisa/"+id);
                    $("#loading").css("display","none");
                }
            })
        });
  })
</script>