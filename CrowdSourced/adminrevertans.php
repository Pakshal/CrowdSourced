<?php

//this file is used to revert the annotations by the admin
//annotation id is got from revertadmin function in admin.js
//revert option is provided in edit_log page

require 'dbconnect.inc.php';
include 'mailtowatchers.php';
$hiddenid=$_POST['hiddenid'];
//hiddenid is nothing but the answer id

$result=mysqli_query($link,"select * from qanswer where ansid='$hiddenid'");
$row=mysqli_fetch_array($result);
$ans=$row['answer'];
$id=$row['annoid'];

$result=mysqli_query($link,"select * from content where id='$id'");

$row=mysqli_fetch_array($result);
$question=$row['annotation'];
$text=$row['text'];

//reverting the ans so delete that particular ans from the edit logans based on the annotation id
$check=mysqli_query($link,"delete from edit_logans where ansid='$hiddenid' and ans='$ans' ");
mysqli_close($link);

require 'dbconnect.inc.php';
$current_anno='';
//after deleting get the previous annotation for that particlar annotation id(order by datetime desc)
$check=mysqli_query($link,"select * from edit_logans where ansid='$hiddenid' order by datetime desc");
$count=mysqli_num_rows($check);
//if count is 0 there are no annotations left so delete the entries from all other tables
if($count==0)
{
	
	mysqli_query($link,"delete  from ansvotes where ansid='$hiddenid' ");
  mysqli_query($link,"delete  from qanswer where ansid='$hiddenid' ");

}
else
{
  $latest=mysqli_fetch_array($check);
  $current_votes=$latest['votes'];
  //$current=$latest['anno']."~".$current_votes;
  //echo $current;
  $current_ans=$latest['ans'];
//updating the ans in the content table(reverting back to previous ans)
  mysqli_query($link,"update qanswer set answer='$current_ans',votes='$current_votes' where ansid='$hiddenid' ") or die(mysqli_error($link));
  $new=mysqli_query($link,"select max(datetime) from edit_logans");
  $row=mysqli_fetch_array($new);
  $date=$row['max(datetime)'];
//deleting the latest entry from the edit_log table
  mysqli_query($link,"delete from edit_logans where ansid='$hiddenid' and ans='$current_ans' and datetime='$date' ") or die(mysqli_error($link));
  
  $result1=mysqli_query($link,"select distinct emailid from content,watchers where text='$text' and id=fid");
	while($row1=mysqli_fetch_array($result1))
	{
		$emailid=$row1['emailid'];
		//sendemailrevert($emailid,$text,$current_anno,$annotation);
	}
}

mysqli_close($link);

?>
