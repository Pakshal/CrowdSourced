<!DOCTYPE html>
<html lang='en'>
<title>
Wiki Log for Annotation Database
</title>

<head>
</head>

<body>

<style>
table {
	width:100%;
	table-layout: fixed;
	word-wrap:break-word;
	border: 1px;
}
</style>

<h1>Annotation Log, without Edits</h1>
<h3></h3>
<br>
<table>
<tr style="text-align:left">
	<th style="width:20px">Serial</th>
	<th style="width:150px">Text</th>
	<th style="width:150px">Annotation</th>
	<th style="width:20px">Votes</th>
	<th style="width:40px">User</th>
	<th style="width:40px">Date</th>
</tr>
<?php
//this will print the details of the annotations added to the system
include 'dbconnect.inc.php';
$result=mysqli_query($link,"select * from content") or die ($conn_error_msg);
$ctr=1;
while($row=mysqli_fetch_array($result)){
    echo "<tr>
    		<td>".$ctr."</td>
    		<td>".$row['text']."</td>
    		<td>".$row['annotation']."</td>
    		<td>".$row['votes']."</td>
    		<td>".$row['user']."</td>
    		<td>".$row['date']."</td>
    	</tr>";
    $ctr++;
}
?>

</table>
</body>
</html>