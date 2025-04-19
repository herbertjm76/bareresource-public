<?php session_start(); include '../script/islogin.php';include '../script/functions.php';  $_SESSION['nav']='f-overall';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Project Overall Dashboard</title>
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
 
 td{min-width: 30px !important;}
 
 
 
.table-responsive1 {
  width: 100%;
  overflow-x: scroll;
  max-height: 800px;
  overflow-y: auto;
}

table {
  width: 200%;
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
            <h1 class="text-dark"> Project Overall Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Financial</a></li>
              <li class="breadcrumb-item active"> Project Overall Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  
    <!-- Main content -->
    <section class="content">
        
        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary p-0"><i class="fas fa-file-invoice-dollar"></i></span>
                            <div class="info-box-content">
                                <h6 class="info-box-text font-weight-bold ">Invoices This Month </h6>
                                <h4 class="info-box-number font-weight-bolder">
                                <?php
                                    echo getCurrentMonthInvoices(date('Y-m'));
                                    ?>
                                </h4>
                            </div>
                        </div>     
                        <div class="info-box">
                            <span class="info-box-icon bg-primary p-0"><i class="fas fa-file-invoice-dollar"></i></span>
                            <div class="info-box-content">
                                <h6 class="info-box-text font-weight-bold ">Total Outstanding </h6>
                                <h4 class="info-box-number font-weight-bolder">
                                    <?php
                                    echo getCurrentMonthOutstandingInvoices(date('Y-m'));
                                    ?>
                                 
                                </h4>
                            </div>
                        </div>       
                    </div>
                    <div class="col-md-12">
                      <div id="chartContainer1" class="border shadow rounded" style="height: 200px; width: 100%;"></div>
                    </div>
                    <div class="col-md-12 mt-3">
                      <div id="chartContainer2" class="border shadow rounded" style="height: 200px; width: 100%;"></div>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-6">
                  <div class="card card-primary">
                        <div class="card-header ">
                            <h3 class="card-title">Ageing Invoices</h3>
                        </div>
                        <div class="card-body p-1">
                        <div style="height:300px; overflow-y:auto;  " >
                        <table class="table table-bordered table-sm text-center" id="aging-tbl">
                                <thead >
                                    <tr class="table-primary">
                                        <th>Code</th>
                                        <th>Project Name</th>
                                        <th>PM</th>
                                        <th>Days Overdue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    include '../Inc/DBcon.php';
                               
                                    $sql2="select * from phase_details where invoice_issued!='' AND  invoice_issued<='".date('Y-m-d')."' AND status='Billed';";
                                    $result=mysqli_query($conn,$sql2);
                                    
                                    if(mysqli_num_rows($result) > 0 )
                                    { 
                                        while($row = mysqli_fetch_array($result))
                                        {
                                          $project=getProject($row['project_id']);
                                          $pm=getManager($project['manager_id']);
                                           
                                            
                                            $color="bg-danger";
                                            $idate=$row['invoice_issued'];
                                            $now = time(); // or your date as well
                                            $your_date = strtotime($row['invoice_issued']);
                                            $datediff =   $now-$your_date;
                                            $age=0;
                                            if($row['invoice_issued']!=NULL && $row['invoice_issued']<date('Y-m-D') && $row['status'] =="Billed")    
                                            {
                                               $start = strtotime($row['invoice_issued']);
                                              $end = strtotime(date('Y-m-d'));
                                              $days_between = ceil(abs($end - $start) / 86400);
                                                if($days_between<0)
                                                {
                                                    $age=0;
                                                }
                                                else{
                                                    $age= $days_between;
                                                }
                                                
                                            }
                                            if($age>0)
                                            {
                                              echo'<tr>
                                              <td>'.$project['code'].'</td>
                                              <td class="text-left">'.$project['name'].'</td>
                                              <td>'.$pm['nick_name'].'</td>
                                              <td><span class="badge '.$color.'" style="font-size: 15px;">'.$age.'</span></td>
                                          </tr>';
                                            }
                                          
                                        }
                                    }
                                    mysqli_close($conn); 
                                  
                                  ?>
                                     
                                     
                                </tbody>
                            </table>
                            </div>
                        </div>
                </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-primary">
                    <div class="card-header ">
                        <h3 class="card-title">Upcoming Invoices</h3>
                    </div>
                    <div class="card-body p-1">
                        <div style="overflow-x: scroll;" class="d-flex">
                           <?php
                           
                            echo ' <br><div style="min-height:275px;   min-width:100%" class="m-1">
                            <div class="fs-3 font-weight-bold"></div>
                            <table class="table table-bordered table-sm">
                                <thead >
                                    <tr class="table-primary">
                                        <th>Month</th>
                                        <th>Code</th>
                                        <th>Project Name</th>
                                        <th>PM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ';
                                include '../Inc/DBcon.php';
                               
                              $sql2="select * from phase_details where billing_month>='".date('Y-m')."' ORDER BY billing_month ;";
                              $result=mysqli_query($conn,$sql2);
                              
                              if(mysqli_num_rows($result) > 0 )
                              { 
                                  while($row = mysqli_fetch_array($result))
                                  {
                                    $project=getProject($row['project_id']);
                                    $pm=getManager($project['manager_id']);
                                    echo'
                                    <tr>
                                        <td>'.date('M-Y',strtotime($row['billing_month'])).'</td>
                                        <td>'.$project['code'].'</td>
                                        <td>'.$project['name'].'</td>
                                        <td>'.$pm['nick_name'].'</td>
                                    </tr>';
                                  }
                              }
                              mysqli_close($conn); 
                                     
                                     
                                echo'</tbody>
                            </table>
                        </div>';
                        
                           
                           
                           ?>
                             
                        </div>
                    </div>
                </div>
                </div>
              </div>
               
                
             
                
                <div class="card card-primary">
                        <div class="card-header ">
                            <h3 class="card-title">Budget Utilization & Status</h3>
                        </div>
                        <div class="card-body p-1">
                        <div style="height:300px; overflow-y:auto; width:100%;"  >
                            <table class="table table-bordered table-sm text-center">
                                <thead >
                                    <tr class="table-primary">
                                        <th>Code</th>
                                        <th style="width: 80px !important;">Project Name</th>
                                        <th>PM</th>
                                        <th>Budget Utilization Bar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    include '../Inc/DBcon.php';
                               
                                    $sql2="select * from projects ;";
                                    $result=mysqli_query($conn,$sql2);
                                    
                                    if(mysqli_num_rows($result) > 0 )
                                    { 
                                        while($row = mysqli_fetch_array($result))
                                        {
                                           
                                          $pm=getManager($row['manager_id']);
                                            
                                           
                                          echo'<tr>
                                                  <td>'.$row['code'].'</td>
                                                  <td class="text-left">'.$row['name'].'</td>
                                                  <td>'.$pm['nick_name'].'</td>
                                                  <td>
                                                    <div class="progress">
                                                      <div class="progress-bar bg-danger" style="width:80%"></div>
                                                    </div>
                                                  </td>
                                              </tr>';
                                        }
                                    }
                                    mysqli_close($conn); 
                                  
                                  ?>
                                    <tr>
 
                                </tbody>
                            </table>
                        </div>
                        </div>
                </div>
            </div>
            
            
            <div class="col-md-6">
               
            </div>
            <div class="col-md-6">
                
            </div>
              
        </div>
         
       

    </section>
    <!-- /.content -->
    
    
  </div>
  <!-- /.content-wrapper -->
   
  <script>
    window.onload = function () {
      sortTable('aging-tbl', 3);
			 
   var options1 = {
     animationEnabled: true,
     title: {
       text: "INVOICES BY REGION",
           fontFamily: "arial"
     },
     data: [{
       type: "doughnut",
       innerRadius: "70%",
       legendText: "{label}",
       indexLabel: "{label}: {y}",
       dataPoints: [
         <?php
           include '../Inc/DBcon.php';
           
           $sql2="select * from country ;";
           $result=mysqli_query($conn,$sql2);
           $array2= array();
           if(mysqli_num_rows($result) > 0 )
           { 
               while($row = mysqli_fetch_array($result))
               {
                 $sql2="select * from projects where country_id='".$row['ID']."' ;";
                 $pro=mysqli_query($conn,$sql2);
                 if(mysqli_num_rows($pro)>0)
                 {
                  while($row2 = mysqli_fetch_array($pro))
                  {
                    $sql2="select * from phase_details where project_id='".$row2['ID']."' AND invoice_issued!='' ;";
                    $pro2=mysqli_query($conn,$sql2);
                    $array2+=[$row['name']=> mysqli_num_rows($pro2)];
                  }
                   
                 }
                  
               }
           }
           foreach($array2 as $key => $val)
           {
             echo '{ label: "'.$key.'", y: '.$val.' },';
           }
           mysqli_close($conn);
         ?> 
       ]
     }]
   };
$("#chartContainer1").CanvasJSChart(options1);
var options2 = {
     animationEnabled: true,
     title: {
       text: "OUTSTANDING BY REGION",
           fontFamily: "arial"
     },
     data: [{
       type: "doughnut",
       innerRadius: "70%",
       legendText: "{label}",
       indexLabel: "{label}: {y}",
       dataPoints: [
         <?php
           include '../Inc/DBcon.php';
           
           $sql2="select * from country ;";
           $result=mysqli_query($conn,$sql2);
           $array2= array();
           if(mysqli_num_rows($result) > 0 )
           { 
               while($row = mysqli_fetch_array($result))
               {
                 $sql2="select * from projects where country_id='".$row['ID']."' ;";
                 $pro=mysqli_query($conn,$sql2);
                 if(mysqli_num_rows($pro)>0)
                 {
                  while($row2 = mysqli_fetch_array($pro))
                  {
                    $sql2="select * from phase_details where project_id='".$row2['ID']."' AND status!='Paid'  AND invoice_issued!=''  ;";
                    $pro2=mysqli_query($conn,$sql2);
                    $array2+=[$row['name']=> mysqli_num_rows($pro2)];
                  }
                   
                 }
                  
               }
           }
           foreach($array2 as $key => $val)
           {
             echo '{ label: "'.$key.'", y: '.$val.' },';
           }
           mysqli_close($conn);
         ?> 
       ]
     }]
   };
   $("#chartContainer2").CanvasJSChart(options2);
    }
    function sortTable(table_id, sortColumn){
    var tableData = document.getElementById(table_id).getElementsByTagName('tbody').item(0);
    var rowData = tableData.getElementsByTagName('tr');            
    for(var i = 0; i < rowData.length - 1; i++){
        for(var j = 0; j < rowData.length - (i + 1); j++){
            if(Number(rowData.item(j).getElementsByTagName('td').item(sortColumn).innerHTML.replace(/[^0-9\.]+/g, "")) < Number(rowData.item(j+1).getElementsByTagName('td').item(sortColumn).innerHTML.replace(/[^0-9\.]+/g, ""))){
                tableData.insertBefore(rowData.item(j+1),rowData.item(j));
            }
        }
    }
}
 
  </script>
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
                                
  <?php include '../Inc/footer.php';?>
   
  <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
</body>
</html>
