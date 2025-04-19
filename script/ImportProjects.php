<?php
session_start();
require "vendor/autoload.php";
use Shuchkin\SimpleXLSX;

include 'functions.php';

// if(isset($_FILES['csv']))
// {
//     $errors= array();
//     $file_name = $_FILES['csv']['name'];
//     $file_size =$_FILES['csv']['size'];
//     $file_tmp =$_FILES['csv']['tmp_name'];
//     $file_type=$_FILES['csv']['type'];
//     $file_ext=strtolower(end(explode('.',$_FILES['csv']['name'])));
    
  
    
//     if(empty($errors)==true)
//     {
    
//        move_uploaded_file($file_tmp,"Files/".$file_name);
//        $img="Files/".$file_name;
       
//     }
     
// }
if ( $xlsx = SimpleXLSX::parse('Files/FILE FOR IMPORT.xlsx') ) {
   
    include '../Inc/DBcon.php';
    
    $col=3;
    $empty=1;
    while($empty==1)
    {    $i=0;
        $array=array();
        foreach( $xlsx->rows() as $r ) {
        
            if($i>=8)
            {
                if( $i==8 && $r[$col]=="")
                {$empty=0; break;}
                else
                {
                    if($i==8) {array_push($array,$r[$col]); echo $i."===> ".$r[$col]."<br>";}
                    if($i==10) {array_push($array,$r[$col]); echo $i."===> ".$r[$col]."<br>";}
                    if($i==14) {array_push($array,floor($r[$col])); echo $i."===> ".$r[$col]."<br>";}
                    if($i==15) {array_push($array, $r[$col]); echo $i."===> ".$r[$col]."<br>";}
                    if($i==16) {array_push($array,floor($r[$col])); echo $i."===> ".$r[$col]."<br>";}
                    if($i==17) {array_push($array,floor($r[$col])); echo $i."===> ".$r[$col]."<br>";}
                    if($i==20) {array_push($array,ceil($r[$col])); echo $i."===> ".$r[$col]."<br>";}
                    if($i==27) {array_push($array,ceil($r[$col]*100)); echo $i."===> ".$r[$col]."<br>";}
                    if($i==28) {array_push($array,ceil($r[$col])); echo $i."===> ".$r[$col]."<br>";}
                    if($i==29) {array_push($array,ceil($r[$col]*100)); echo $i."===> ".$r[$col]."<br>";}
                    if($i==30) {array_push($array,floor($r[$col])); echo $i."===> ".$r[$col]."<br>";}
                    if($i==31) {array_push($array,ceil($r[$col])); echo $i."===> ".$r[$col]."<br>";}
                    if($i==32) {array_push($array,ceil($r[$col])); echo $i."===> ".$r[$col]."<br>";}
                    if($i==33) {array_push($array,(int)($r[$col])); echo $i."===> ".$r[$col]."<br>";}
                    if($i==43) {array_push($array,(int)($r[$col])); echo $i."===> ".$r[$col]."<br>";}
                    if($i==44 ) { if($r[$col]!='#DIV/0!') {array_push($array,(int)($r[$col]*100));} else{array_push($array,0);} echo $i."===> ".$r[$col]."<br>";}  
                    if($i==45) {array_push($array,(int)($r[$col]*100)); echo $i."===> ".$r[$col]."<br>";}
                    if($i==46) {array_push($array,(int)($r[$col])); echo $i."===> ".$r[$col]."<br>";}
                    if($i==47) {array_push($array,(int)($r[$col])); echo $i."===> ".$r[$col]."<br>";}
                }   
            }
            $i++;
        }
       // echo "<br><br>#######################################################################<br><br>";
        echo '<pre>';
        var_dump($array);
        echo '</pre>';
        if($empty==1)
        {
            if('0'!=Existproject($array[1]))
         {
            $id=Existproject($array[1]);   
         }
         else{
             $sql1="INSERT INTO projects( code, name, manager_id, country_id, profit, avg_rate, minus_hours, stage, status,
              office_id, deadline)VALUES 
              ('".$array[1]."','".$array[0]."','15','1','','".$array[11]."','','','1','1','')";
            mysqli_query($conn,$sql1); 
            $id=mysqli_insert_id($conn);
        }
            
            $sql2="select * from project_details where pid='".$id."';";
            $result2=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result2) > 0 )
            {
                $row2 = mysqli_fetch_array($result2); 
                $sql3="update project_details set  contract_amount='".$array[2]."', currency='".$array[3]."', budget_per_ppr='".$array[4]."',
                 projected_hours='".$array[5]."', cost_to_date='".$array[6]."', billing_perst='".$array[7]."',
              remaining_hours='".$array[8]."', complete_perst='".$array[9]."', overhead_cost='".$array[10]."', total_cost_est='".$array[12]."',
               proft_recg='".$array[13]."', margin='".$array[14]."', margin_perst='".$array[15]."', completion_of_perst='".$array[16]."',
               max_allow_complete_below_90='".$array[17]."', variance='".$array[18]."' where ID='".$row2['ID']."' ;";
               mysqli_query($conn,$sql3);
            }
            else
            {
                $sql2="INSERT INTO project_details(  pid, contract_amount, currency, budget_per_ppr, projected_hours, cost_to_date, billing_perst,
              remaining_hours, complete_perst, overhead_cost, total_cost_est, proft_recg, margin, margin_perst, completion_of_perst,
               max_allow_complete_below_90, variance) VALUES 
               ( '".$id."','".$array[2]."','".$array[3]."','".$array[4]."','".$array[5]."','".$array[6]."','".$array[7]."','".$array[8]."',
               '".$array[9]."','".$array[10]."','".$array[12]."','".$array[13]."','".$array[14]."','".$array[15]."','".$array[16]."',
               '".$array[17]."','".$array[18]."')";
             mysqli_query($conn,$sql2);
            }
        }
        $col++;
    }
	
	 
} else {
    echo '0';
}
mysqli_close($conn);
?>