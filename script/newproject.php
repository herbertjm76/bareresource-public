<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
 $stage=explode(" ", $data->Stage);

$sql="insert into projects ( code, name, manager_id, country_id, profit, avg_rate,minus_hours, stage, status, office_id,deadline) VALUES
 ('".$data->Code."','".mysqli_real_escape_string($conn,$data->Name)."','".$data->Pm."','".$data->Country."','".$data->Profit."','".$data->Rate."','','".$stage[0]."','".$data->Status."','".$data->Office."','".$data->Deadline."'); ";
    if (mysqli_query($conn,$sql))
    {   $id=mysqli_insert_id($conn);
        foreach($stage as $value)
        {
            if($value!="")
            { 
               $sql1="INSERT INTO project_all_phase(pid, stage_id) VALUES ('".$id."','".$value."');";
               mysqli_query($conn,$sql1);
            }
        }
        $action=$_SESSION['name']." created a new project ( ".$data->Code." -".$data->Name."  ) .";
        create_log($_SESSION['uid'],$action);
    	echo "1";
	}
    else
    {
        echo "0";
        
    }
    
	mysqli_close($conn);
?>
