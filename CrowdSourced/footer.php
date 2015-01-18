<!-- this file contains the all the elements that are in the footer(page views,
  license and also the file active_users.php) -->
<style>

#footer{
  
  
  background:url('static/footer.png');
  width:100%;
  clear:both;
  height:80px;

 }

#foot{
margin-left:3%;
width:60%;
float:left;
padding-top: 10px;
padding-bottom: 10px;


}
#counter{
width:25%;
float:left;
margin-left: 3%;
padding-top: 10px;


}



</style>



<div id="footer">
    <div id="foot">
    <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">
    <img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" />
    </a><br /><a style="color:white;">This work is licensed under a 
    <a rel="license" href="http://creativecommons.org/licenses/by/4.0/" style="color:white;">
    Creative Commons Attribution 4.0 International License</a>


    </div>
    <div id="counter">
        <div id="pagecounter">
        <a style="color:white">Total Pageviews</a><br><img src='http://www.websitecounterfree.com/c.php?d=4&id=10769&s=18' border='0'><br/>
      </div>
    </div>

    <br>



</div>
<?php include 'active_users.php'; ?>