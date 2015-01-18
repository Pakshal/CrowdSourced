<!DOCTYPE html>
<html>
<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<title>
        Help
</title>
<head>
<link rel="stylesheet" href="css/topribbon.css">
<script type="text/javascript" src="js/signinpopup.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/backtotop.js"></script>

</head>
<body>

<style type="text/css">
        
        h2{
                padding: 5px 60px 5px 60px;
        }
        article{
                background:white;
                margin-bottom:3%;
                margin-left:3%;
                margin-right:3%;
                padding: 30px 60px 30px 60px;
                -moz-box-shadow:0 0 20px rgba(0,0,0,0.4);
                -webkit-box-shadow: 0 0 20px rgba(0,0,0,0.4);
                box-shadow:0 0 20px rgba(0,0,0,0.4);
        }
        #start_anno {
                font: 30px bold Gothic;
                text-align: center;
        }
        #start_anno:hover {
                background-color: white;
        }
        h1,h2,h3{
            font-family: 'Gothic',sans-serif;
            font-weight:800;
        }
        #container{
           //padding-top: 9%;
        
        }
</style>

<?php include 'header.php'; ?>

<div id="container">
<h2>Help!</h2>
<h3 style="padding: 5px 60px 5px 60px;">Here you will find all the necessary help about using this annotation system.</h3>

<article>
<h3>Requirements</h3>
<p>Please use the latest version of your web browsers! Google Chrome and Mozilla Firefox are recommended for the best viewing experience of this website.</p>
<p>Please make sure that Javascripts are enabled in your web browser. To find about more about how to enable Javascripts, please see the Help section of your web browser</p>
</article>

<article>
<h3>User Registration</h3>
<p>User registration is not mandatory but is highly recommended for the best user experience. We use an user-friendly, hassle-free and quick user registration system.</p>
<p>As is obvious, creating a user profile has its perks:
        <ul>
                <li>You can vote on the annotations that you are viewing! If you like an annotation, just click up-vote, else click down-vote.</li>
                <li>You can edit the annotations that you are viewing! Don't like an annotation? Simply edit it to make it a more valuable knowledge resource.</li>
        </ul>  
</p>
</article>

<article>
<h3>Adding Annotations</h3>
<p>Anyone can add and view annotations! You do not need to "Sign Up" to add or view annotations only.</p>
<p>Simply drag and select across any text range and a pop-up will appear requesting you to add your new annotation corresponding to that text.</p>
<p>Multiple annotations can be added for one particular range of text.</p>
</article>

<article>
<h3>Votes</h3>
<p>Every annotation can be voted positively or negatively, i.e., it can be 'liked' or 'disliked'.</p>
<p>Annotations receiving higher votes will appear at the top of the list in the right-side viewing panel.</p>
</article>

<article>
<h3>Edits</h3>
<p>Unsatisfactory or malicious annotations can be edited at ease. However, we keep a log of the user and the content that is being posted at our portal.</p>
<p>Editing an annotation updates it directly. Watchers will receive a notification about it too.</p>
</article>

<article>
<h3>Watchers</h3>
<p>Inspired by the concept of decentralised administration, we have deployed a Watch system. Watchers can decide to keep an eye over the quality of the annotations added to their favourite portions of the page.</p>
<p>When logged in and adding a new annotation, your annotation will be provided with an additional "WATCH" button. On clicking this "WATCH" button (Unsigned users will be requested an email id) will be sent notifications via email about changes occurring to that annotation.</p>
</article>

<article>
<h3>The Codes!</h3>
<p>Wanna take look at our codes? Visit the link below:</p>
<p> <a href="https://code.google.com/p/crowdsourced-textbook/source/browse/trunk/">https://code.google.com/p/crowdsourced-textbook/source/browse/trunk/</a></p>
</article>

<br><br>
<div id="start_anno"><a href="main.php">Start Annotating Now!</a></div>
<br><br>
</div>

<a href="#" class="back-to-top">Back to Top</a>
<?php include 'footer.php';?>
</body>
</html>

