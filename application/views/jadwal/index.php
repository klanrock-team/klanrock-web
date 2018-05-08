
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
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <!-- THE CALENDAR -->
                      <div id="kalender"></div>
                    </div><!-- /.box-body -->
                </div>
        </div>     
    </div>
</section>
<script>
  $(function () {
        eventku();   //pemanggilan fungsi tampil barang.
        // $('.mydata').dataTable();
        //fungsi tampil barang
        function eventku(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url()?>jadwal/test',
                async : false,
                dataType : 'json',
                success : function(data){
                    json_events = data;
                    alert(JSON.parse(json_events));
                }
 
            });
        }
        // $('#kalender').fullCalendar({

        // });
    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#kalender').fullCalendar({
      locale : 'id',
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      titleFormat : 'D MMMM YYYY',
      //Random default events
      events    : [

        {
          title          : 'Meeting',
          start          : new Date(y, m, d, 10, 30),
          allDay         : false,
          backgroundColor: '#0073b7', //Blue
          borderColor    : '#0073b7' //Blue
        },
        {
          title          : 'Lunch',
          start          : new Date(y, m, d, 12, 0),
          end            : new Date(y, m, d, 14, 0),
          allDay         : false,
          backgroundColor: '#00c0ef', //Info (aqua)
          borderColor    : '#00c0ef' //Info (aqua)
        },
        {
          title          : 'Birthday Party',
          start          : new Date(y, m, d + 1, 19, 0),
          end            : new Date(y, m, d + 1, 22, 30),
          allDay         : false,
          backgroundColor: '#00a65a', //Success (green)
          borderColor    : '#00a65a' //Success (green)
        },
        {
          title          : 'Click for Google',
          start          : new Date(y, m, 28),
          end            : new Date(y, m, 29),
          url            : 'http://google.com/',
          backgroundColor: '#3c8dbc', //Primary (light-blue)
          borderColor    : '#3c8dbc' //Primary (light-blue)
        }
      ],
      editable  : false,
      footer : false,
    })
  })
</script>