<?php
//this file is used to delete the annotations from the database by the admin
//annotation id is got from deleteadmin function in admin.js
//delete option is provided in edit_log page
require 'dbconnect.inc.php';
include 'mailtowatchers.php';
$hiddenid=$_POST['hiddenid'];

$result=mysqli_query($link,"select * from content where id='$hiddenid'");
$row=mysqli_fetch_array($result);
$annotation=$row['annotation'];
$text=$row['text'];


$result1=mysqli_query($link,"select distinct emailid from content,watchers where text='$text' and id=fid");
	//sending email to all the watchers of that particular annotation
	while($row1=mysqli_fetch_array($result1))
	{
		$emailid=$row1['emailid'];
		sendemaildelete($emailid,$text,$annotation);
	}
	//deleting the annotation based on the id
	mysqli_query($link,"delete  from watchers where fid='$hiddenid' ");
	mysqli_query($link,"delete  from votes where id='$hiddenid' ");
	mysqli_query($link,"delete  from ansvotes where id='$hiddenid' ");
	mysqli_query($link,"delete  from edit_logans where annoid='$hiddenid' ");
	mysqli_query($link,"delete  from qanswer where annoid='$hiddenid' ");
	mysqli_query($link,"delete  from edit_log where annoid='$hiddenid' ");
	mysqli_query($link,"delete  from content where id='$hiddenid' ");

?>
