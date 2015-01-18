<?php

//sending mail to all the watchers 
//if they have clicked on watch button for the particular text
//mail is sent if an new annotatio/answer is added,
//if the annotation has been modified,
//and if the annotation is deleted or reverted

require("class.phpmailer.php");

	

	//sending mail to watchers when an annotation is edited
	function sendemail($emailid,$oldannotation,$newannotation,$text)
	{
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
		$mail->Subject  = "Crowd Sourced Textbook";
		$mail->Body     = "Annotation for the text:".$text."was changed from :".$oldannotation." to ".$newannotation;
		$mail->WordWrap =50; 
		if(!$mail->Send()) {

			//echo "mail not sent";
		} 
		else {
			//echo 'mail has been sent to your emailaddress.';
		}
    }


    function sendemailnew($emailid,$text,$annotation) //sending mail to watchers when a new annotation for that text is added
	{
		
		$mail = new PHPMailer();
   		$mail->IsSMTP();
   		$mail->Mailer = "smtp";
   		$mail->Host = "smtp.gmail.com"; 
		

   		$mail->Port = "465"; 
		// 8025, 587 and 25 can also be used. Use Port 465 for SSL.

   		$mail->SMTPAuth = true;
   		$mail->SMTPSecure = 'ssl'; 
		

   		$mail->Username = "crowdsourcedtext@gmail.com";
   		$mail->Password = "@iitropar";
		$mail->AddAddress("$emailid");
		$mail->Subject  = "Crowd Sourced Textbook";
		$mail->Body     = "New Annotation for the text: ".$text." Is added: \n New Annotation: ".$annotation;
		$mail->WordWrap =50; 
		if(!$mail->Send()) {

			//echo "mail not sent";
		} 
		else {
			//echo 'mail has been sent to your emailaddress.';
		}
    }

    //sending mail if the annotation is reverted
    function sendemailrevert($emailid,$text,$curann,$conver) //sending mail to watchers 
	{
		$mail = new PHPMailer();
   		$mail->IsSMTP();
   		$mail->Mailer = "smtp";
   		$mail->Host = "smtp.gmail.com"; 
		

   		$mail->Port = "465"; 
		// 8025, 587 and 25 can also be used. Use Port 465 for SSL.

   		$mail->SMTPAuth = true;
   		$mail->SMTPSecure = 'ssl'; 
		

   		$mail->Username = "crowdsourcedtext@gmail.com";
   		$mail->Password = "@iitropar";
		$mail->AddAddress("$emailid");
		$mail->Subject  = "Crowd Sourced Textbook";
		$mail->Body     = "Annotation ".$conver." for the text: ".$text." reverted to ".$curann;
		$mail->WordWrap =50; 
		if(!$mail->Send()) {

			//echo "mail not sent";
		} 
		else {
			//echo 'mail has been sent to your emailaddress.';
		}
    }

    //sending mail if the annotation is deleted
	function sendemaildelete($emailid,$text,$annotation) //sending mail to watchers when an annotation is deleted by administrator
	{
		$mail = new PHPMailer();
   		$mail->IsSMTP();
   		$mail->Mailer = "smtp";
   		$mail->Host = "smtp.gmail.com"; 
		

   		$mail->Port = "465"; 
		// 8025, 587 and 25 can also be used. Use Port 465 for SSL.

   		$mail->SMTPAuth = true;
   		$mail->SMTPSecure = 'ssl'; 
		
   		$mail->Username = "crowdsourcedtext@gmail.com";
   		$mail->Password = "@iitropar";
		$mail->AddAddress("$emailid");
		$mail->Subject  = "Crowd Sourced Textbook";
		$mail->Body     = "Annotation ".$annotation." for the text:  ".$text." deleted ";
		$mail->WordWrap =50; 
		if(!$mail->Send()) {

			//echo "mail not sent";
		} 
		else {
			//echo 'mail has been sent to your emailaddress.';
		}
    }


    //sending mail if the new answer is added for the text
    function sendemailnewanswer($emailid,$text,$answer,$question) //sending mail to watchers 
	{
		
		$mail = new PHPMailer();
   		$mail->IsSMTP();
   		$mail->Mailer = "smtp";
   		$mail->Host = "smtp.gmail.com"; 
		

   		$mail->Port = "465"; 
		// 8025, 587 and 25 can also be used. Use Port 465 for SSL.

   		$mail->SMTPAuth = true;
   		$mail->SMTPSecure = 'ssl'; 
		

   		$mail->Username = "crowdsourcedtext@gmail.com";
   		$mail->Password = "@iitropar";
		$mail->AddAddress("$emailid");
		$mail->Subject  = "Crowd Sourced Textbook";
		$mail->Body     = "New Answer for the text: ".$text.", question: ".$question." Is added: \n New Answer: ".$answer;
		$mail->WordWrap =50; 
		if(!$mail->Send()) {

			//echo "mail not sent";
		} 
		else {
			//echo 'mail has been sent to your emailaddress.';
		}
    }



    function sendemaildeleteans($emailid,$text,$question,$answer) //sending mail to watchers when an annotation is deleted by administrator
	{
		$mail = new PHPMailer();
   		$mail->IsSMTP();
   		$mail->Mailer = "smtp";
   		$mail->Host = "smtp.gmail.com"; 
		

   		$mail->Port = "465"; 
		// 8025, 587 and 25 can also be used. Use Port 465 for SSL.

   		$mail->SMTPAuth = true;
   		$mail->SMTPSecure = 'ssl'; 
		
   		$mail->Username = "crowdsourcedtext@gmail.com";
   		$mail->Password = "@iitropar";
		$mail->AddAddress("$emailid");
		$mail->Subject  = "Crowd Sourced Textbook";
		$mail->Body     = "Answer ".$answer." for the text:  ".$text." and question:".$question." deleted ";
		$mail->WordWrap =50; 
		if(!$mail->Send()) {

			//echo "mail not sent";
		} 
		else {
			//echo 'mail has been sent to your emailaddress.';
		}
    }


?>
