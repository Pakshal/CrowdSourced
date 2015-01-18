<?php

require 'dbconnect.inc.php';
include 'mailtowatchers.php';
$hiddenid=$_POST['hiddenid'];
$modified_annotation=$_POST['edit']; //edited annotation


//echo $hiddenid;
echo $modified_annotation;

//fetch the annotation before updating
$result=mysqli_query($link,"select * from content where id='$hiddenid'");
$row=mysqli_fetch_array($result);
$oldannotation=$row['annotation'];
$text=$row['text'];

//fetching the email id of all the watchers 


$result1=mysqli_query($link,"select distinct emailid from content,watchers where text='$text' and id=fid ");
while($row1=mysqli_fetch_array($result1))
{
	$emailid=$row1['emailid'];
	sendemail($emailid,$oldannotation,$modified_annotation,$text);
}

mysqli_query($link,"update content set annotation='$modified_annotation' where id='$hiddenid' ") or die("could not update");
//echo "updated";



mysqli_close($link);
//header('Location:main.php');
//die();


?>
