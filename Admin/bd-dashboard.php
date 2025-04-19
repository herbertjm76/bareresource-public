<?php session_start(); include '../script/islogin.php';include '../script/functions.php';  $_SESSION['nav']='bd-dash';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Project Overdue Invoices</title>
  <?php include '../Inc/head.php';
     
  ?>
<style>
  thead
{
  position: sticky;
  top: 0;
  z-index: 2;
  background-color: white;
}
  .stiky {
  position: sticky;
 left: 0;
  z-index: 1;
  background-color: white;
 
}
 td{min-width: 30px !important;}
td.stiky:nth-child(1), th.stiky:nth-child(1) {
  left: 0px  ;
}
td.stiky:nth-child(2) , th.stiky:nth-child(2){
  left: 20px;  
}
td.stiky:nth-child(3) , th.stiky:nth-child(3){
  left: 65px;  
}
td.stiky:nth-child(4) , th.stiky:nth-child(4){
  left: 115px;  
}
td.stiky:nth-child(5) , th.stiky:nth-child(5){
  left: 290px;  
}
td.stiky:nth-child(6) , th.stiky:nth-child(6){
  left: 358px;  
}
td.stiky:nth-child(7) , th.stiky:nth-child(7){
  left: 415px;  
}
td.stiky:nth-child(8) , th.stiky:nth-child(8){
  left: 440px;  
}
td.stiky:nth-child(9) , th.stiky:nth-child(9){
  left: 468px;  
}
td.stiky:nth-child(10) , th.stiky:nth-child(10){
  left: 498px;  
}
 
 
.table-responsive1 {
  width: 100%;
  overflow-x: scroll;
  max-height: 800px;
  overflow-y: auto;
}

table {
  width: 200%;
}
.cost-col{
background-color: #FDE9D9;
}
</style>
</head>
<body class="<?= $_SESSION['body'];?>">
<!-- Site wrapper -->
<div class="wrapper">
  
  <!-- /.navbar -->
  <?php include '../Inc/top-nav.php';?>
  <!-- Main Sidebar Container -->
  <?php include '../Inc/side-bar.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="text-dark"> Project Overdue Invoices</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Financial</a></li>
              <li class="breadcrumb-item active"> Project Overdue Invoices</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  
    <!-- Main content -->
    <section class="content">
     <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary p-0"><i class="fas fa-file-invoice-dollar"></i></span>
                            <div class="info-box-content">
                                <h6 class="info-box-text font-weight-bold ">Hit rate % </h6>
                                <h4 class="info-box-number font-weight-bolder">
                                 0
                                </h4>
                            </div>
                        </div>        
                    </div>
                    <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary p-0"><i class="fas fa-file-invoice-dollar"></i></span>
                            <div class="info-box-content">
                                <h6 class="info-box-text font-weight-bold ">Total No of Perposals </h6>
                                <h4 class="info-box-number font-weight-bolder">
                                    0
                                 
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary p-0"><i class="fas fa-file-invoice-dollar"></i></span>
                            <div class="info-box-content">
                                <h6 class="info-box-text font-weight-bold ">Average Conversion Time </h6>
                                <h4 class="info-box-number font-weight-bolder">
                                    0
                                 
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary p-0"><i class="fas fa-file-invoice-dollar"></i></span>
                            <div class="info-box-content">
                                <h6 class="info-box-text font-weight-bold ">Signed Contracts this Year</h6>
                                <h4 class="info-box-number font-weight-bolder">
                                    0
                                 
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             
     </div>
        
         
       

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   
 
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
                                
  <?php include '../Inc/footer.php';?>
  <script src="../Inc/overdue-dashboard2.js"></script>
 
</body>
</html>
