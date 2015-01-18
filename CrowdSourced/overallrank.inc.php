<?php

include 'dbconnect.inc.php';

$result=mysqli_query($link,"select emailid,sum(points) from leaderboard  group by emailid order by sum(points) desc");

//suppose user has not annotated any text then his rank will not be displayed
if(mysqli_num_rows($result)!=0)
{
	$rank=1;
	while($row=mysqli_fetch_array($result))
	{
		if($name==$row['emailid'])
		{
			echo '<li style="color:white;">overall rank:'.$rank.'</li>';
			break;
		}
		$rank++;
	}
}

mysqli_close($link);

?>