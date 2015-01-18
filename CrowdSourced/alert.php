<?php

//alert if user has not signed in onclicking the up or down vote button
//otherwise increment the vote done 
//via  voteincrement() function in the alertnotsigned.js
 if(!isset($_SESSION['emaild']))
 {
 	echo 'onclick="return alertnotsigned(this);"';

 }
 else
 	echo 'onclick="return voteincrement(this);"'
 


?>

