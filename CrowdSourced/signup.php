<!-- contains all the sign up options and verification of all the fields done
here-->
<!DOCTYPE html>
<html>
<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<head>
    <meta charset='utf-8' />
    <title>
        Sign Up
    </title>
    <link rel="stylesheet" href="css/topribbon.css">
    <script type="text/javascript" src="js/signinpopup.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/backtotop.js"></script>
<script>
function validateform() {
	var x = document.forms["signup"]["firstname"].value;
    var patt1 = /[0-9]/g;
    var result = x.match(patt1);
    //alert(result);
    if (x==null || x=="") {
        alert("First name must be filled out");
        //x.focus();
        document.forms["signup"]["firstname"].focus();
        return false;
    }
    else if((!isNaN(x))){
    	alert("Firstname must be only letters and characters");
    	document.forms["signup"]["firstname"].focus();
    	return false;
    }
    else if(result!=null)
    {
    		alert("Firstname must be only letters and characters");
    		document.forms["signup"]["firstname"].focus();
    		return false;
    }
    else 
    {
         var iChars = "~`!#$%^&*+=-[]\\\';,/{}|\":<>?";

        for (var i = 0; i < x.length; i++) {
            if (iChars.indexOf(x.charAt(i)) != -1) {
            alert ("Firstname has special characters ~`!#$%^&*+=-[]\\\';,/{}|\":<>? \nThese are not allowed\n");
            return false;
            }
        }
    }


    var lastname=document.forms["signup"]["lastname"].value;
    var iChars = "~`!#$%^&*+=-[]\\\';,/{}|\":<>?";

        for (var i = 0; i < lastname.length; i++) {
            if (iChars.indexOf(lastname.charAt(i)) != -1)
            {
                alert ("Last name has special characters ~`!#$%^&*+=-[]\\\';,/{}|\":<>? \nThese are not allowed\n");
                return false;
            }
        }
     
     
    
     var email = document.forms["signup"]["emailid"].value;
     if (email==null || email=="") {
        alert(" Emailid must be filled out");
        document.forms["signup"]["emailid"].focus();
        return false;
    }
    else
    {
    
    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2<=x.length) {
        alert("Not a valid e-mail address");
        document.forms["signup"]["emailid"].focus();
        return false;
    }    
    }
    var password = document.forms["signup"]["password"].value;
     if (password==null || password=="") {
        alert(" Password field is compulsory");
        document.forms["signup"]["password"].focus();
        return false;
    }
    
    var password = document.forms["signup"]["password"].value;
    var confirmpassword=document.forms["signup"]["confirmpassword"].value;
    if(password!=confirmpassword)
    {
    	alert("Entered wrong password in confirm password field");
    	document.forms["signup"]["confirmpassword"].focus();
    	return false;
    }
    
    var aliasname=document.forms["signup"]["user"].value;
     if (aliasname==null || aliasname=="") {
        alert(" Aliasname must be filled out");
        document.forms["signup"]["user"].focus();
        return false;
    }


  

}
</script>
</head>

<body>
    <?php include 'header.php'; ?>
<style>
#myDIV
{
	width:40%;
	background-color:white; 
	color:black;
	font-size: 20px;
	-moz-box-shadow:0 0 20px rgba(0,0,0,0.4);
	-webkit-box-shadow: 0 0 20px rgba(0,0,0,0.4);
	box-shadow:0 0 20px rgba(0,0,0,0.4);
	margin-top: 2%;
	margin-bottom: 2%
}

body{
        background:url('static/bg.png');
    }
</style>

<center>

	<div id="myDIV">
		<b><h1>Sign up<h1></h1></b>
		<form name="signup" action="signup.inc.php" method="POST" onsubmit=" return validateform()">
		Firstname *<br><input type="text" name="firstname" width="250%"><br><br>
		Lastname<br><input type="text" name="lastname"><br><br>
		EmailId *<br><input type="text"name="emailid"><br><br>
		Create a Password *
		<span class="labelTip" title=""></span>
		<br><input type="password"name="password"><br><br>
		Confirm Password *<br><input type="password"name="confirmpassword"><br><br>
		
		<label>Profession:<br></label>
			<select name="Profession"  method="get">
  		
  				<option value="Student">Student</option>
  				<option value="Professional">Professional</option>
  				<option value="Retiredlecturer">Retired Lecturer</option>
  				<option value="Lecturer">Lecturer</option>
  				<option value="Others">Others</option>
			</select>
		<br><br>
		<input type="submit"value="SUBMIT">


		<br>

		  <p >Mandatory fields are noted by an asterisk(*)</p>
           <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:javascript:history.go(-1)" style="padding-right:70px;">Go Back</a></p><br>

	
	</form>
	</div>

</body>
</html>
