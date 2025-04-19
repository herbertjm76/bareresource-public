
<?php 
 include '../Inc/DBcon.php';
 include 'functions.php';
 $project=getProject($_GET['id']);
 $pdetails=getProjectDetails($_GET['id']);
 $camount=$pcurrency=$bppr=$phours=$cdate=$bperst=$rhours=$cperst=$ocost=$tcest=$prec=$margin=$mperst=$perstc=$mab90perst=$variance='';
 if($pdetails!='')
 {
    $camount=$pdetails['contract_amount'];
    $pcurrency=$pdetails['currency'];
    $bppr=$pdetails['budget_per_ppr'];
    $phours=$pdetails['projected_hours'];
    $cdate=$pdetails['cost_to_date'];
    $bperst=$pdetails['billing_perst'];
    $rhours=$pdetails['remaining_hours']; 
    $cperst=$pdetails['complete_perst'];
    $ocost=$pdetails['overhead_cost']; 
    $tcest=$pdetails['total_cost_est']; 
    $prec=$pdetails['proft_recg']; 
    $margin=$pdetails['margin']; 
    $mperst=$pdetails['margin_perst']; 
    $perstc=$pdetails['completion_of_perst']; 
    $mab90perst=$pdetails['max_allow_complete_below_90']; 
    $variance=$pdetails['variance'];
 }
 
?>
<div class="row">
    <div class="col-md-12 col-sm-6">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Project Edit</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Stage Fee</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-Others-tab" data-toggle="pill" href="#custom-tabs-three-Others" role="tab" aria-controls="custom-tabs-three-Others" aria-selected="false">Other Information</a>
                </li>
            </ul>
            </div>
            <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <p class="text-danger text-right">* is required field</p>   
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="required">Project Code</label>
                                <input type="text" class="form-control" id="code1" placeholder="Enter Project Code" value="<?= $project['code'];?>" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="required">Project Name</label>
                                <input type="text" class="form-control" id="name1" placeholder="Enter Project Name"  value="<?= $project['name'];?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="required">Project Manager</label>
                                <select class="form-control select2" id="manager1" style="width: 100%;" >
                                    <?php
                                           include '../Inc/DBcon.php';
                                            $sql2="select * from staff";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if($project['manager_id']==$row['ID'])
                                                    {
                                                        echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'</option>';
                                                    }
                                                    else{
                                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                                    }
                                                    
                                                }
                                            }
                                            mysqli_close($conn);
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="required">Project Country</label>
                                <select class="form-control select2" id="country1" style="width: 100%;" >
                                    <?php
                                            include '../Inc/DBcon.php';
                                            $sql2="select * from country";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if($project['country_id']==$row['ID'])
                                                    {
                                                        echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'</option>';
                                                    }
                                                    else{
                                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                                    }
                                                    
                                                }
                                            }
                                            mysqli_close($conn);
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="required"> % Profit</label>
                                <input type="number" class="form-control" id="profit1" placeholder="Enter %Profit" value="<?= $project['profit'];?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="required"> AVG Rate</label>
                                <input type="number" class="form-control" id="rate1" min="0" placeholder="Enter AVG Rate" value="<?= $project['avg_rate'];?>">
                                <input type="hidden" class="form-control" id="id"  value="<?= $project['ID'];?>">
                            </div>
                        </div>
                        <div class="col-md-4 d-none">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="required">Project Stage</label>
                                <select class="form-control select2" id="stage1" style="width: 100%;" >
                                    <?php
                                           include '../Inc/DBcon.php';
                                            $sql2="select * from project_phase";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if($project['stage']==$row['ID'])
                                                    {
                                                        echo '<option value="'.$row['ID'].'" selected>'.$row['short_name'].'</option>';
                                                    }
                                                    else{
                                                        echo '<option value="'.$row['ID'].'">'.$row['short_name'].'</option>';
                                                    }
                                                }
                                            }
                                            mysqli_close($conn);
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="required">Project Status</label>
                                <select class="form-control select2" id="status1" style="width: 100%;" >
                                    <?php
                                            include '../Inc/DBcon.php';
                                            $sql2="select * from project_status";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if($project['status']==$row['ID'])
                                                    {
                                                        echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'</option>';
                                                    }
                                                    else{
                                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                                    }
                                                    
                                                }
                                            }
                                            mysqli_close($conn);
                                        ?> 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="required">Office</label>
                                <select class="form-control select2" id="office1" style="width: 100%;" >
                                    <?php
                                           include '../Inc/DBcon.php';
                                            $sql2="select * from office";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if($project['office_id']==$row['ID'])
                                                    {
                                                        echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'</option>';
                                                    }
                                                    else{
                                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                                    }
                                                     
                                                }
                                            }
                                            mysqli_close($conn);
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Deadline</label>
                            <select class="form-control select2" id="deadline2" style="width: 100%;" >
                            <option value="">Select Deadline</option>
                                <?php
                                        $weeks=getWeeks(date('Y'));
                                        foreach($weeks as $week)
                                        {   if($project['deadline']==$week)
                                            {
                                                echo '<option value="'.$week.'" selected>'.$week.'</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="'.$week.'" >'.$week.'</option>';
                                            }
                                         
                                        }
                                        
                                    ?>
                            </select>
                        </div>
                    </div>
                    </div>
                    <label for="exampleInputEmail1 " class="required">Project Stage  (Multi-Select)</label>
                <div class="row">
                
                            <?php
                                include '../Inc/DBcon.php';
                                $sql2="select * from project_phase;";
                                $result=mysqli_query($conn,$sql2);
                                if(mysqli_num_rows($result) > 0 )
                                {   $i=1;
                                    
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        if(CheckStage($project['ID'],$row['ID']))
                                        {
                                            echo '<div class="col-md-2"  >
                                            <div class="form-check">
                                                <input class="form-check-input stcheck1" type="checkbox" value="'.$row['ID'].'" id="customCheckbox'.$row['ID'].'" checked onchange="StageBoxes(this.id)">
                                                <label class="form-check-label">'.$row['short_name'].'</label>
                                            </div>
                                        </div> ';
                                        }
                                        else
                                        {
                                            echo '<div class="col-md-2"  >
                                            <div class="form-check">
                                                <input class="form-check-input stcheck1" type="checkbox" value="'.$row['ID'].'" id="customCheckbox'.$row['ID'].'" onchange="StageBoxes(this.id)">
                                                <label class="form-check-label">'.$row['short_name'].'</label>
                                            </div>
                                        </div> ';
                                        }
                                       
                                        $i++;
                                    }
                                }
                                mysqli_close($conn);
                            ?>
                           
                    </div>
                    <button type="button" class="btn btn-primary float-right" onclick="UpdateProject()">Update Project</button>
                </div>
                <div class="tab-pane fade p-0" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                    <div class="row">
                        <?php
                            include '../Inc/DBcon.php';
                            $sql3='SELECT office.hour_rate as hr, count(office.code) as staff from staff INNER JOIN office on office.ID=staff.office WHERE staff.ID in( select staff_id from project_resource where pid="'.$_GET['id'].'") GROUP by office.code;';
                            $result3=mysqli_query($conn,$sql3);
                            if(mysqli_num_rows($result3) > 0 )
                            {
                                $staff=0;
                                $t=0;
                                $acr=0;
                                while($row3 = mysqli_fetch_array($result3))
                                {
                                    $staff=$staff+$row3['staff'];
                                    $t=$t+$row3['staff']*$row3['hr'];
                                }
                                $acr=$t/$staff;
                            }
                            else{
                                $acr=0;
                            }

                            $sql2="select * from project_all_phase where pid='".$_GET['id']."'";
                            $result=mysqli_query($conn,$sql2);
                            if(mysqli_num_rows($result) > 0 )
                            {
                                
                                while($row = mysqli_fetch_array($result))
                                {
                                    
                                    $phase = getPhase($project["ID"],$row['stage_id']);
                                    $budget='';
                                    $hours='';
                                    $bmonth='';
                                    $bstatus='';
                                    $idate='';
                                    $age='0';
                                    $stage=getStage($row['stage_id']);
                                    if($phase!=0)
                                    {
                                        $budget=$phase['budget'];
                                        $hours=$phase['hours'];
                                        $bmonth=$phase['billing_month'];
                                        $bstatus=$phase['status'];
                                       
                                        $bstatus.= $phase['status']=="Not Billed"?'<option value="Not Billed" selected>Not Billed</option>':'<option value="Not Billed" >Not Billed</option>';
                                        $bstatus.= $phase['status']=="Billed"?'<option value="Billed" selected>Billed</option>':'<option value="Billed" >Billed</option>';
                                        $bstatus.= $phase['status']=="Paid"?'<option value="Paid" selected>Paid</option>':'<option value="Paid" >Paid</option>';
                                        if($phase['status']=="")
                                        {
                                            $bstatus='<option value="Not Billed" >Not Billed</option><option value="Billed" >Billed</option><option value="Paid" >Paid</option>';

                                        }
                                        $idate=$phase['invoice_issued'];
                                        $now = time(); // or your date as well
                                        $your_date = strtotime($phase['invoice_issued']);
                                        $datediff =   $now-$your_date;
                                        if($phase['invoice_issued']!=NULL && $phase['invoice_issued']<date('Y-m-D') && $phase['status'] =="Billed")    
                                        {
                                            if(round($datediff / (60 * 60 * 24))<0)
                                            {
                                                $age=0;
                                            }
                                            else{
                                                $age= round($datediff / (60 * 60 * 24));
                                            }
                                            
                                        }
                                    }
                                    else{
                                        $bstatus='<option value="Not Billed" >Not Billed</option><option value="Billed" >Billed</option><option value="Paid" >Paid</option>';

                                    }
                                    $office=getOffice($project['office_id']);
                                    echo '<div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header " style="background-color:'.$stage['color'].'">
                                            <h3 class="card-title font-weight-bold " id="'.$stage['ID'].'title">
                                            <div  >'.$stage['short_name'].' </div>   </h3>
                                            <div style="float:right" class="font-weight-bold">ACR : '.number_format($acr,2).'</div>
                                        </div>
                                        <div class="card-body p-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="mt-2 mb-1">Fee</label>
                                                <input type="number" id="'.$stage['ID'].'budget" class="form-control form-control-sm" value="'.$budget.'" placeholder="0.00" onkeyup="calcHours('.$stage['ID'].')"> 
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mt-2 mb-1">Hours</label>
                                                <input type="number" id="'.$stage['ID'].'hours" class="form-control form-control-sm" value="'.$hours.'" placeholder="0" readonly> 
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mt-2 mb-1">Billing Month</label>
                                                <input type="month" class="form-control form-control-sm" id="'.$stage['ID'].'billing-month" value="'.$bmonth.'">
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mt-2 mb-1">Status</label>
                                                <select class="form-control form-control-sm" id="'.$stage['ID'].'invoice-status">';
                                               
                                                 
                                               echo $bstatus.' </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mt-2 mb-1">Invoice Issued</label>
                                                <input type="date" class="form-control form-control-sm" id="'.$stage['ID'].'invoice-issued" value="'.$idate.'" onchange="DaysCal(this.value,'.$stage['ID'].')">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mt-2 mb-1">Invoice Age</label>
                                                <input type="number" id="'.$stage['ID'].'invoice-age" class="form-control form-control-sm" value="'.$age.'"  placeholder="0" readonly> 
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <button class="btn btn-secondary btn-block btn-sm" onclick="UpdateStage('.$stage['ID'].','.$project['ID'].')">Update</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>';
                                    
                                }
                            }
                            mysqli_close($conn);
                        ?>
                    
                         
                        
                    </div>
                </div>
                <div class="tab-pane fade p-0" id="custom-tabs-three-Others" role="tabpanel" aria-labelledby="custom-tabs-three-Others-tab">
                    <form id="projectdetails" action="javascript:void(0)" >
                        <input type="hidden" name="pid" value="<?= $_GET['id'];?>">
                    <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Contract Amount</label>
                                    <input type="number" class="form-control" name="c_amount" placeholder="Enter Amount" value="<?= $camount;?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Project Currency</label>
                                    <input type="text" class="form-control" name="p_currency" placeholder="Enter Currency" value="<?= $pcurrency;?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Budget per PPR</label>
                                    <input type="number" class="form-control" name="b_ppr" placeholder="Enter Budget" value="<?= $bppr;?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Projected Hours</label>
                                    <input type="number" class="form-control" name="p_hours" placeholder="Enter Hours" value="<?= $phours;?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Costs to Date</label>
                                    <input type="number" class="form-control" name="c_date" placeholder="Enter Cost" value="<?= $cdate;?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Billing %</label>
                                    <input type="number" class="form-control" name="b_perst" placeholder="Enter Billing %" value="<?= $bperst;?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Remaining Hours</label>
                                    <input type="number" class="form-control" name="r_hours" placeholder="Enter Remaining Hours" value="<?= $rhours;?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Complete %</label>
                                    <input type="number" class="form-control" name="c_perst" placeholder="Enter Complete %" value="<?= $cperst;?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Overhead Cost</label>
                                    <input type="number" class="form-control" name="o_cost" placeholder="Enter Overhead Cost" value="<?= $ocost;?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Total Cost Est.</label>
                                    <input type="number" class="form-control" name="t_cost" placeholder="Enter Total Cost Est." value="<?= $tcest;?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Profit Recognized</label>
                                    <input type="number" class="form-control" name="p_rec" placeholder="Enter Profit Recognized" value="<?= $prec;?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Margin</label>
                                    <input type="number" class="form-control" name="margin" placeholder="Enter Margin" value="<?= $margin;?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Margin % so Far</label>
                                    <input type="number" class="form-control" name="marginsofar" placeholder="Enter Margin %" value="<?= $mperst;?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">% of Completion</label>
                                    <input type="number" class="form-control" name="perstc" placeholder="Enter % Completion" value="<?= $perstc;?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Max Allow if Below 90% Complete</label>
                                    <input type="number" class="form-control" name="maxallow" placeholder="Enter Max Allow if Below 90% Complete" value="<?= $mab90perst;?>" required>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="required">Variance (est margin vs.margin cap)</label>
                                    <input type="number" class="form-control" name="variance" placeholder="Enter Variance" value="<?= $variance;?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary float-right" onclick="AddProjectDetails()">Update</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
            </div>
 
        </div>
    </div>
  
</div>

