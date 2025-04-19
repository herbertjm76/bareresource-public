<?php session_start(); include 'functions.php';?>
<div class="table-responsive">
              <table id="example11" class="table table-head-fixed table-sm table-bordered   text-center" style="font-size: 14px;">
                <thead  >
                <tr class="table-primary">
                    <th>Code</th>
                    <th>Project Name</th>
                    <th>PM</th>
                    <th>Budget Utilization Bar</th>
                    <th>Profit Margin</th>
                    <th>Project Completion</th>
                    <th>Remaining Hours</th>
                     
                </tr>
                </thead>
                <tbody>
                        <?php 
                        include '../Inc/DBcon.php'; 
                        $filter="";
                        if( isset($_SESSION['boffice']) && $_SESSION['boffice']!='all')
                        {
                          $filter.=" AND office_id='".$_SESSION['boffice']."' ";
                        }
                        if( isset($_SESSION['bregion']) && $_SESSION['bregion']!='all')
                        {
                          $filter.="AND country_id='".$_SESSION['bregion']."' ";
                        }
                        
                        if( isset($_SESSION['bmanager']) && $_SESSION['bmanager']!='all')
                        {
                          $filter.="AND manager_id='".$_SESSION['bmanager']."' ";
                        }
                        $sql2="select * from projects where 1=1 ".$filter." ;";
                        $result=mysqli_query($conn,$sql2);
                        
                        if(mysqli_num_rows($result) > 0 )
                        { 
                            while($row = mysqli_fetch_array($result))
                            {
                                $pm=getManager($row['manager_id']);
                                $currentyear=getCurrentYearFee($row['ID']);
                                $projectdetails=getProjectDetails($row['ID']);
                                 $margin=$projectdetails!=''?$projectdetails['margin_perst']."%":'';
                                 $complet=$projectdetails!=''?$projectdetails['complete_perst']:'';
                                 $color=$color2='';
                                 if($complet!='' && $complet<30){$color='bg-danger';}
                                 else if($complet!='' && $complet>=30 && $complet<=60 ){$color='bg-warning';}
                                 else if($complet!='' && $complet>=60 && $complet<=90 ){$color='bg-primary';}
                                 else if($complet!='' && $complet>90){$color='bg-success';}
                                 $complet=$projectdetails!=''?$projectdetails['complete_perst']."%":'';
                                 $Rem=$projectdetails!=''?$projectdetails['remaining_hours']:'';
                                 if($Rem!='' && $Rem<50 && $Rem>0){$color2='badge-success';}
                                 else if($Rem!='' && $Rem<80){$color2='badge-primary';}
                                 else if($Rem!='' && $Rem<130){$color2='badge-warning';}
                                 else if($Rem!='' && $Rem>130){$color2='badge-danger';}
                                 else{
                                  $color2='badge-danger';
                                 }
                                echo '<tr> <td>'.$row['code'].'</td>
                                        <td class="text-left">'.$row['name'].'</td>
                                        <td>'.$pm['nick_name'].'</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" style="width:80%"></div>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">'.$margin.' </td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar '.$color.'" style="width:'.$complet.'"> '.$complet.'</div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge '.$color2.'" style="font-size: 15px;">'.$Rem.'</span>
                                        </td>';
                                        
                                        echo '</tr>';
                            }
                        }
                        mysqli_close($conn); 
                        
                    ?>
                    
                </tbody>
              </table>
            </div>