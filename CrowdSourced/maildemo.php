<?php

require("class.phpmailer.php");

	

   $mail = new PHPMailer();
   $mail->IsSMTP();
   $mail->Mailer = "smtp";
   $mail->Host = "smtp.gmail.com"; 
//Enter your SMTP2GO account's SMTP server.

   $mail->Port = "465"; 
// 8025, 587 and 25 can also be used. Use Port 465 for SSL.

   $mail->SMTPAuth = true;
   $mail->SMTPSecure = 'ssl'; 
// Uncomment this line if you want to use SSL.

   $mail->Username = "crowdsourcedtext@gmail.com";
   $mail->Password = "@iitropar";
    
   $mail->From     = "crowdsourcedtext@gmail.com";
   $mail->FromName = "Crowd_sourced Textbook";
   $mail->AddAddress("rajeshbht19@gmail.com", "hello its working");
   $mail->AddReplyTo("rajeshbht19@gmail.com", "Sender's Name");
 
   $mail->Subject  = "Hi!";
   $mail->Body     = "Hi! How are you?";
   $mail->WordWrap = 50;  
 
   if(!$mail->Send()) {
		echo 'Message was not sent.';
		echo 'Mailer error: ' . $mail->ErrorInfo;
		exit;
   } else {
		echo 'Message has been sent.';
   }
    


    

?>
