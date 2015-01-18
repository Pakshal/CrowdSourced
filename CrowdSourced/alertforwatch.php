<?php


//if session is not set alert the user to sign in using alertnotsignedin function
//else insert the user emailid and the id into watchers table in the database using 
//insertwatchers function in watchers.js
 if(!isset($_SESSION['emaild']))
 {
 	echo 'onclick="return alertnotsigned(this);"';

 }
 else
 {
 	echo 'onclick="insertwatchers(this);"';
 }
 

 


?>