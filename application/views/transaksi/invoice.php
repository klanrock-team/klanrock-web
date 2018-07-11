
<section class="content-header">
    <h1>
        Invoice
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Traksaksi</a></li>
        <li class="active">Invoice</li>
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
                    </div><!-- /.box-header -->
                    <div class="box-body tabel-box">
                        <table class="table table-striped Tabel_Data" id="">
                            <thead>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <th>Pilihan Paket</th>
                                <th>Tanggal Foto</th>
                                <th>Jam</th>
                                <th>Total</th>
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
                          <!-- /row -->
                          <div class="row">
                            <div class="col-xs-12">
                              <p class="lead">Bukti Transfer</p>
                              <div class="col-md-12 col-sm-12">
                                <a href="" data-fancybox="group" data-caption="Bukti Transfer" id="caption">
                                <img src="" id="bukti_transfer" width="50%" height="50%"></a><br><br>
                                </div>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                            <!-- this row will not appear when printing -->
                          <div class="row no-print">
                            <div class="col-xs-12">
                              <br><br><br><a id="accept" class="">
                              <button type="button" class="btn btn-success pull-right"><i class="fa fa-check" ></i> Pembayaran Valid 
                              </button></a> 
                              <a class="" id="reject">
                              <button type="button" class="btn btn-danger pull-right"><i class="fa fa-ban" ></i> Pembayaran Tidak Valid 
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
                url   : '<?php echo base_url()?>transaksi/get_invoice',
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
                    var no=1;
                    if (data.length<0) {
                      html += '<tr align="center">'+
                              '<td colspan="7">Belum ada tansaksi untuk hari ini</td>'+
                              '</tr>';
                    }else{
                      for(i=0; i<data.length; i++){

                          tombol = '<a href="#" class="verif" id="'+data[i].id+'" data-toggle="modal" data-target="#detail"><button type="button" class="btn btn-xs btn-primary btn-flat" title="detail transaksi"><i class="fa fa-check"></i> Verifikasi</button></a>'
                            html += '<tr>'+
                                  '<td>'+data[i].nama_pelanggan+'</td>'+
                                  '<td>'+data[i].paket+'</td>'+
                                  '<td>'+data[i].tanggal+'</td>'+
                                  '<td>'+data[i].jam+'</td>'+
                                  '<td>'+data[i].total+'</td>'+
                                  '<td>'+tombol+'</td>'+
                                  '</tr>';
                      }
                    }
                    $('#tbody_transaksi').html(html);
                    $("#loading").css("display","none");
                }

 
            })
        }
        $(".verif").click(function(){
            var id=$(this).attr("id");
            // alert(id);
            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>transaksi/get_detail_invoice',
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
                                    '<th>Tanggal Bayar</th>'+
                                    '<td>'+data[0].tanggal_bayar+'</td>'+
                                  '</tr>'
                                  +
                                  '<tr>'+
                                    '<th>Jam Bayar</th>'+
                                    '<td>'+data[0].jam_bayar+'</td>'+
                                  '</tr>';
                    $("#d_pembayaran").html(data_pembayaran);
                    $("#d_date").html(data[0].tanggal);
                    $('#dnama').html(data[0].nama_pelanggan);
                    $("#phone").html(data[0].tlp);
                    $("#bukti_transfer").attr("src",data[0].url_gambar);
                    $("#caption").attr("href",data[0].url_gambar);
                    $("#tdetail").html(detail_paket);
                    $("#accept").attr("href","<?php echo base_url()?>transaksi/accept/"+id);
                    $("#reject").attr("href","<?php echo base_url()?>transaksi/reject/"+id);
                    $("#loading").css("display","none");
                }
            })
        });
  })
</script>