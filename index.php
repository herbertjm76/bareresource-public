<?php session_start();
 
include 'script/getsite.php';
if(isset($_SESSION['uid']))
{ 
  if($_SESSION['role']==1)
  {
    header("Location:Admin/index.php");
  }
  else{
    header("Location:Admin/weekly-resource.php");
  }
   
} ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $_SESSION['site']?> | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="dist/img/<?= $_SESSION['fav']?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <!-- SweetAlert2 -->
   <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
     <!-- pace-progress -->
     <link rel="stylesheet" href="plugins/pace-progress/themes/black/pace-theme-flat-top.css">
</head>
<body class="hold-transition login-page  pace-primary accent-primary">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b><?= $_SESSION['prefix']?></b><?= $_SESSION['suffix']?></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="javascript:void(0)" method="post" onsubmit=" return login()" >
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" id="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="pass" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          <p class="mt-4">
            <a href="register.php">Create new Account</a>
          </p>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
     
      <div class="social-auth-links mb-3">
      
      
      </div>
      <!-- /.social-auth-links -->
      <p class="mb-1">
        <a href="javascript:void(0)" onclick="ForgotBox()">Forgot Password?</a>
      </p>
      <div id="forgot-box" style="display: none;">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" id="femail" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block" onclick="SendMail()">Continue</button>
      </div>
      
       
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

 <!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Login Script -->
<script src="Inc/login-script.js"></script>
  <!-- pace-progress -->
  <script src="plugins/pace-progress/pace.min.js"></script>

  <?php
    if(isset($_SESSION['response']))
    {
      if($_SESSION['response']==22)
      {
        echo '<script>toastr["success"]("Password Reset Successfully. Now you can login.");</script>';
      }
      unset($_SESSION['response']);
    }
    
    ?>
</body>
</html>
