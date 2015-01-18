<!-- destroys all the sessions after logging out and redirects to
the same page-->
<?php
 session_start(); //session is started to destroy all the sessions of the logged in user
 session_destroy(); //destroying the session 

 
 if(isset($_SERVER['HTTP_REFERER'])) {
 header('Location: '.$_SERVER['HTTP_REFERER']);  //after logging out stay in the same page
} else {
 header('Location: index.php');  
}
 exit;

 
?>