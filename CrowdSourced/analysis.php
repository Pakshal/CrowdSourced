<!DOCTYPE html>
<html lang='en'>
<?php
if (!isset($_SESSION)) {
  session_start();
}
?>

<head>
<meta charset='utf-8' />
<title>The Crowdsourced Textbook</title>
<link rel="stylesheet" href="css/topribbon.css">
<script type="text/javascript" src="js/signinpopup.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/backtotop.js"></script>

</head>



<body>
	
	<?php include 'header.php'; ?>

	<style>
	
	h1,h2,h3{
		font-family: 'Gothic',sans-serif;
		font-weight:800;
	}
	h2{
		padding-left:6%;
		margin:2% 0px 2% 0px;
	}
	#content {
		background-color:white;
		font:Tahoma;
		padding: 4%;
		margin:3%;
		-moz-box-shadow:0 0 20px rgba(0,0,0,0.4);
  		-webkit-box-shadow: 0 0 20px rgba(0,0,0,0.4);
  		box-shadow:0 0 20px rgba(0,0,0,0.4);
		width:85%;
		min-height: 90%;
		background-image: url("static/bg.jpg");
	background-size: 1380px 1000px;
		background-repeat: no-repeat;
		display: inline-block;

	}
	
	

</style>

<div id="content">
<a href="some_analysis.php">Effort distribution and Ecosystem</a><br><br>
<a href="https://drive.google.com/file/d/0B-nFlVuC-889cmN6TjFyVXJJTnM/view" target="_blank">Crowd Supported Collaborative Learning: Why is Sum Greater than the parts?*</a>
<br>*(Under Review, Please do not cite) <br><br>
<a href="backup.php">Data used for analysis</a>
<pre>




















</pre>

</div>
<?php include 'footer.php';?>

</body>

</html>

