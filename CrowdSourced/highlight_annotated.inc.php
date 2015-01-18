<!-- fetches the text based on the seleted article
from the database to highlight it .Highlighting is done 
based on start and
end positions -->
<?php
require 'dbconnect.inc.php';

//newly added
//highlighting is done based on the article choosen
$art=$_SESSION['art'];
$result=mysqli_query($link,"select * from content where article='$art' order by epos-spos desc") or die ($conn_error_msg);
//till here
$alpha=array();
$beta=array();
$i=0;
$usr="hello";
if(isset($_SESSION['emaild']))
{
	$usr=$_SESSION['emaild'];
}	
while($row=mysqli_fetch_array($result)){
    $startpos=$row['spos'];
    $endpos=$row['epos'];
    $text="maintext";
    $user=$row['user'];
    $alpha[$i]=$startpos;
	$beta[$i]=$endpos;
	$c=0;
	
	for($j=0;$j<=$i;$j=$j+1)
	{
	if(($startpos>=$alpha[$j])&&($endpos<=$beta[$j]))
	{
		$c=(($c+1)%5);
	}
	
	}
	$i=$i+1;
	if($user!=$usr)
    	echo '<script>selectAndHighlightRange("maintext",'.$startpos.','.$endpos.','.$c.');</script>';
    else
    	echo '<script>selectAndHighlightRange("maintext",'.$startpos.','.$endpos.',11);</script>';


    

    
}
mysqli_close($link);
?>
