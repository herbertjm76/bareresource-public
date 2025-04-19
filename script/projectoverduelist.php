<?php session_start(); include 'functions.php';?>
<div class="table-responsive">
              <table id="example11" class="table table-head-fixed table-sm table-bordered text-center" style="font-size: 14px;">
                <thead  >
                <tr class="table-primary">
                    <th>Code</th>
                    <th>Project Name</th>
                    <th>PM</th>
                    <th>Currency</th>
                    <th  style="background-color:#A9D08E">30 Days</th>
                    <th style="background-color:#BDD7EE">60 Days</th>
                    <th style="background-color:#FFD094">90 Days</th>
                    <th style="background-color:#FFACA7">120 Days</th>
                    <th>Total</th>
                    <th>Action</th>
                    <th>Remarks</th>
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
                        $t30=$t60=$t90=$t120=$tt=0;
                        if(mysqli_num_rows($result) > 0 )
                        { 
                            while($row = mysqli_fetch_array($result))
                            {
                                $pm=getManager($row['manager_id']);
                                $currentyear=getCurrentYearFee($row['ID']);
                                $projectdetails=getProjectDetails($row['ID']);
                                $cur=$projectdetails!=''? $projectdetails['currency'] : '' ;
                                $total=0;
                                $d30=getBilling30Days($row['ID']);
                                $d60=getBilling60Days($row['ID']);
                                $d90=getBilling90Days($row['ID']);
                                $d120=getBilling120Days($row['ID']);
                                if($d30!=''){ $total=$d30; $t30=$t30+$d30; $d30=number_format($d30,2); }
                                if($d60!=''){ $total=$total+$d60; $t60=$t60+$d60; $d60=number_format($d60,2); }
                                if($d90!=''){ $total=$total+$d90; $t90=$t90+$d90; $d90=number_format($d90,2); }
                                if($d120!=''){ $total=$total+$d120; $t120=$t120+$d120; $d120=number_format($d120,2);}
                                if($total!=0)
                                {
                                  $tt=$tt+$total;
                                  $total=number_format($total,2);
                                  
                                }
                                else{
                                  $total='';
                                }
                                echo '<tr> <td>'.$row['code'].'</td>
                                        <td class="text-left" style="width:50px !important;">'.$row['name'].'</td>
                                        <td>'.$pm['nick_name'].'</td>
                                        <td class="font-weight-bold" >'.$cur.'</td>
                                        <td class="font-weight-bold  " style="background-color:#A9D08E">'.$d30.'</td> 
                                        <td class="font-weight-bold  " style="background-color:#BDD7EE">'.$d60.' </td>
                                        <td class="font-weight-bold"  style="background-color:#FFD094"> '.$d90.'</td>
                                        <td class="font-weight-bold " style="background-color:#FFACA7">'.$d120.' </td>
                                        <td class="font-weight-bold">'.$total .' </td>
                                        <td> </td>
                                        <td> </td></tr>
                                         ';
                                        
                            }
                        }
                        mysqli_close($conn); 
                        
                    ?>
                    
                </tbody>
                <tfoot>
                <tr class="table-primary">
                    <th> </th>
                    <th> </th>
                    <th> </th>
                    <th> </th>
                    <th style="background-color:#A9D08E"><?=number_format($t30,2);?></th>
                    <th style="background-color:#BDD7EE"><?=number_format($t60,2);?></th>
                    <th style="background-color:#FFD094"><?=number_format($t90,2);?></th>
                    <th style="background-color:#FFACA7"><?=number_format($t120,2);?></th>
                    <th><?=number_format($tt,2);?></th>
                    <th> </th>
                    <th> </th>
                </tr>
                </tfoot>
              </table>
            </div>