<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KlanrocK | Control Panel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/plugins/iCheck/flat/blue.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/plugins/iCheck/flat/red.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- dropzone -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/plugins/dropzone/css/dropzone.css">
    <!-- dropify -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/plugins/dropify/dist/css/dropify.css">
    <!-- fancybox -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/plugins/fancybox/fancybox.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/plugins/select2/select2.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/plugins/datatables/dataTables.bootstrap.css">
    <!-- galery css -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/galery.css">    
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <script src="<?php echo base_url(); ?>desain/ckeditor/ckeditor.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>desain/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url();?>desain/JS/myjs.js"></script>
    
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url();?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>K</b>RcK</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Klan</b>rocK</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                     <li class="dropdown user user-menu" title="Log Out">
                        <a href="#">
                            <i class="fa fa-power-off" > <span class="hidden-xs">Log Out</span></i>
                        </a>
                      </li>
                      <!-- Control Sidebar Toggle Button -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <?php $this->load->view($menu)?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

       <?php $this->load->view($body);?>
        <script>
            $(function () {
                //Initialize Select2 Elements
                $(".select2").select2(); 
                //Enable check and uncheck all functionality
                $(".checkbox-toggle").click(function () {
                  var clicks = $(this).data('clicks');
                  if (clicks) {
                    //Uncheck all checkboxes
                    $(".tabel-box input[type='checkbox']").iCheck("uncheck");
                    $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
                  } else {
                    //Check all checkboxes
                    $(".tabel-box input[type='checkbox']").iCheck("check");
                    $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
                  }
                  $(this).data("clicks", !clicks);
                });
                //datatable
                $("#example1").DataTable();
                $('.Tabel_Data').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": false,
                    "info": true,
                    "autoWidth": true
                });
                $("[data-fancybox]").fancybox({ });
            });
        </script>

    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2018 <a href="#">Fendrik Nurul Jadid</a>.</strong> All rights reserved.
    </footer>

</div><!-- ./wrapper -->


<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url();?>desain/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url();?>desain/admin/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url();?>desain/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>desain/admin/plugins/select2/select2.full.js"></script>
<script src="<?php echo base_url();?>desain/admin/plugins/select2/select2.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url();?>desain/admin/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url();?>desain/admin/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url();?>desain/admin/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url();?>desain/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url();?>desain/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url();?>desain/admin/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?php echo base_url();?>desain/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url();?>desain/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>desain/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>desain/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url();?>desain/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url();?>desain/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>desain/admin/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>desain/admin/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url();?>desain/admin/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>desain/admin/dist/js/demo.js"></script>
<script src="<?php echo base_url();?>desain/admin/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url();?>desain/admin/plugins/dropzone/dropzone.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>desain/admin/plugins/dropify/dist/js/dropify.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>desain/admin/plugins/fancybox/fancybox.js" type="text/javascript"></script>
</body>
</html>
