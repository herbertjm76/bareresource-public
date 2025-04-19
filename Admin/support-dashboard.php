<?php session_start(); include '../script/islogin.php'; $_SESSION['nav']='support'; include '../script/functions.php';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Office Engagement Admin</title>
  <?php include '../Inc/head.php';?>

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
          <div class="col-sm-8">
          <div class="d-flex justfiy-content-start">
            <h1 class="text-dark mr-2">Office Engagement Admin</h1>
            <select class="form-control form-control-sm select2 mr-5" id="soffice" style="width: 150px;" onchange="SelectSFilter(this.id,this.value)">
                    <option value="all">All Office</option>
                    <?php
                        include '../Inc/DBcon.php';
                        $sql2="select * from office where status='1' ";
                        $result=mysqli_query($conn,$sql2);
                        if(mysqli_num_rows($result) > 0 )
                        {
                            
                            while($row = mysqli_fetch_array($result))
                            {
                                if(isset($_SESSION['soffice']))
                                {
                                        if($_SESSION['soffice']==$row['ID'])
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
            <div class="d-flex justify-content-center  " style="margin-top: -4px;">
                    <button type="button" class="btn btn-sm btn-outline-secondary m-1 sb1" id="s7day3" onclick="FilterDaysS3(7,this.id)">7 Days</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary m-1 sb1" id="s30day3" onclick="FilterDaysS3(30,this.id)">30 Days</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary m-1 sb1" id="s90day3" onclick="FilterDaysS3(90,this.id)">90 Days</button>
                </div>
          </div>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Support Admin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-primary">
            <div class="card-header">
                <div class="d-flex justfiy-content-start">
                    <h3 class="card-title mr-4 d-flex align-self-center ">Projects under Support Office</h3>
                    <select class="form-control form-control-sm select2  " id="smanager" style="width: 150px;" onchange="SelectSFilter(this.id,this.value)">
                              
                             <option value="all">All Manager</option>
                             <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from staff where status='1' AND role_id='1';";
                                        $result=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result) > 0 )
                                        {
                                            
                                            while($row = mysqli_fetch_array($result))
                                            {
                                            
                                                echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                            }
                                        }
                                        mysqli_close($conn);
                                    ?>
                    </select>
                    &nbsp;&nbsp;
                    <select class="form-control form-control-sm select2" id="sregion" style="width: 150px;" onchange="SelectSFilter(this.id,this.value)">
                              
                             <option value="all">All Location</option>
                             <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from country;";
                                        $result=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result) > 0 )
                                        {
                                            
                                            while($row = mysqli_fetch_array($result))
                                            {
                                            
                                                echo '<option value="'.$row['ID'].'" >'.$row['name'].'</option>';
                                               
                                            }
                                        }
                                        mysqli_close($conn);
                                    ?>
                    </select>
                    &nbsp;&nbsp;
                    <select class="form-control form-control-sm select2" id="sstatus" style="width: 150px;" onchange="SelectSFilter(this.id,this.value)">
                              
                             <option value="all">All Project Status</option>
                             <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from project_status;";
                                        $result=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result) > 0 )
                                        {
                                            
                                            while($row = mysqli_fetch_array($result))
                                            {
                                            
                                                echo '<option value="'.$row['ID'].'" >'.$row['name'].'</option>';
                                               
                                            }
                                        }
                                        mysqli_close($conn);
                                    ?>
                    </select>                              
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body " id="pro-list">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover text-center pro-list">
                        <thead>
                            <tr>
                                <th data-orderable="false" style="width: 20px !important;">ID</th>
                                <th data-orderable="false" style="width: 50px !important;">Action</th>
                                <th data-orderable="false" style="width: 50px !important;">PM</th>
                                <th data-orderable="false" style="width: 50px !important;">Code</th>
                                <th class="text-left" data-orderable="false" style="width: 200px !important;">Projects</th>
                                <th data-orderable="false" style="width: 50px !important;">Deadline</th>
                                <th data-orderable="false" style="width: 70px !important;">Project State</th>
                                <th data-orderable="false">Status</th>
                                <th data-orderable="false" class="text-left">Additional Comments</th>    
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                 include '../Inc/DBcon.php';
                                 $sql2="select * from staff where role_id='1';";
                                 $result1=mysqli_query($conn,$sql2);
                                 if(mysqli_num_rows($result1) > 0 )
                                 {
                                    $i=1;
                                    while($row1 = mysqli_fetch_array($result1))
                                     {
                                        $sql2="select * from projects where manager_id='".$row1['ID']."' order by deadline;";
                                        $result2=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result2) > 0 )
                                        {
                                           while($row2 = mysqli_fetch_array($result2))
                                            {
                                               if(getBaliResourceProject($row2['ID']))
                                               {
                                                $pm=getManager($row2['manager_id']);
                                                $review=getProjectLatestReview($row2['ID']);
                                                $status="";
                                                $comments="";
                                                if($review!=0)
                                                {
                                                    $comments=$review['comments'];
                                                    if($review['status']!=0)
                                                    {   $re=getProjectReview($review['status']);
                                                        $status=$re['name'];
                                                        
                                                    }
                                                }
                                                $state=getStatus($row2['status']);
                                                echo '<tr>
                                                        <td>'.$i.'</td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="name mr-2" onclick="Report('.$row2['ID'].')" data-toggle="modal" data-target="#modal-updates">
                                                                <i class="nav-icon fas fa-eye"></i>
                                                            </a>
                                                             
                                                            <a href="javascript:void(0)" class="name" onclick="Review('.$row2['ID'].')" data-toggle="modal" data-target="#modal-review">
                                                                <i class="nav-icon fas fa-plus"></i>
                                                            </a>
                                                        </td>
                                                        <td>'.$pm['nick_name'].'</td>
                                                        <td  >'.$row2['code'].'</td>
                                                        <td class="text-left">'.$row2['name'].'</td>
                                                        <td>'.$row2['deadline'].'</td>
                                                        <td>'.$state['name'].'</td>
                                                        <td>'.$status.'</td>
                                                        <td class="text-left"> '.$comments.'</td>
                                                      </tr>';
                                                      $i++;
                                               }
                                            }
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

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-updates">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modal-title">Project Updates</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body pace-primary" id="project-updates">
            </div>
            <div class="modal-footer justify-content-end">
              <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-review">
        <div class="modal-dialog modal-md modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modal-title">Add New Review</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body pace-primary"  >
                <div class="form-group">
                    <label for="exampleInputEmail1">Project Remarks</label>
                    <select class="form-control select2" id="pr" style="width: 100%;" >
                    <option value="0">Select Remarks</option>
                        <?php
                                include '../Inc/DBcon.php';
                                $sql2="select * from project_review;";
                                $result=mysqli_query($conn,$sql2);
                                if(mysqli_num_rows($result) > 0 )
                                {
                                    
                                    while($row = mysqli_fetch_array($result))
                                    {
                                    
                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                    }
                                }
                                mysqli_close($conn);
                            ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> New Remarks</label>
                     <input type="text" class="form-control" id="cr" placeholder="Custome Remarks">
                </div> 
                <div class="form-group">
                    <label for="exampleInputEmail1"> Additional Comments</label>
                    <textarea  id="cmnt" cols="30" rows="10" class="form-control" placeholder="Comments"></textarea>
                </div> 
                <input type="hidden"  id="pid">             
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="project-close" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="NewReview()">Add Review</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="deadline-model">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Project DeadLine</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body"  >
                <div class="form-group">
                    <label for="exampleInputEmail1">Deadline</label>
                    <input type="date" class="form-control" id="deadline">
                     
                </div>
                <input type="hidden" id="pid">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="close-deadline" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="UpdateDeadline()">Update</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
  <?php include '../Inc/footer.php';?>
  <script src="../Inc/support-dashboard.js"></script>
</body>
</html>
