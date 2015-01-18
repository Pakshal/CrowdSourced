<html>
<?php
//user account is activated and redirected to the index page 
session_start();
$key=$_GET['id'];
//echo $key;
require 'dbconnect.inc.php';
$result=mysqli_query($link,"select * from credential where Ekey='$key'");
$row = mysqli_fetch_array($result);
$count=mysqli_num_rows($result);
if($count==1){
	$email=$row['emailid'];
	//$status=$row['status'];
	
	$_SESSION['emaild']=$email;
	$res=mysqli_query($link,"update credential set status=1 where Ekey='$key'");
	//echo '<a href="main.php" >Create annotations</a>';
	
	echo '<meta http-equiv="refresh" content="4;url=index.php ">';
   	echo '<center><b>Account created successfully<br>redirecting to main page in 4 seconds....</b>';
}



?>
</html>