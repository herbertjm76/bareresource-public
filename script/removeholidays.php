<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';

$holiday=getHolidays($_GET['id']);
$office=getOffice($holiday['office_id']);

$date=explode(" - ", $holiday['date_des']);
$date2=explode("-", $date[0]);
$monday=strtotime("monday this week", mktime(0,0,0, date('m',strtotime($date2[1])), $date2[0], $date2[2]));
$week= date("d-M-Y",$monday);
$officeholiday=getOfficeHoliday($holiday['office_id'],$week);

$sql="delete FROM holiday where ID='".$_GET['id']."';";
if(mysqli_query($conn,$sql))
{
    $sql0="select * from office_holidays where office_id='".$holiday['office_id']."' AND week='".$week."' AND hours > ".$holiday['hours'].";";
      $result=mysqli_query($conn,$sql0);
      if(mysqli_num_rows($result) > 0 )
      {
        $row000 = mysqli_fetch_array($result);
        $hr=$officeholiday['hours']-$holiday['hours'];
        $des=str_ireplace(" & ".$holiday['description'],"",$officeholiday['description']);
          $sql="update office_holidays set hours='".$hr."', description='".mysqli_real_escape_string($conn,$des)."'  where ID='".$row000['ID']."' ; ";
          mysqli_query($conn,$sql);
      }
      else{
        $sql="delete FROM office_holidays where office_id='".$holiday['office_id']."' AND week='".$week."';";
        mysqli_query($conn,$sql);
      }
    

    $action=$_SESSION['name']." remove ".$holiday['description']." holday (".$holiday['date_des'].") from office  ".$office['code'].".";
    create_log($_SESSION['uid'],$action);
    echo '1';
}
else
{
    echo '0';
}
mysqli_close($conn);
?>