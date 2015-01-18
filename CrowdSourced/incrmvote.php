<?php
/* increments or decrements the vote based on the 
users choice(upvoted or downvoted the annotation)
updates the vote value in the content table
also the user can upvote or downvote the annotation only once */
 		
		session_start(); //starting the session to get the emailid

		require 'dbconnect.inc.php';
		$pointvote=0;
		$art=$_SESSION['art'];
		$id=$_POST['annotationid']; //getting annotation id
		$user=$_SESSION['emaild'];  //getting email id from session
		$result=mysqli_query($link,"select *from votes where id='$id' and user='$user'") or die($conn_error_msg);
		$count=mysqli_num_rows($result);
		if($count==0){
			mysqli_query($link,"insert into votes(id,user) values('$id','$user')");
		}



		if($_POST['value']=='up')
		{
			$res=mysqli_query($link,"update votes set votetype=5 where id='$id' and (votetype=0) and user='$user'");
			$effected1=mysqli_affected_rows($link);
			if(! $effected1)
			{

				$res=mysqli_query($link,"update votes set votetype=TRUE where id='$id' and (votetype=5) and user='$user'");
				$effected=mysqli_affected_rows($link);
				if($effected)
				{		
					mysqli_query($link,"update content set votes=votes+1 where id='$id'");
					$pointvote=1;
				}
			}
			if($effected1)
			{	
				mysqli_query($link,"update content set votes=votes+1 where id='$id'");
				$pointvote=1;
			}
			
		}
		elseif($_POST['value']=='down')
		{
			$res=mysqli_query($link,"update votes set votetype=5 where id='$id' and (votetype=1) and user='$user'");
			$effected1=mysqli_affected_rows($link);
			if(! $effected1)
			{	
				$res=mysqli_query($link,"update votes set votetype=FALSE where id='$id' and (votetype=5) and user='$user'");
				$effected=mysqli_affected_rows($link);
				if($effected)
				{	
					mysqli_query($link,"update content set votes=votes-1 where id='$id'");
					$pointvote=-1;
				}
			}	
			if($effected1)
			{	
				mysqli_query($link,"update content set votes=votes-1 where id='$id'");
				$pointvote=-1;
			}
			
		}

		mysqli_close($link);
		
		//do not delete the commented text
		/*require 'dbconnect.inc.php';

		$vresult=mysqli_query($link,"select *from content where id='$id' ");
		$votes=mysqli_fetch_array($vresult);
		echo $votes['votes'];


		mysqli_close($link);

		*/

		require 'dbconnect.inc.php';
		$user=$_SESSION['emaild'];  //getting email id from session
		$result=mysqli_query($link,"select *from votes where id='$id' and user='$user'") or die($conn_error_msg);
		$voterow=mysqli_fetch_array($result);
		if($voterow['votetype']==5)
		{	
			$vresult=mysqli_query($link,"select *from content where id='$id' ");
			$votes=mysqli_fetch_array($vresult);
			echo $votes['votes'].'s';
			
		}
		else
		{
			$vresult=mysqli_query($link,"select *from content where id='$id' ");
			$votes=mysqli_fetch_array($vresult);
			echo $votes['votes'];
			
		}


		$result=mysqli_query($link,"select user from content where id='$id' ");
		$row=mysqli_fetch_array($result);
		$user=$row['user'];
		
		//adding points for incrementing the vote of particular article and user
      	mysqli_query($link,"update leaderboard set points=points+'$pointvote' where emailid='$user' and article='$art' ");		
		mysqli_close($link);

		

		require 'dbconnect.inc.php';
	//getting the latest annotation based on the id and datettime
	$check=mysqli_query($link,"select * from edit_log where annoid='$id' order by datetime desc");
	//fetching the latest result
	$latest=mysqli_fetch_array($check);
	//getting the datetime and annotation of the latest row in the edit_log
	$current=$latest['datetime'];
	$current_anno=$latest['anno'];
	//updating the user name to the latest row fetched based on datetime and id
	mysqli_query($link,"update edit_log set user='$user' where annoid='$id' and datetime='$current' ") or die(mysqli_error($link));



?>
