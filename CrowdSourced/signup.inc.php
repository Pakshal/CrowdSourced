<!-- inserting user details into the table credential with status 0
	which indicates account is not activated.
	Onclicking the link which is sent to the user via email,his/her account 
	will be activated -->
<html>
<head>
<?php
require 'dbconnect.inc.php';

//required for sending emails
require("class.phpmailer.php");


//getting the values from the form
$firstname=$_POST["firstname"];
$lastname=$_POST["lastname"];
$password=$_POST["password"];
$emailid=$_POST['emailid'];
$profession=$_POST["Profession"];
$key=md5($emailid).md5($password);


//check whether the email id already exists in the database count has the number of rows
$result=mysqli_query($link,"select * from credential where emailid='$emailid'");
$count=mysqli_num_rows($result);

echo '<div id="content" align="center">';

//if count is zero emailid does not exists in the databse so we can insert in the database and send the 
//verification email using mail function
//if count is greater than one display the message in the else part
if($count==0)
{

	$sql="INSERT INTO credential(firstname,lastname,password,emailid,Ekey,profession,status)
	VALUES ('$firstname','$lastname','$password','$emailid','$key','$profession',1)";

	if(!mysqli_query($link,$sql))
	{
		die('Error: ' . mysqli_error($link));
	}
	
		$mail = new PHPMailer();
   		$mail->IsSMTP();
   		$mail->Mailer = "smtp";
   		$mail->Host = "smtp.gmail.com"; 
	

   		$mail->Port = "465"; 
		// 8025, 587 and 25 can also be used. Use Port 465 for SSL.

   		$mail->SMTPAuth = true;
   		$mail->SMTPSecure = 'ssl'; 
		// Uncomment this line if you want to use SSL.

   		$mail->Username = "crowdsourcedtext@gmail.com";
   		$mail->Password = "@iitropar";
   		$mail->AddAddress("$emailid");
		$mail->Subject  = "Confirmation email";
		$mail->Body     = "Hi! \n\n click on this link for successfull registration to Crowd Sourced Text Book site \n http://115.248.248.12/CrowdSourced/verification.php?id=".$key;
		$mail->WordWrap =50; 
	
	//if mail is not sent redirect to the page singnup.html else display hte succesfull message
	if(!$mail->Send()) {
		
		echo 'Mailer error: ' . $mail->ErrorInfo;
		echo "<br><br>Thank you for Signing Up! 
		<br>However, the verification email failed to be sent. 
		<br>Please contact the administrator to activate your account.
		<br><br>";
		echo '<a href="index.php">Click here to go back to Homepage</a>';
	} 
	else {
		echo '<br><br>Thank you for Signing Up!
			<br>A verification link has been sent to your email address. Click the reference for successful activation of your account.
		<br><br>';
		echo '<a href="index.php">Click here to go back to the Homepage</a>';

	}
}
else{
   echo '<br><br>Email already exists. Please enter different one.<br><br>';
   echo '<a href="javascript:javascript:history.go(-1)">Click here to go back to previous page!</a><br><br>';
   echo '<a href="signup.html">Click here to go back to Sign Up page!<a><br><br>';
   echo '<a href="index.php">Click here to go back to Homepage!<a><br><br>';
}	

echo '</div>';

mysqli_close($link);

?>
</head>
</html>
