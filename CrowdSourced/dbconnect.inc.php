<?php

//this connects to the server database
//please change the database password accordingly

$conn_error_msg="Error in connecting to Database!";

$mysql_server='localhost';
$mysql_user='root';
$mysql_pass='svn';
$mysql_db='newintern';

$link=mysqli_connect($mysql_server,$mysql_user,$mysql_pass,$mysql_db);//connecting to the database

if(!$link){
	die($conn_error_msg);
}

?>
