<?php
session_start();
include 'functions.php';
$days=$_GET['days'];
?>
<table class="table  table-bordered table-hover text-center" >
    <thead class="table-primary">
        <tr>
            <th data-orderable="false">Code</th>
            <th class="text-left" data-orderable="false">Projects</th>
            <th data-orderable="false">PM</th>
            <th data-orderable="false" class="text-left">Resource</th>    
        </tr>
    </thead>
    <tbody>
        <?php
       
            include '../Inc/DBcon.php';
            $filter='';
            if(isset($_SESSION['Amanager']) && $_SESSION['Amanager']!='all')
            {
            $filter=" AND ID='".$_SESSION['Amanager']."' ";
            }
            $filter1=" office in (2,4)";
            $filter2="";
            if(isset($_SESSION['Aoffice']) && $_SESSION['Aoffice']!='all')
            {
            $filter1=" office='".$_SESSION['Aoffice']."' ";
            }
            if(isset($_SESSION['Astatus']) && $_SESSION['Astatus']!='all')
            {
            $filter2=" AND status='".$_SESSION['Astatus']."' ";
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
                            if(getBaliAndHResourceProject($row2['ID'],$filter1))
                            {
                                $pm=getManager($row2['manager_id']);
                                $review=getProjectLatestReview($row2['ID']);
    
                                $comments="";
                                if($review!=0)
                                {
                                
                                    if($review['status']!=0)
                                    {   $re=getProjectReview($review['status']);
                                        $status=$re['name'];
                                        
                                    }
                                }
                                $comments=getResourceList($row2['ID'],$days,$filter1);
                               
                                    echo '<tr>  
                                    <td  >'.$row2['code'].'</td>
                                    <td class="text-left">'.$row2['name'].'</td>
                                    <td>'.$pm['nick_name'].'</td>
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