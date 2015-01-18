<?php
/* displays the name of all the active users 
active users can only seen by the admin
*/
if (!isset($_SESSION)) { 
  session_start(); 
} 


if(isset($_SESSION['emaild'])){
	$emailid=$_SESSION['emaild'];
	$time=date("Y-m-d H:i:s");
	require 'dbconnect.inc.php';
	//echo '<script>alert("time updated");</script>';

	mysqli_query($link,"update plus_login set status='on',tm='$time' where emailid='$emailid'") or die("could not update");
	
	mysqli_close($link);
}

//find out who is online from last ten minutes
//put the satus off for those who are inactive
$gap=10;
require 'dbconnect.inc.php';

$time=date ("Y-m-d H:i:s", mktime (date("H"),date("i")-$gap,date("s"),date("m"),date("d"),date("Y")));

mysqli_query($link,"update plus_login set status='off' where tm<'$time'") or die("could not update");

mysqli_close($link);
?>