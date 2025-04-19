<?php session_start();include 'functions.php'; $days=$_GET['days']; ?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-hover text-center pro-list ">
        <thead>
            <tr>
                <th data-orderable="false">ID</th>
                <th data-orderable="false">Action</th>
                <th  >PM</th>
                <th data-orderable="false">Code</th>
                <th class="text-left" data-orderable="false">Projects</th>
                <th  >Deadline</th>
                <th data-orderable="false">Project State</th>
                <th data-orderable="false">Remarks</th>
                <th data-orderable="false" class="text-left">Additional Comments</th>    
                <th data-orderable="false" class="text-left">Resource</th> 
            </tr>
        </thead>
        <tbody>
                <?php
                    include '../Inc/DBcon.php';
                    $filter="";
                    $filter2="";
                    $filter3=" 1=1";
                    if(isset($_SESSION['SUfilter']) )
                    {
                        if( isset($_SESSION['smanager']) && $_SESSION['smanager']!='all')
                        {
                          $filter.=" AND ID='".$_SESSION['smanager']."' ";
                        }
                        if( isset($_SESSION['sregion']) && $_SESSION['sregion']!='all')
                        {
                          $filter2.=" AND country_id='".$_SESSION['sregion']."' ";
                        }
                        if( isset($_SESSION['soffice']) && $_SESSION['soffice']!='all')
                        {
                          $filter3=" office='".$_SESSION['soffice']."' ";
                        }
                        if( isset($_SESSION['sstatus']) && $_SESSION['sstatus']!='all')
                        {
                          $filter2.=" AND status='".$_SESSION['sstatus']."' ";
                        }
                    }
                    $sql2="select * from staff where role_id='1' ".$filter." ;";
                    $result1=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result1) > 0 )
                    {
                    $i=1;
                    while($row1 = mysqli_fetch_array($result1))
                        {
                        $sql2="select * from projects where manager_id='".$row1['ID']."' ".$filter2." order by deadline;";
                        $result2=mysqli_query($conn,$sql2);
                        if(mysqli_num_rows($result2) > 0 )
                        {
                            while($row2 = mysqli_fetch_array($result2))
                            {
                                if(getBaliAndHResourceProject($row2['ID'],$filter3))
                                {
                                $pm=getManager($row2['manager_id']);
                                $review=getProjectLatestReview($row2['ID']);
                                $status="";
                                $comments="";
                                $resource=getResourceList($row2['ID'],$days,$filter3);
                                if($review!=0)
                                {
                                    $comments=$review['comments'];
                                    if($review['status']!=0)
                                    {   $re=getProjectReview($review['status']);
                                        $status=$re['name'];
                                        
                                    }
                                }

                                    $state=getStatus($row2['status']);
                                    if($resource!="")
                                    {
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
                                        <td class=" week" id="'.$row2['ID'].'-D" onclick="FetchDeadline(this.id)"   data-orderable="false" data-toggle="modal" data-target="#deadline-model">'.$row2['deadline'].'</td>
                                        <td>'.$state['name'].'</td>
                                        <td>'.$status.'</td>
                                        <td class="text-left"> '.$comments.'</td>
                                        <td class="text-left"> '. $resource.'  </td>
                                        </tr>';
                                    }
                                
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