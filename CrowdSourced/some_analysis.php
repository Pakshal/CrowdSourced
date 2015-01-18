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
<font size="5" color="blue">Effort distribution</font><br>
The percentage distribution of [I], [Q], [A] and [P] being 24%, 19%, 52% and 5% respectively, one would infer that most of the users mainly expended their time and effort in answering questions with [A] type annotations and secondarily on posting insights [I] and questions [Q]. This is quite in contrast to what was observed in our logs. The Figure 1 denotes the distribution of [I],[Q],[A],[P] for individual user contribution of annotations, the x-axis denotes all the 60 users sorted in the increasing order of the number of annotations that they posted. There are 4 dots colored blue, red, yellow and green, denoting the [I], [Q], [A] and [P] distributions respectively, of individual users. E.g., the 59th user (second last on the X-axis) contributed 68 annotations with [I]=20, [Q]=17, [A]=26 and [P]=5 amounting to the distribution (0.29, 0.25, 0.38, 0.08) which is denoted by 4 dots on the graph with x=59, namely blue: (59,0.29) red: (59,0.25) yellow: (59,0.38) green: (59,0.08). <br><br>

In simple terms, the graph below represents the distribution of efforts by individual users in posting 4 types of annotations. The [A] type annotations across all 60 users has M=16 and SD=13, this is well reflected in the plot below where we observe that the yellow dots are unevenly scattered and are not clustered along any line parallel to X-axis. This is true of red and blue dots as well. <br>
<img src="images/image00.png" alt="Effort distribution" height="400" width="600" style="display:block;margin:auto;"><br>
<font size="5" color="blue">The presence of an ecosystem</font><br>
We call a user k-unispecialist if s/he appears in the list of top k contributors (in terms of number of annotations) for precisely one type of annotation, and doesn’t appear in the top k of the other three types. E.g., a user A with the annotations [I]=7, [Q]=22, [A]=16, [P]=2 is ranked 26th, 2nd, 23rd and 14th in [I],[Q],[A], [P] respectively. Here, A is 2-unispecialist as s/he appears as one of the top 2 contributors in precisely one type and doesn’t appear in the other 3 types. We note that, by definition, A is a k-unispecialist with k=3, 4... 13. We similarly define a k-bispecialist who appears in the list of top k contributors in precisely 2 types of annotations. E.g., the user A in the above example is a 14-bispecialist but not a 23-bispecialist. On the same lines, we define a k-Trispecialist and a k-Quadspecialist. <br><br>

The Figure 3 shows a plot of the number of k-uni/bi/tri/quad specialists with x-axis running through k = 1, 2, 3 ... 18. At k=10 (along the red dotted line) we observe that the number of 10-unispecialists, 10-bispecialists, 10-trispecialists and 10-quadspecialists are 24, 6, 0 and 1 respectively.<br><br>

The plot indicates that the top contributors are proficient in posting only a particular type of annotation. There are several unispecialists (blue line in the plot)) and very few bispecialists (red line) and negligibly few trispecialists (green) and quadspecialists (purple). We classify top contributors as Articulators, Probers, Solvers and Explorers if they are good at [I], [Q], [A] and [P] type of annotations respectively. It is this ecosystem that exists in a crowdsourced environment that fosters knowledge building and guarantees both - quantity and quality of information. There are Explorers who are good at pointing to external resources which helps garner more data for the users; there are Solvers who are good at answering questions and Probers who ask questions which instigates the crowd to think outside the realms of the given article. Articulators with their above average ability for expressive writing, play a good role in paraphrasing parts of the document which are perceivably less clear to the readers. <br>
<img src="images/image01.png" alt="Ecosystem" height="400" width="600" style="display:block;margin:auto;"><br>
</div>
<?php include 'footer.php';?>

</body>

</html>

