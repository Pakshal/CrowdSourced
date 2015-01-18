<!--displays all the active users --> 
<!DOCTYPE html>
<html>
<style>

table {
	width:100%;
	table-layout: fixed;
	word-wrap:break-word;
	
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
#table_wrapper
{
	background:white;
    margin:3%;
    min-height:400px;
    height: auto;            
    -moz-box-shadow:0 0 20px rgba(0,0,0,0.4);
    -webkit-box-shadow: 0 0 20px rgba(0,0,0,0.4);
    box-shadow:0 0 20px rgba(0,0,0,0.4);
}
</style>

<?php
	if (!isset($_SESSION)) {
  	session_start();
	}
?>
<title>Active Users</title>
<head>
<link rel="stylesheet" href="css/topribbon.css">

<script type="text/javascript" src="js/signinpopup.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/backtotop.js"></script>

</head>
<body>
	<?php 
	include 'header.php'; 
	
	require 'dbconnect.inc.php';
	echo '<div id="table_wrapper">';
	echo '<table><tr style="text-align:left">
	<th style="width:50px";>Username</th>
	<th style="width:50px";>IP address</th>
	</tr>';
	//status on means the user is online now
	//displaying users emailid and ip
	$result=mysqli_query($link,"select * from plus_login where status='on' ");
	while($row=mysqli_fetch_array($result))
	{
		 echo'<tr>
    			<td>'.$row['emailid'].'</td>
    			<td>'.$row['ip'].'</td>
			
    		</tr>';	
	}
	echo '</table>';
?>
</div>

<a href="#" class="back-to-top">Back to Top</a>
<?php include 'footer.php';?>
</body>
</html>