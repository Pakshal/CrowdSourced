<!-- includes all the elements in the page header such as home,help,about,
sign in ,signup and logo-->
<div id="page_header">
        
        <div id="logo">
        <img src="static/logo.png" width="250" height="90"/></div>

        <div id="links">
        <ul>
        <li><a href="index.php">Home</a></li>
                <li><a href="help.php">Help</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="choose_or_upload.php">Start Annotating</a></li>
            	<?php
                if ((isset($_SESSION)) && $_SESSION['emaild']=='admin@admin.com')
                {
                    echo '<li><a href="leaderboard.php">Leaderboard</a></li>';
                }
                ?>

                
        <?php
                include 'signinstatus.php';
        ?>
    <!--div page header and links are ended in signinstatus.php--> 
<style>
    select
    {
        color: black;
    }
</style>
