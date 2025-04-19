 <?php
 $actual_link = 'http://'.$_SERVER['HTTP_HOST']; 
 if($actual_link=="http://localhost")
  {
    $servername = "localhost"; 	//Your servername here  
    $username = "root";			//Your username here     
    $password = "";				//Your Password here      
    $dbname= "ch_resource";  // your db name here	   

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn)
    {
      die("Connection failed: " . mysqli_connect_error());
    } 
  }
  else{
    $servername = "localhost"; 	//Your servername here  
$username = "u852092765_asa";			//Your username here     
$password = "L3wp]G#:@Al&";				//Your Password here      
$dbname= "u852092765_res";  // your db name here   

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn)
    {
      die("Connection failed: " . mysqli_connect_error());
    } 
  }


?>