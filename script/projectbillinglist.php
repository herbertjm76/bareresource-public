<?php session_start(); include 'functions.php';?>
<div class="table-responsive">
              <table id="example11" class="table table-head-fixed table-sm table-bordered   text-center" style="font-size: 14px;">
                <thead  >
                <tr class="table-primary">
                    <th>Code</th>
                    <th>Project Name</th>
                    <th>PM</th>
                    <th>Contract</th>
                    <th>Unallocated</th>
                    <th><?=date('Y')?> Fee</th>
                    <?php 
                    $ar= array();
                    foreach($Months as $value)
                    {
                      $ar+=[$value=> 0];
                        echo '<th>'.$value.'</th>';
                    }
                    ?>
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
                        $contract=0;
                        $unallocated=0;
                        $cyear=0;
                        $jan=$fab=$mar=$apr=$may=$jun=$jul=$aug=$sep=$oct=$nov=$dec=0;
                        
                        if(mysqli_num_rows($result) > 0 )
                        { 
                          $i=0;
                            while($row = mysqli_fetch_array($result))
                            {
                                $projectDetails=getProjectDetails($row['ID']);
                                $pm=getManager($row['manager_id']);
                                $currentyear=getCurrentYearFee($row['ID']);
                                $contract+= $projectDetails!=''?$projectDetails['contract_amount']:0;
                                $cont= $projectDetails!=''?number_format($projectDetails['contract_amount']):'';
                                $cyear=$cyear+$currentyear;
                                echo '<tr> <td>'.$row['code'].'</td>
                                        <td>'.$row['name'].'</td>
                                        <td>'.$pm['nick_name'].'</td>
                                        <td class="cost-col">'.$cont.'</td>
                                        <td class="cost-col"> </td>
                                        <td class="cost-col">'.number_format($currentyear).'</td>';
                                         
                                        foreach($Months as $value)
                                        {
                                           $color='';
                                           $bm=getBillingMonthDetails(date('Y-m',strtotime($value)),$row['ID']);
                                            if($bm!=0 && $bm['status']=='Paid')
                                            {
                                              $color='#F6B26B';
                                            }
                                            else if($bm!=0 && $bm['status']=='Billed')
                                            {
                                              $color='#FFE599';
                                            } 
                                            else if($bm!=0 && $bm['status']=='Not Billed')
                                            {
                                              $color='';
                                            }
                                            $detils='';
                                            if(getBillingMonthFee(date('Y-m',strtotime($value)),$row['ID']) !='' )
                                            {
                                              $ar[$value]=$ar[$value]+(int)getBillingMonthFee(date('Y-m',strtotime($value)),$row['ID']);
                                              $phase=getStage($bm['phase_id']);
                                              $office=getOffice($row['office_id']);

                                              $start = strtotime($bm['invoice_issued']);
                                              $end = strtotime(date('Y-m-d'));
                                              $days_between = ceil(abs($end - $start) / 86400);
                                              $detils=$phase['short_name'].' &#xA;ACR: '.$office['hour_rate'].'&#xA;Fee: $'.$bm['budget'].'&#xA;Billing Month: '.date('M Y',strtotime($bm['billing_month'])).'&#xA;Status: '.$bm['status'].'&#xA;Invoice Issued: '.$bm['invoice_issued'].'&#xA;Invoice Age: '.$days_between.' Days';
                                            }
                                            echo '<td class="yes-d" style="background-color: '.$color.'" data-tooltip="tooltip" data-placement="top" title="'.$detils.'" data-html="true" > '.getBillingMonthFee(date('Y-m',strtotime($value)),$row['ID']).' </td>';
                                        }
                                        
                                        echo '</tr>';
                            }
                        }
                        mysqli_close($conn); 
                        
                    ?>
                    
                </tbody>
                <tfoot>
                  <tr >
                    <td colspan="3"></td>
                     
                    <td class="cost-col"><?=number_format($contract)?></td>
                    <td class="cost-col"><?=number_format($unallocated)?></td>
                    <td class="cost-col"><?=number_format($cyear)?></td>
                    <?php
                    foreach($ar as $key => $val)
                    {
                      if($val>0)
                      {
                        echo ' <td class="cost-col">'.number_format($val).'</td>';
                      }
                      else{
                        echo ' <td class="cost-col"> </td>';
                      }
                      
                    }
                    ?>
                     
                  </tr>
                </tfoot>        
              </table>
            </div>