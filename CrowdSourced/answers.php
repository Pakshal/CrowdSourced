<?php
// adding the answers into qanswers table and displaying the answers
//which is done in the show_annotations.php which is included in this file.
session_start();
include 'mailtowatchers.php';
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

	$art=$_SESSION['art'];
	$answer=strval($_GET['answers']);
	$aid=intval($_GET['annotationid']);

	//appending [A] to the answer
	$answer='[A]'.$answer;
	
	$datestamp=date('Y-m-d H:i:s');
	
	$answer = mysqli_real_escape_string($link,$answer);


	//adding points when the answer is added
	if(isset($_SESSION['emaild']))
	{
			$res=mysqli_query($link,"select * from leaderboard where emailid='$user' and article='$art' ");
      		$num_rows=mysqli_num_rows($res);
      		if($num_rows > 0)
      		{
      			mysqli_query($link,"update leaderboard set points=points+3 where emailid='$user' and article='$art' ");
      		}
      		else
      		{
      			mysqli_query($link,"insert into leaderboard values('$user','$art',2)");
      		}
	}
	

	mysqli_query($link,"insert into qanswer(annoid,answer,date,user) values('$aid','$answer','$datestamp','$user')");
	mysqli_close($link);
	require 'dbconnect.inc.php';
	$result1=mysqli_query($link,"select distinct emailid from watchers where fid='$aid' ") or die(mysqli_error($link));
	
	//query for getting the text value
	$result=mysqli_query($link,"select text,annotation from content where id='$aid'");
	$res=mysqli_fetch_array($result);
	$text=$res['text'];
	$question=$res['annotation'];
	
	//sending mail to watchers for the text
	while($row1=mysqli_fetch_array($result1))
	{
		$emailid=$row1['emailid'];
		sendemailnewanswer($emailid,$text,$answer,$question);
	}
	mysqli_close($link);
	$i=0;
    

    require 'dbconnect.inc.php';
    
    $result=mysqli_query($link,"select * from content where id='$aid'");
    $row1=mysqli_fetch_array($result);
    
    $start=$row1['spos'];
    $result=mysqli_query($link,"select * from content where '$start'>=spos and '$start'<=epos and article='$art' order by text,votes desc");
    
    //storing all the annotation ids in the array

    while($row=mysqli_fetch_array($result))
    {
   			$id[$i]=$row['id'];
   			$i++;
    }
       //putting the array in session
       //the array is used in displaying the annotations and answers
       //in show_annotations.php
       $_SESSION['id']=$id;
       
       mysqli_close($link);
           
       include 'show_annotations.php';

?>
