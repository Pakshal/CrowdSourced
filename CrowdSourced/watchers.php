<?php
require 'dbconnect.inc.php';
//starting the session to get the emailid of the signed in user
session_start();

	$fid=$_POST['watch']; //getting value from watchers.js(annotation id)
	$emailid=$_SESSION['emaild']; //getting user email id from session

	//inserting values to watchers table
	mysqli_query($link,"insert into watchers(fid,emailid) values('$fid','$emailid')"); 

	
    //getting the number of effected rows 
	$effected=mysqli_affected_rows($link);

	//effected value will be zero if the user has already pressed the watch button for the particular text



	$result=mysqli_query($link,"select * from content where id='$fid' ");
	$row=mysqli_fetch_array($result);//getting the watched text value

	//if effected rows is 1 then user has clicked watched button for the particular text first time
	//if its zero he is already watching the text
	if($effected=="1")
	{
		$reslt=mysqli_query($link,"select user from content where id='$fid' ");
		$rw=mysqli_fetch_array($reslt);
		$usr=$rw['user'];

		mysqli_query($link,"update leaderboard set points=points+1 where emailid='$usr' and article='$art' ");

		echo "your are now watching the text:".$row['text'];
	}
	else
	{
		echo "you are already watching ";
	}


mysqli_close($link);
//close the link to database




?>