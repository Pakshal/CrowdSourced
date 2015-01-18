<?php
/* checking whether the emailid already exists in the database
and prinitng the appropriate message
also adding email id in the plus_login table to indicate 
the user is active now.
If emailid already exists in the plus_login table
only the time is updated and status is made on*/ 

		

	
		require 'dbconnect.inc.php';

		
		$username=$_POST['postname'];
		$pswrd=$_POST['pass'];
		$result=mysqli_query($link,"select * from credential where emailid='$username' and password='$pswrd' ") or die("could not");

		$count = mysqli_num_rows($result);
		$row=mysqli_fetch_array($result);
		$status=$row['status'];

		mysqli_close($link);
		$val=2;
		

		if($count==0)
		{
			
				echo $count;
			
		}
		else if($status==1)
		{	
			
			session_start();
			$_SESSION['emaild']=$username;
			echo "well";
			//for keeping track of number of active users
			$session_id=session_id();
			$ip=@$_SERVER['REMOTE_ADDR'];
			$time=date("Y-m-d H:i:s");
			require 'dbconnect.inc.php';
			//checking whether record for this logged in user already exists in plus_login or not.
			$result=mysqli_query($link,"select * from plus_login where emailid='$username'");
			if(mysqli_num_rows($result)=="0")
				mysqli_query($link,"insert into plus_login values('$session_id','$username','$ip','$time','on')") or die("could not insert value");
			else
				mysqli_query($link,"update plus_login set status='on',tm='$time' where emailid='$username'") or die("could not update");
			
			mysqli_close($link);
				
		}
		else{
			echo $val;
		}
		
	



	?>