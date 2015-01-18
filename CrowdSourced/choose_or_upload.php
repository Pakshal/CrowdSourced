<!-- choosing an article to annotate and uploading a html file option has been
	provided in this page-->

<!DOCTYPE html>
<html lang='en'>
<?php
if (!isset($_SESSION)) {
  session_start();
}
?>

<?php

    include 'dbconnect.inc.php';
    $result=mysqli_query($link,"select articlename from articles") or die(mysqli_error($link));
    $i=0;
    //putting all the distinct articles in the $store_article array
    //its done bcoz to populate the dropdown automatically when the database is updated
    while($row=mysqli_fetch_array($result)) 
    {
        $store_article[$i]=$row['articlename'];
        $i++;
    }
    mysqli_close($link);

?>

<head>
<meta charset='utf-8' />
<link rel="stylesheet" href="css/topribbon.css">
<script type="text/javascript" src="js/signinpopup.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/backtotop.js"></script>
<script type="text/javascript" src="js/select_article.js"></script>

</head>
<style>
#wrapper
{
	background:white;
    margin:3%;
	-moz-box-shadow:0 0 10px rgba(0,0,0,0.4);
	-webkit-box-shadow: 0 0 10px rgba(0,0,0,0.4);
	box-shadow:0 0 10px rgba(0,0,0,0.4);					
}
#upload{
	margin-left: 3%;
	padding: 3%;
}
#choose_article
{
	margin-left: 3%;
	padding: 3%;
}

</style>
	<script>
			//checking the extension of the files
			function validate_file()
			{
				
				var filename = document.forms["upload_article"]["uploadedfile"].value;
				
				var extension = filename.split('.').pop();
				alert(extension);
				
				
				if(extension!="html" && extension!="htm")
				{
					alert("please upload html files only");
					return false;	
				}
				
			}
		</script>


<body>
	
	<?php include 'header.php'; ?>
	<div id="wrapper">
		<div id="choose_article">
				<h4>Choose an article to annotate</h4>
				<select onchange="do_this(this.value);">
                    <option value="">select</option>
                    <?php
                        
                        //putting all the articles from the array to dropdown list
                        foreach($store_article as $col)
                        {
                            echo '<option value="'.$col.'">'.$col.'</option>';    
                        }

                    ?>
                </select>
		</div>	
		<hr>
		<div id="upload">
		<!-- providing upload file option -->
		<form name="upload_article" enctype="multipart/form-data" action="upload_file.php" method="POST">
			
			<h4>Choose a file to upload:</h4>
			
			<input name="uploadedfile" type="file" /><br><br>
			
			
			Enter the file description:
			<br>
			<input type="hidden" name="MAX_FILE_SIZE" value="10000" />
			<textarea name="file_desc" cols="47" rows="5"></textarea>
			<br><br>
			<input type="submit" value="Upload File" onclick="return validate_file();"/>
			
		</form>
		</div>
	
		

	</div>
<a href="#" class="back-to-top">Back to Top</a>

<?php include 'footer.php';?>
</body>
</html>