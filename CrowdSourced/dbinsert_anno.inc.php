<?php
/* annotation is added to the content table.
Along with it text,
,start & end position,username,time & date and mainly the
article name will be added to the content table

*/
include 'mailtowatchers.php';
session_start();
$art=$_SESSION['art'];
if(isset($_SESSION['emaild']))
{
	
	$user=$_SESSION['emaild'];
}
else
{
	
	$userid="Anonymous";
	$user="Anonymous";
}



	require 'dbconnect.inc.php';

	//this inserts annotations into database
	$annotation=strval($_GET['annotation']);
	$text=strval($_GET['text']);
	$start=intval($_GET['startpos']);
	$end=intval($_GET['endpos']);
	$datestamp=date('Y-m-d H:i:s');

	//for adding points according to the annotation category added
	if(isset($_SESSION['emaild']))
	{
		$s=substr($annotation,0,3);

      		if($s=='[Q]')
      		{
      			$points=2;
      		}
      		else
      		{
			$points=1;
		}	
      	
      	// adding points based on articles
      	//checking it by user and article as a primary key 
      	if(isset($_SESSION['emaild']) && isset($_SESSION['art']))
      	{
      		$res=mysqli_query($link,"select * from leaderboard where emailid='$user' and article='$art' ");
      		$num_rows=mysqli_num_rows($res);
      		if($num_rows > 0)
      		{
      			mysqli_query($link,"update leaderboard set points=points+'$points' where emailid='$user' and article='$art' ");
      		}
      		else
      		{
      			mysqli_query($link,"insert into leaderboard values('$user','$art','$points') ");
      		}
      	}
      	
	}
	
	$text=mysqli_real_escape_string($link,$text);
	//will not treat ", ', :from the text etc as control sequences
	
	$annotation = mysqli_real_escape_string($link,$annotation);//same -
	
	$query="insert into content (text,annotation,date,spos,epos,user,article)	
	values('$text','$annotation','$datestamp','$start','$end','$user','$art')";

	if($text!='null' && $annotation!='null' && $text!="" && $annotation!=""){	
		
		$queryresult=mysqli_query($link,$query) or die(mysqli_error($link));
		
	}

	mysqli_close($link);

	
	//sending mail to watcher when a new annotation is added
	require 'dbconnect.inc.php';
	$result1=mysqli_query($link,"select distinct emailid from content,watchers where text='$text' and id=fid ") or die(mysqli_error($link));//joining query on tables content and watchers
	while($row1=mysqli_fetch_array($result1)) //gettig emailidds of all the watchers for that particular text
	{
		$emailid=$row1['emailid'];
		sendemailnew($emailid,$text,$annotation);//this function is created nin mailtowatchers.php which has been included alreday
	}
	mysqli_close($link);


	//to sort annotations in order of votes
	$i=0;
    require 'dbconnect.inc.php';
    $result=mysqli_query($link,"select * from content where '$start'>=spos and '$start'<=epos and article='$art' order by text,votes desc");
    while($row=mysqli_fetch_array($result))
       {
   			$id[$i]=$row['id'];//$id is php array storing all the ids fetched from the database and id is name of column
			// in content table
   			$i++;
       }

       $_SESSION['id']=$id;
       //bcz we are displaying the annotations in another file
       
       mysqli_close($link);
           
       include 'show_annotations.php';

?>
