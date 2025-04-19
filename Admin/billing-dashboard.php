<?php session_start(); include '../script/islogin.php';include '../script/functions.php';  $_SESSION['nav']='f-overall';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Project Billing Dashboard</title>
  <?php include '../Inc/head.php';
     
  ?>
<style>
  .yes-d{
    cursor: pointer !important;
  }
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
            <h1 class="text-dark"> Project Billing Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Financial</a></li>
              <li class="breadcrumb-item active"> Project Billing Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  
    <!-- Main content -->
    <section class="content">
    <div class="card card-primary">
        <div class="card-header">
              <h3 class="card-title ">Filters</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                    <label>Office</label>
                    <select class="form-control form-control-sm select2" id="boffice" style="width: 100%;" onchange="SetFilter(this.id,this.value)">
                            <option value="all">All</option>
                            <?php
                                    include '../Inc/DBcon.php';
                                    $sql2="select * from office where status='1'";
                                    $result=mysqli_query($conn,$sql2);
                                    if(mysqli_num_rows($result) > 0 )
                                    {
                                        
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            if(isset($_SESSION['boffice']))
                                            {
                                                    if($_SESSION['boffice']==$row['ID'])
                                                    {
                                                        echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'</option>';
                                                    }
                                                    else
                                                    {
                                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                                    }
                                            }else
                                            {
                                                echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                            }
                                            
                                        }
                                    }
                                    mysqli_close($conn);
                                ?>

                    </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label>Project Region</label>
                    <select class="form-control form-control-sm select2" id="bregion" style="width: 100%;" onchange="SetFilter(this.id,this.value)">
                            <option value="all">All</option>
                            <?php
                                    include '../Inc/DBcon.php';
                                    $sql2="select * from country where status='1'";
                                    $result=mysqli_query($conn,$sql2);
                                    if(mysqli_num_rows($result) > 0 )
                                    {
                                        
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            if(isset($_SESSION['bregion']))
                                            {
                                                    if($_SESSION['bregion']==$row['ID'])
                                                    {
                                                        echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'-'.$row['tag'].'</option>';
                                                    }
                                                    else
                                                    {
                                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'-'.$row['tag'].'</option>';
                                                    }
                                            }else
                                            {
                                                echo '<option value="'.$row['ID'].'">'.$row['name'].'-'.$row['tag'].'</option>';
                                            }
                                            
                                        }
                                    }
                                    mysqli_close($conn);
                                ?>
                    </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label>Project Manager</label>
                    <select class="form-control form-control-sm select2" id="bmanager" style="width: 100%;" onchange="SetFilter(this.id,this.value)">
                            <option value="all">All</option>
                            <?php
                                    include '../Inc/DBcon.php';
                                    $sql2="select * from staff where status='1' AND role_id='1'";
                                    $result=mysqli_query($conn,$sql2);
                                    if(mysqli_num_rows($result) > 0 )
                                    {
                                        
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            if(isset($_SESSION['bmanager']))
                                            {
                                                    if($_SESSION['bmanager']==$row['ID'])
                                                    {
                                                        echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'</option>';
                                                    }
                                                    else
                                                    {
                                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                                    }
                                            }else
                                            {
                                                echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                            }
                                            
                                        }
                                    }
                                    mysqli_close($conn);
                                ?>
                    </select>
                    </div>
                </div>
                    
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm btn-block " style="margin-top: 29px;" onclick="ClearFilter()"><i class="fa fa-trash" ></i> Clear</button>
                </div>
                    
            </div>
        </div>

    </div>
    <div class="card card-primary">
        <div class="card-header">
              <h3 class="card-title ">Budget Utilization & Status</h3>
            </div>
            <div class="card-body p-1" id="project-list">
            
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
  <script src="../Inc/billing-dashboard.js"></script>
 
</body>
</html>
