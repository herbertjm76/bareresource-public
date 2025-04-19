<?php
session_start();
$data = json_decode(file_get_contents("php://input"));

include '../Inc/DBcon.php';
include 'log.php';
include 'functions.php';
$id=$data->ID;
$office=getOffice($data->Office);
$date=explode("-", $data->Date);
$orgDate = $date[0];
$date1 = str_replace('-', '/', $orgDate);
$newDate1 = date("d-M-Y", strtotime($date1));
 $firstday=explode("-", $newDate1) ;

$orgDate = $date[1];
$date1 = str_replace('-', '/', $orgDate);
$newDate2 = date("d-M-Y", strtotime($date1));
 
$date4=date_create($newDate1);
$date5=date_create($newDate2);
$diff=date_diff($date4,$date5);
$hours= ($diff->format("%a")+1)*8;
$monday=strtotime("monday this week", mktime(0,0,0, date('m',strtotime($firstday[1])), $firstday[0], $firstday[2]));
$week= date("d-M-Y",$monday);
 
 $preholiday=getHolidays($id);
 $firstday1=explode(" - ", $preholiday['date_des']);
 $firstday2=explode("-", $firstday1[0]);
 $monday2=strtotime("monday this week", mktime(0,0,0, date('m',strtotime($firstday2[1])), $firstday2[0], $firstday2[2]));
$week2= date("d-M-Y",$monday2);
$officeholiday=getOfficeHoliday($preholiday['office_id'],$week);

            $sql="update holiday set description='".mysqli_real_escape_string($conn,$data->Des)."', date_des='".$newDate1." - ".$newDate2."',
            hours='".$hours."',office_id='".$data->Office."' where ID='".$id."'; ";
            mysqli_query($conn,$sql);
            $sql0="select * from office_holidays where office_id='".$data->Office."' AND week='".$week."';";
            $result=mysqli_query($conn,$sql0);
            if(mysqli_num_rows($result) > 0 )
            {
               $row000 = mysqli_fetch_array($result);
               $hr=$officeholiday['hours']-$preholiday['hours'];
               $des=str_ireplace(" & ".$preholiday['description']," & ".$data->Des,$officeholiday['description']);
               $sql="update office_holidays set description='".mysqli_real_escape_string($conn,$des)."',week='".$week."',hours='".($hours+$hr)."'
               where ID='".$officeholiday['ID']."'; ";
              mysqli_query($conn,$sql);
            }
           
           
 
  
  $action=$_SESSION['name']." Updated a new Holiday of ".$hours." hours in week ".$week." at ".$office['code']." Office.";
   create_log($_SESSION['uid'],$action);
   echo "1";
    


    
	mysqli_close($conn);
?>
