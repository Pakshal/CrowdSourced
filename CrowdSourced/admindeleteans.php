<?php
//this file is used to delete the annotations from the database by the admin
//annotation id is got from deleteadmin function in admin.js
//delete option is provided in edit_log page
require 'dbconnect.inc.php';
include 'mailtowatchers.php';
$hiddenid=$_POST['hiddenid'];

$result=mysqli_query($link,"select * from qanswer where ansid='$hiddenid'");

$row=mysqli_fetch_array($result);

//getting id to fetch the question from content table
$id=$row['annoid'];
$ans=$row['answer'];
$result=mysqli_query($link,"select * from content where id='$id'");

$row=mysqli_fetch_array($result);
$question=$row['annotation'];
$text=$row['text'];


$result1=mysqli_query($link,"select distinct emailid from content,watchers where text='$text' and id=fid");
	//sending email to all the watchers of that particular annotation
	while($row1=mysqli_fetch_array($result1))
	{
		$emailid=$row1['emailid'];
		sendemaildeleteans($emailid,$text,$question,$ans);
	}
	//deleting the answer based on the ansid

	mysqli_query($link,"delete  from ansvotes where ansid='$hiddenid' ");
	mysqli_query($link,"delete  from edit_logans where ansid='$hiddenid' ");
	mysqli_query($link,"delete  from qanswer where ansid='$hiddenid' ");

?>
