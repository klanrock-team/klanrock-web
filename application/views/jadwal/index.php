
<section class="content-header">
    <h1>
        Jadwal Photo
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Klanrock</a></li>
        <li class="active">Jadwal</li>
    </ol>
</section><br>
<section class="content">
    <div class="row">
        <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <div class="col-sm-4 ">
                          <h4>Tampilkan Jadwal</h4>
                              <select class="select2 form-control" name="filter" id="filter">
                                  <option value="<?php echo date("Y-m-d");?>" selected>Jadwal Hari Ini</option>
                                  <option value="<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d')+1,date('Y')));?>">Jadwal Besok</option>
                                  <option value="<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d')+2,date('Y')));?>">Jadwal Lusa</option>
                              </select>
                      </div>
                      <div class="col-sm-4 col-md-4">
                            <h4>Lihat Jadwal Ditanggal Tertentu</h4>
                                <input type="date" name="mulai" class="form-control mulai" id="mulai" ><button type="button" class="btn btn-success" id="cari" style="margin-top: 10px;"><i class="fa fa-search"></i> Cari</button>
                      </div>
                      <div class="col-sm-4 col-md-4">
                          <h3 class="well" align="center"><?php echo $hari_ini;?></h3>
                      </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <table class="table">
                        <thead id="thead_jadwal">
                          <tr>
                            <th colspan="5"><center><h2>Jadwal Photo</h2></center></th>
                          </tr>
                          <tr bgcolor="#6C7A89" style="color: white;">
                            <th width="20%"><center>Hari</center></th>
                            <th width="20%"><center>Waktu</center></th>
                            <th><center>Pelanggan</center></th>
                            <th><center>Paket</center></th>
                            <th><center>Kategori</center></th>
                          </tr>
                        </thead>
                        <tbody id="tbody_jadwal">    
                        </tbody>
                      </table>
                    </div><!-- /.box-body -->
                    <div class="overlay" style="display: none" id="loading">
                      <i class="fa fa-refresh fa-spin"></i>
                    </div>
                      <!-- end loading -->
                </div>
        </div>     
    </div>
</section>
<script>
  $(function () {
        event_today();   //pemanggilan fungsi tampil event.
        //fungsi tampil event
        function event_today(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url()?>jadwal/get_event',
                async : false,
                dataType : 'json',
                beforeSend:function(){
                  $("#loading").css("display","block")
                },
                success : function(data){
                    var html = '';
                    var i;
                    if (data.length==0) {
                      html += '<tr align="center">'+
                              '<td colspan="5">Belum ada jadwal untuk hari ini</td>'+
                              '</tr>';
                    }else{
                      html += '<tr align="center">'+
                              '<td rowspan="'+data.length+'">'+data[0].tanggal+'</td>'+
                              '<td>'+data[0].jam+'</td>'+
                              '<td>'+data[0].pelanggan+'</td>'+
                              '<td>'+data[0].paket+'</td>'+
                              '<td>'+data[0].kategori+'</td>'+
                              '</tr>';
                      for(i=1; i<data.length; i++){
                          html += '<tr align="center">'+
                                  '<td>'+data[i].jam+'</td>'+
                                  '<td>'+data[i].pelanggan+'</td>'+
                                  '<td>'+data[i].paket+'</td>'+
                                  '<td>'+data[i].kategori+'</td>'+
                                  '</tr>';
                      }
                    }
                    $('#tbody_jadwal').html(html);
                    $("#loading").css("display","none");
                }

 
            });
        }
        $("#filter").change(function(){
            var param=$(this).val();
            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>jadwal/get_event',
                async : false,
                dataType : 'json',
                data:{param:param},
                beforeSend:function(){
                  $("#loading").css("display","block");
                },
                success: function(data){
                    if (data.length==0) {
                      html += '<tr align="center">'+
                              '<td colspan="5">Belum ada jadwal untuk hari yang dipilih</td>'+
                              '</tr>';
                    }else{
                      var html = '';
                      var i;
                      html += '<tr align="center">'+
                              '<td rowspan="'+data.length+'">'+data[0].tanggal+'</td>'+
                              '<td>'+data[0].jam+'</td>'+
                              '<td>'+data[0].pelanggan+'</td>'+
                              '<td>'+data[0].paket+'</td>'+
                              '<td>'+data[0].kategori+'</td>'+
                              '</tr>';
                      for(i=1; i<data.length; i++){
                          html += '<tr align="center">'+
                                '<td>'+data[i].jam+'</td>'+
                                '<td>'+data[i].pelanggan+'</td>'+
                                '<td>'+data[i].paket+'</td>'+
                                '<td>'+data[i].kategori+'</td>'+
                                '</tr>';
                      }
                    }
                    $('#tbody_jadwal').html(html);
                    $("#loading").css("display","none");
                }
            })

        });
        $("#cari").click(function(){
            var param=$(".mulai").val();
            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>jadwal/get_event',
                async : false,
                dataType : 'json',
                data:{param:param},
                success: function(data){
                   if (data.length==0) {
                      html += '<tr align="center">'+
                              '<td colspan="5">Belum ada jadwal untuk hari yang dipilih</td>'+
                              '</tr>';
                    }else{
                      var html = '';
                      var i;
                      html += '<tr align="center">'+
                              '<td rowspan="'+data.length+'">'+data[0].tanggal+'</td>'+
                              '<td>'+data[0].jam+'</td>'+
                              '<td>'+data[0].pelanggan+'</td>'+
                              '<td>'+data[0].paket+'</td>'+
                              '<td>'+data[0].kategori+'</td>'+
                              '</tr>';
                      for(i=1; i<data.length; i++){
                          html += '<tr align="center">'+
                                '<td>'+data[i].jam+'</td>'+
                                '<td>'+data[i].pelanggan+'</td>'+
                                '<td>'+data[i].paket+'</td>'+
                                '<td>'+data[i].kategori+'</td>'+
                                '</tr>';
                      }
                    }
                    $('#tbody_jadwal').html(html);
                    $("#loading").css("display","none");
                }
            })
        })
  })
</script>