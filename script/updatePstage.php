<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$project=getProject($data->Pid);
$sql="update projects  set 
  
  stage='".$data->Stage."' where ID='".$data->Pid."' ;  ";
    if (mysqli_query($conn,$sql))
    {
        
        $action=$_SESSION['name']." update project Stage ( ".$project['code']."-".$project['name']." ) .";
        create_log($_SESSION['uid'],$action);
    	echo "1";
	}
    else
    {
        echo "0";
        
    }
    
	mysqli_close($conn);
?>
