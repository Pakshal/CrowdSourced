<?php
/*
editing the annotation and sending mail to the watcers 
notifying that the annotation is changed.
displaying the modified annotation on the corresponding
annotation pannel*/

session_start();
require 'dbconnect.inc.php';
include 'mailtowatchers.php';
$hiddenid=$_POST['hiddenid'];
$modified_annotation=$_POST['edit']; //edited annotation



echo $modified_annotation;

//fetch the annotation before updating
$result=mysqli_query($link,"select * from content where id='$hiddenid'");
$row=mysqli_fetch_array($result);
$oldannotation=$row['annotation'];
$art=$_SESSION['art'];
$text=$row['text'];
$user=$_SESSION['emaild'];
$author=$row['user'];


if($oldannotation != $modified_annotation)
{
	$result1=mysqli_query($link,"select distinct emailid from content,watchers where text='$text' and id=fid ");
	while($row1=@mysqli_fetch_array($result1))
	{
		$emailid=$row1['emailid'];
		sendemail($emailid,$oldannotation,$modified_annotation,$text);
	}
	$modified_annotation = mysqli_real_escape_string($link,$modified_annotation);
	//updating the annotation in the content table based on the id
	mysqli_query($link,"update content set annotation='$modified_annotation' where id='$hiddenid' ") or die("could not update");
	mysqli_close($link);
	require 'dbconnect.inc.php';
	
	$check=mysqli_query($link,"select * from edit_log where annoid='$hiddenid' order by datetime desc");
	$latest=mysqli_fetch_array($check);
	//getting the latest updated row in edit_log and updating its username to loggedin username (who has edited the annotation) 
	$current=$latest['datetime'];
	$current_anno=$latest['anno'];
	mysqli_query($link,"update edit_log set user='$user' where annoid='$hiddenid' and anno='$modified_annotation' and datetime='$current' ") or die(mysqli_error($link));
	
	//increasing points for the edit made

	$res=mysqli_query($link,"select * from leaderboard where emailid='$user' and article='$art' ");
    $num_rows=mysqli_num_rows($res);
    if($num_rows > 0)
    {	
    	if($user != $author)
      		mysqli_query($link,"update leaderboard set points=points+0.5 where emailid='$user' and article='$art' ");
    }
    else
    {
      	mysqli_query($link,"insert into leaderboard values('$user','$art',0.5) ");
    }
	
}
else
	echo '<script>alert("You should make change to edit "); </script>';//alert if user has not edited any content

mysqli_close($link);



?>
