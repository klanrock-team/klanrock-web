<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>KlanrocK Login</title>
   <link rel="stylesheet" href="<?php echo base_url();?>desain/Login/login.css">
       <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>desain/admin/bootstrap/css/bootstrap.min.css">
    <!-- fullCalendar -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">  
</head>
<body>
  <div class="wrapper">
  <div class="container" style="margin-top: 100px;">
    <h1 style="color: white;">KlanrocK Login</h1>
    <form action="<?php echo base_url(); ?>login/aksi_login" method="post" class="form">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="Login" id="login-button">Login</button>
    </form>
     <?php if($this->session->flashdata()){?>
     <center><div style="width: 250px;" class="alert alert-danger"><?php echo $this->session->flashdata('message');?></div></center>
                        
                <?php
                    }
                ?>
  </div>
  
  <ul class="bg-bubbles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
  </ul>
</div>
</body>
 <!-- <script src="<?php echo base_url();?>desain/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
    <script src="<?php echo base_url();?>desain/JS/login.js"></script>
    <script src="<?php echo base_url();?>desain/JS/notify.js"></script>  
    <!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url();?>desain/admin/bootstrap/js/bootstrap.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
</html>
