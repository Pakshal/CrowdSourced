<!DOCTYPE html>
<html lang='en'>
<?php
if (!isset($_SESSION)) {
  session_start();
}
?>

<head>
<meta charset='utf-8' />
<title>
Log for Annotation Database, with Edit Logs
</title>
<link rel="stylesheet" href="css/topribbon.css">
<script type="text/javascript" src="js/signinpopup.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/backtotop.js"></script>
<script type="text/javascript" src="js/admin.js"></script>

</head>

<body>
	<?php include 'header.php'; ?>
	

<style>
table {
	width:100%;
	table-layout: fixed;
	word-wrap:break-word;
	border: 1px solid black;
	padding:1%;

	
}
td{
	padding-top: 1%;

	padding-right: 1%;
	border: 1px solid black;
}
tr{
	padding-top: 1%;
	border: 1px solid black;
}
#editlog{

	background-color: white;

	-moz-box-shadow:0 0 20px rgba(0,0,0,0.4);
  	-webkit-box-shadow: 0 0 20px rgba(0,0,0,0.4);
  	box-shadow:0 0 20px rgba(0,0,0,0.4);
  	margin-left:3%;
  	margin-right:3%;
  	margin-bottom:3%;
  	max-width: 100%;
  	overflow: auto;

}
#abovetext{
	word-wrap:break-word;
	padding:2%;
	text-align: justify;

}
form
{
	padding:2%;
}
#selectwrapper
{
	width: 300px;
	min-height: 80%;
	height:auto;
	

}
#selecttext
{
	width:auto;
	width:100%;
}

</style>

<h1>Annotation Logs, with Edit Logs</h1>
<h3></h3>
<br>


<div id="editlog">
<form method="POST" action="wikilog_edits.php">

<?php

	include 'dbconnect.inc.php';
	
	$result=mysqli_query($link,"select distinct text from content") or die(mysqli_error($link));
	$i=0;
	//putting all the distinct texts in the $store text array
	//its done bcoz to populate the dropdown automatically when the database is updated
	while($row=mysqli_fetch_array($result))	
	{
		 $store_text[$i]=$row['text'];
	 	 $i++;
	}
	mysqli_close($link);

?>
<div id="selectwrapper">
<select name="text" id="selecttext">
	<option value="">--Select Text--</option>
	<?php
	echo '<option value="all">All text</option>';
	//putting all the texts from the array to dropdown list
	foreach($store_text as $col)
	{
    	echo '<option value="'.$col.'">'.$col.'</option>';    
	}
	echo '</select>';
	
	//for selecting an article
	/*
	echo '<select name="article" id="selectarticle">';
	$articleresult=mysqli_query($link,"select distinct article from content");
	while($artrow=mysqli_fetch_array($articleresult))
	{
		echo '<option value="'.$artrow['article'].'">'.$artrow['article'].'</option>';
	}
	echo '</select>';
	*/

?>

<input type="submit" value="search annotations" name="search">

</div>

</form>
<table>

<?php


if(isset($_POST['search']) && $_POST['text']!="all")
{

	
	echo '<div id="above_text"><b>Text:"'.$_POST['text'].'"</b></div>';
	echo '<tr style="text-align:left">
	<th style="width:20px";>ID</th>
	<th style="width:80px";>Annotation</th>
	<th style="width:40px";>Votes</th>
	<th style="width:50px";>User</th>
	<th style="width:30px";>Datetime</th>
	</tr>';
	
	include 'dbconnect.inc.php';
	$text=mysqli_real_escape_string($link,$_POST['text']);
	$result=mysqli_query($link,"select id,annoid,anno,edit_log.user,datetime,edit_log.votes from content,edit_log where annoid=id and text='$text' order by id,datetime desc") or die(mysqli_error($link));

	$prev_id=null;
	$prev_ansid=null;
	while($row=mysqli_fetch_array($result))
	{
	//* indicates the latest annotation
	$annotationid=$row['annoid'];
	echo '<tr>
    		<td>'.$annotationid.'</td>
			<td>'.$row['anno'];
			if($row['annoid']!=$prev_id){
				echo '<b>*</b><br>';
				echo '<input type="button"  name="'.$row['annoid'].'"  value="delete" onclick="deleteadmin(this);">';
				echo '<input type="button"  name="'.$row['annoid'].'"  value="Revert" onclick="revertadmin(this);">';
			}	
			echo ' </td>
			<td>'.$row['votes'].'</td>
    		<td>'.$row['user'].'</td>
    		<td>'.$row['datetime'].'</td>
    	</tr>';
    

    $ans=mysqli_query($link,"select * from qanswer,edit_logans where qanswer.annoid='$annotationid' and qanswer.ansid=edit_logans.ansid order by edit_logans.ansid,datetime desc") or die(mysqli_error($link));
    if(mysqli_num_rows($ans)>0)
    {
    	while($row1=mysqli_fetch_array($ans))
    	{
    		echo '<tr>
    		<td>'.$row1['annoid'].'</td>
			<td>'.$row1['ans'];
			if($row1['ansid']!=$prev_ansid){
				echo '<b>*</b><br>';

				echo '<input type="button"  name="'.$row1['ansid'].'"  value="delete" onclick="deleteadminans(this);">';
				echo '<input type="button"  name="'.$row1['ansid'].'"  value="Revert" onclick="revertadminans(this);">';
			}	
			echo ' </td>
			<td>'.$row1['votes'].'</td>
    		<td>'.$row1['user'].'</td>
    		<td>'.$row1['datetime'].'</td>
    	</tr>';

    	$prev_ansid=$row1['ansid'];
    	}
    }	


    	$prev_id=$row['annoid'];
    }
    mysqli_close($link);
}
else
{
	echo '<b>Displaying all text and annotations</b>';
	$prev_id=null;
	echo '<tr style="text-align:left">
	<th style="width:20px";>ID</th>
	<th style="width:80px";>Text</th>
	<th style="width:60px";>Annotation</th>
	<th style="width:40px";>Votes</th>
	<th style="width:50px";>User</th>
	<th style="width:30px";>Datetime</th>
	</tr>';

	include 'dbconnect.inc.php';
	
	$result=mysqli_query($link,"select annoid,text,anno,edit_log.user,datetime,edit_log.votes from content,edit_log where annoid=id order by id,datetime desc") or die(mysqli_error($link));

	$prev_id=null;
	$prev_ansid=null;
	while($row=mysqli_fetch_array($result)){
	//displaying all the values row by row
	$annotationid=$row['annoid'];	
    echo '<tr>
    		<td>'.$row['annoid'].'</td>
    		<td>'.$row['text'].'</td>
			<td>'.$row['anno'];
			if($row['annoid']!=$prev_id)
			{	
				echo '<b>*</b><br>';
				echo '<input type="button"  name="'.$row['annoid'].'"  value="delete" onclick="deleteadmin(this);">';
				echo '<input type="button"  name="'.$row['annoid'].'"  value="Revert" onclick="revertadmin(this);">';
			}	
			echo ' </td>
			<td>'.$row['votes'].'</td>
    		<td>'.$row['user'].'</td>
    		<td>'.$row['datetime'].'</td>
    	</tr>';

    	$ans=mysqli_query($link,"select * from qanswer,edit_logans where qanswer.ansid=edit_logans.ansid order by edit_logans.ansid,datetime desc") or die(mysqli_error($link));
    	if(mysqli_num_rows($ans)>0)
    	{
    		while($row1=mysqli_fetch_array($ans))
    		{
    			echo '<tr>
    			<td>'.$row1['annoid'].'</td>
    			<td>'.$row['text'].'</td>
				<td>'.$row1['ans'];
				if($row1['ansid']!=$prev_ansid){
				echo '<b>*</b><br>';

				echo '<input type="button"  name="'.$row1['ansid'].'"  value="delete" onclick="deleteadminans(this);">';
				echo '<input type="button"  name="'.$row1['ansid'].'"  value="Revert" onclick="revertadminans(this);">';
			}	
			echo ' </td>
			<td>'.$row1['votes'].'</td>
    		<td>'.$row1['user'].'</td>
    		<td>'.$row1['datetime'].'</td>
    	</tr>';

    	$prev_ansid=$row1['ansid'];
    	}
    }	


    	$prev_id=$row['annoid'];
    }
    mysqli_close($link);

}


?>

</table>

</div>
<a href="#" class="back-to-top">Back to Top</a>


</body>
</html>