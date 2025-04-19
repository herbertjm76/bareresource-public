<?php
session_start();
 
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
 
 
$pro=getProjectDetails($_POST['pid']);
if($pro!='')
{
    $sql1="update project_details SET pid='".$_POST['pid']."', contract_amount='".$_POST['c_amount']."', currency='".$_POST['p_currency']."',
     budget_per_ppr='".$_POST['b_ppr']."', projected_hours='".$_POST['p_hours']."', cost_to_date='".$_POST['c_date']."', billing_perst='".$_POST['b_perst']."',
      remaining_hours='".$_POST['r_hours']."', complete_perst='".$_POST['c_perst']."', overhead_cost='".$_POST['o_cost']."', total_cost_est='".$_POST['t_cost']."',
       proft_recg='".$_POST['p_rec']."', margin='".$_POST['margin']."', margin_perst='".$_POST['marginsofar']."', completion_of_perst='".$_POST['perstc']."',
        max_allow_complete_below_90='".$_POST['maxallow']."', variance='".$_POST['variance']."' where ID='".$pro['ID']."' ;";
    mysqli_query($conn,$sql1);
     
}
else{
    $sql="INSERT INTO project_details ( pid, contract_amount, currency, budget_per_ppr, projected_hours, cost_to_date, billing_perst, remaining_hours, complete_perst, overhead_cost, total_cost_est, proft_recg, margin, margin_perst, completion_of_perst, max_allow_complete_below_90, variance)
 VALUES ('".$_POST['pid']."','".$_POST['c_amount']."','".$_POST['p_currency']."','".$_POST['b_ppr']."','".$_POST['p_hours']."','".$_POST['c_date']."',
 '".$_POST['b_perst']."','".$_POST['r_hours']."','".$_POST['c_perst']."','".$_POST['o_cost']."','".$_POST['t_cost']."','".$_POST['p_rec']."',
 '".$_POST['margin']."','".$_POST['marginsofar']."','".$_POST['perstc']."','".$_POST['maxallow']."','".$_POST['variance']."')";
 mysqli_query($conn,$sql);

}

$action="Update Project Details.";
create_log($_SESSION['uid'],$action);
     
	mysqli_close($conn);
?>
