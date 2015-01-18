<?php
	if (!isset($_SESSION)) {
  session_start();
}
?>
<head>
<meta charset='utf-8' />
<title>
Leaderboard
</title>
<link rel="stylesheet" href="css/topribbon.css">
<script type="text/javascript" src="js/signinpopup.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/backtotop.js"></script>

</head>
<body>
<style>
table {
	width:100%;
	
	word-wrap:break-word;
	
	padding-left:1%;
    padding-right:1%;
    padding-bottom:1%;

	
}
#table_wrapper
{
	background:white;
    margin:3%;
    min-height:400px;            
    -moz-box-shadow:0 0 20px rgba(0,0,0,0.4);
    -webkit-box-shadow: 0 0 20px rgba(0,0,0,0.4);
    box-shadow:0 0 20px rgba(0,0,0,0.4);
    height: auto;
}
#selectwrapper
{
    
    padding-left: 1%;
    padding-top: 1%;
}
h4
{
    padding-left: 1%;
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
</style>

<script>

    function validate()
    {
                
        var article= document.forms["leaderboard"]["article"].value;
                
                
                
        if(article=="" || article==null)
        {
            alert("please select the article");
            return false;   
        }
                
    }



</script>

	<?php include 'header.php'; ?>

    <?php

    include 'dbconnect.inc.php';
    
    $result=mysqli_query($link,"select articlename from articles") or die(mysqli_error($link));
    $i=0;
    //putting all the article names in the $store_article_name array
    //its done bcoz to populate the dropdown automatically when the database is updated
    while($row=mysqli_fetch_array($result)) 
    {
         $store_article_name[$i]=$row['articlename'];
         $i++;
    }

    mysqli_close($link);

    ?>

<?php

if(isset($_SESSION['emaild']) && $_SESSION['emaild']=='admin@admin.com')
{

echo '<div id="table_wrapper">';
    echo '<div id="selectwrapper">
    <form method="POST" action="leaderboard.php" name="leaderboard">
    <select name="article" id="selectarticle">
    <option value="">--Select Article--</option>';
    
    //putting all the article names from the array to dropdown list
    foreach($store_article_name as $col)
    {
        echo '<option value="'.$col.'">'.$col.'</option>';    
    }
    echo '<option value="Overall Rank">Overall Rank</option>';
    echo '</select>

    <input type="submit" value="submit" name="search" onclick=" return validate(this);">
    </form></div>';


if(isset($_POST['search']))
{	
    echo '<h4> selected article: "'.$_POST['article'].'"</h4><br><table >
	<tr style="text-align:center">
	<th style="width:20px";>Sl.No.</th>
	<th style="width:150px";>Firstname</th>
	<th style="width:150px";>Lastname</th>
	<th style="width:100px";>Points</th>
	</tr>';

    include 'dbconnect.inc.php';

    
    $art=$_POST['article'];
    if ($art=="Overall Rank")
    {
        $result=mysqli_query($link,"select firstname,lastname,sum(points) as points from credential c,leaderboard l where c.emailid=l.emailid group by l.emailid order by sum(points) desc") or die ($conn_error_msg);

    }
    else
        $result=mysqli_query($link,"select * from credential c,leaderboard l where c.emailid=l.emailid and article='$art' order by points desc") or die ($conn_error_msg);
    $count=1;
    while($row=mysqli_fetch_array($result)){

    echo "<center>
    		<tr>
    		
    		<td>".$count."</td>	";
    		if($count<10)
    		{
    			echo "<td><b><center>".$row['firstname']."</center></b></td>";
    			echo "<td><b><center>".$row['lastname']."</center></b></td>
    					<td><b><center>".$row['points']."</center></b></td>";
    		}
    		else
    		{
    			echo "<td><center>".$row['firstname']."</center></td>";
    			echo "<td><center>".$row['lastname']."</center></td>
    					<td><center>".$row['points']."</center></td>";
    		}

    		echo "</center>";
    		echo "</tr>";

    $count++;	
    }

    echo '</table>';
    mysqli_close($link);
}
else
{
    echo "<h4>Overall Rank</h4>";
    echo '<table><tr style="text-align:center">
    <th style="width:20px";>Sl.No.</th>
    <th style="width:150px";>Firstname</th>
    <th style="width:150px";>Lastname</th>
    <th style="width:100px";>Points</th>
    </tr>';

    include 'dbconnect.inc.php';

    
    
    $result=mysqli_query($link,"select firstname,lastname,sum(points) as points from credential c,leaderboard l where c.emailid=l.emailid group by l.emailid order by sum(points) desc") or die ($conn_error_msg);
    $count=1;
    while($row=mysqli_fetch_array($result)){

    echo "<center>
            <tr>
            
            <td>".$count."</td> ";
            if($count<10)
            {
                echo "<td><b><center>".$row['firstname']."</center></b></td>";
                echo "<td><b><center>".$row['lastname']."</center></b></td>
                        <td><b><center>".$row['points']."</center></b></td>";
            }
            else
            {
                echo "<td><center>".$row['firstname']."</center></td>";
                echo "<td><center>".$row['lastname']."</center></td>
                        <td><center>".$row['points']."</center></td>";
            }

            echo "</center>";
            echo "</tr>";

    $count++;   
    }

    echo '</table>';
    mysqli_close($link);
}
}
?>
</div>
<a href="#" class="back-to-top">Back to Top</a>
<?php include 'footer.php';?>
</body>
</html>
