<?php
//similar to incrmvote.php in this context same idea is implemented for the 
//annotations of the type [A]
		session_start(); //starting the session to get the emailid

		require 'dbconnect.inc.php';
		$pointvotes=0;
		$id=$_POST['annotationid']; //getting annotation id
		$user=$_SESSION['emaild'];  //getting email id from session
		$art=$_SESSION['art'];
		$aid=$_POST['ansid'];
		$result=mysqli_query($link,"select *from ansvotes where id='$id' and user='$user' and ansid='$aid'") or die($conn_error_msg);
		$count=mysqli_num_rows($result);
		if($count==0){
			mysqli_query($link,"insert into ansvotes(id,user,ansid) values('$id','$user','$aid')");
		}



		if($_POST['value']=='up')
		{
			$res=mysqli_query($link,"update ansvotes set votetype=5 where id='$id' and (votetype=0) and user='$user' and ansid='$aid'");
			$effected1=mysqli_affected_rows($link);
			if(! $effected1)
			{

				$res=mysqli_query($link,"update ansvotes set votetype=TRUE where id='$id' and (votetype=5) and user='$user' and ansid='$aid'");
				$effected=mysqli_affected_rows($link);
				if($effected)
				{		
					mysqli_query($link,"update qanswer set votes=votes+1 where annoid='$id' and ansid='$aid'");
					
					// checking whether the person who had asked the question has upvoted ans or not.
					$reslt=mysqli_query($link,"select user from content where id='$id' ");
					$rw=mysqli_fetch_array($reslt);
					$usr=$rw['user'];
					

					if($user==$usr)
					{
						$pointvotes=3;
						
					}
					else
					{
						$pointvotes=1;
					}


				}
			}
			if($effected1)
			{	
				mysqli_query($link,"update qanswer set votes=votes+1 where annoid='$id' and ansid='$aid'");
				// checking whether the person who had asked the question has upvoted ans or not.
					$reslt=mysqli_query($link,"select user from content where id='$id' ");
					$rw=mysqli_fetch_array($reslt);
					$usr=$rw['user'];
					

					if($user==$usr)
					{
						$pointvotes=3;
						
					}
					else
					{
						$pointvotes=1;
					}
			}
			
		}
		elseif($_POST['value']=='down')
		{
			$res=mysqli_query($link,"update ansvotes set votetype=5 where id='$id' and (votetype=1) and user='$user' and ansid='$aid'");
			$effected1=mysqli_affected_rows($link);
			if(! $effected1)
			{	
				$res=mysqli_query($link,"update ansvotes set votetype=FALSE where id='$id' and (votetype=5) and user='$user' and ansid='$aid'");
				$effected=mysqli_affected_rows($link);
				if($effected)
				{	
					mysqli_query($link,"update qanswer set votes=votes-1 where annoid='$id' and ansid='$aid'");
					// checking whether the person who had asked the question has upvoted ans or not.
					$reslt=mysqli_query($link,"select user from content where id='$id' ");
					$rw=mysqli_fetch_array($reslt);
					$usr=$rw['user'];
					

					if($user==$usr)
					{
						$pointvotes=-3;
						
					}
					else
					{
						$pointvotes=-1;
					}
				}
			}	
			if($effected1)
			{	
				mysqli_query($link,"update qanswer set votes=votes-1 where annoid='$id' and ansid='$aid'");
				// checking whether the person who had asked the question has upvoted ans or not.
					$reslt=mysqli_query($link,"select user from content where id='$id' ");
					$rw=mysqli_fetch_array($reslt);
					$usr=$rw['user'];
					

					if($user==$usr)
					{
						$pointvotes=-3;
						
					}
					else
					{
						$pointvotes=-1;
					}
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
		$result=mysqli_query($link,"select *from ansvotes where id='$id' and user='$user'and ansid='$aid'") or die($conn_error_msg);
		$voterow=mysqli_fetch_array($result);
		if($voterow['votetype']==5)
		{	
			$vresult=mysqli_query($link,"select *from qanswer where annoid='$id' and ansid='$aid'");
			$votes=mysqli_fetch_array($vresult);
			echo $votes['votes'].'s';
			
		}
		else
		{
			$vresult=mysqli_query($link,"select *from qanswer where annoid='$id'and ansid='$aid' ");
			$votes=mysqli_fetch_array($vresult);
			echo $votes['votes'];
			
		}

		$result=mysqli_query($link,"select user from qanswer where annoid='$id'and ansid='$aid' ");
		$row=mysqli_fetch_array($result);
		$user=$row['user'];

	
		

      	
		//adding points for incrementing the vote of particular article 
      	mysqli_query($link,"update leaderboard set points=points+'$pointvotes' where emailid='$user' and article='$art' ");
      

		mysqli_close($link);
		
		require 'dbconnect.inc.php';
	//getting the latest annotation based on the id and datettime
		$check=mysqli_query($link,"select * from edit_logans where annoid='$id'and ansid='$aid' order by datetime desc");
	//fetching the latest result
	$latest=mysqli_fetch_array($check);
	//getting the datetime and annotation of the latest row in the edit_log
	$current=$latest['datetime'];
	$current_anno=$latest['ans'];
	//updating the user name to the latest row fetched based on datetime and id
	mysqli_query($link,"update edit_logans set user='$user' where annoid='$id' and ansid='$aid'and datetime='$current' ") or die(mysqli_error($link));

?>
