<!-- selected article will be displayed with annotations and 
  option of adding annotation(popup which appears after selecting the text)-->

<!DOCTYPE html>
<html lang='en'>
<?php 
$art=$_GET['article'];
if (!isset($_SESSION)) { 
  session_start(); 
} 
//storing the article name in session
$_SESSION['art']=$art;
?>

<head>
<meta charset='utf-8' />
<title>The Crowdsourced Textbook</title>
<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/main.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/base_annotator.js"></script>
<script type="text/javascript" src="js/signinpopup.js"></script>
<script type="text/javascript" src="js/alertnotsigned.js"></script>
<script type="text/javascript" src="js/suggestedit.js"></script>
<script type="text/javascript" src="js/watchers.js"></script>
<script type="text/javascript" src="js/admin.js"></script>
<script type="text/javascript" src="js/backtotop.js"></script>
<script type="text/javascript" src="js/addanswer.js"></script>
<script type="text/javascript" src="js/suggesteditans.js"></script>
<script type="text/javascript" src="js/vote_incrm_forans.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55861514-1', 'auto');
  ga('send', 'pageview');

</script>
</head>


<body>

   <div id="page_header">
    <div id="logo">
        <img src="static/logo.png" width="250" height="90"/></div>
    <div id="links">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="help.php">Help</a></li>
        <li><a href="about.php">About</a></li>
        <?php
                if ((isset($_SESSION)) && $_SESSION['emaild']=='admin@admin.com')
                {
                    echo '<li><a href="leaderboard.php">Leaderboard</a></li>';
                }
        ?>

        <?php include 'signinstatus.php'; ?>

 <?php
  include 'dbconnect.inc.php';
  $top10='Top 10 Contributors: &nbsp';
    $i=1;
    $result=mysqli_query($link,"select leaderboard.emailid,sum(points),firstname from leaderboard,credential where credential.emailid=leaderboard.emailid group by leaderboard.emailid order by sum(points) desc limit 10;
") or die(mysqli_error($link));
    while($row=mysqli_fetch_array($result))
    {
      $top10=$top10.$i;
      $top10=$top10.'.'.' &nbsp'.$row['firstname'].'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
      $i++;
    }

  echo'<div id="Top10"><br><marquee onmouseover="this.stop();" onmouseout="this.start();"><b></b></marquee></div>';


?>    
        

<div id="maintext" class="maintext" onmouseup='foo(this);'> 
  <!-- foo function is in base_annotator.js -->
    <div id="insidetext">

      <?php
            $art=$_SESSION['art'];
            $page='articles/'.$art.'.html';
            include $page;
        ?>
    </div>
</div>
<?php include 'tryingpop.html';?> 
<!-- this creates the popup and also fades the background when pop up appears-->

<?php include 'highlight_annotated.inc.php'; ?>

<aside>
  <div id="rightpanel" class="rightpanel" >
    <div id='annotation_panel_header' style="color:white;">ANNOTATIONS</div>
	<div id="txtHint">
	  <div style="font: italic 15px Verdana;  padding-left: 10px; padding-bottom: 5px; padding-top: 5px;">
            Click on a highlighted text portion to view its annotations! <br><br> Select a text range to add an annotation to it!
        </div>
	</div>
    </div>
</aside>
<a href="#" class="back-to-top">Back to Top</a>
<?php include 'footer.php';?>



<!--</div>-->

</body>

</html>
