<?php
//giving an alert to sign in if the user has not logged in 
//onclicking the edit button below the annotation
 if(!isset($_SESSION['emaild']))
 {
 	echo 'onclick="return alertnotsigned(this);"'; 
 	//alertnotsigned function is in alertnotsigned.js

 }
 else
 {	
 	//edit the annotation if user has logged in
 	//edit function is in suggestedit.js
 	echo 'onclick="edit(this);"'; 
 }
 
 


?>
