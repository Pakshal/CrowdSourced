<?php
//edit the answer if user has logged in
//otherwise alert message to sign in
 if(!isset($_SESSION['emaild']))
 {
 	echo 'onclick="return alertnotsigned(this);"';

 }
 else
 {
 	//editans function is in suggesteditans.js
 	echo 'onclick="editans(this);"';
 }
 
 


?>