<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Calm breeze login screen</title>
   <link rel="stylesheet" href="<?php echo base_url();?>desain/Login/login.css">  
</head>
<body>
  <div class="wrapper">
  <div class="container">
    <h1>Welcome</h1>
    <form action="<?php echo base_url(); ?>login/aksi_login" method="post">
    <form class="form">
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <input list="Jabatan" name="jabatan" placeholder="Jabatan">
      <datalist id="Jabatan">
          <option value="Admin">
          <option value="Manager">
          <option value="Owner">
          <option value="Fotografer">
      </datalist>
      <button type="submit" name="Login" id="login-button">Login</button>
    </form>
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
 <!-- <script src="<?php echo base_url();?>desain/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
    <script src="<?php echo base_url();?>desain/JS/login.js"></script>

</body>
</html>
