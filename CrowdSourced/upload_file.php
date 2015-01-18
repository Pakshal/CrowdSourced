<?php
/* uploaded file is stored in the articles folder and
file name is stored in the articles database with the description */

// Where the file is going to be placed 
$allowedExts = array("html", "htm");
$temp = explode(".", $_FILES["uploadedfile"]["name"]);
$extension = end($temp);
$name_without_extension=$temp[0];

if (in_array($extension, $allowedExts)) 
{
  if ($_FILES["uploadedfile"]["error"] > 0) 
  {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  } 
  else {
    //echo "Upload: " . $_FILES["uploadedfile"]["name"] . "<br>";
    //echo "Type: " . $_FILES["uploadedfile"]["type"] . "<br>";
    //echo "Size: " . ($_FILES["uploadedfile"]["size"] / 1024) . " kB<br>";
    //echo "Temp file: " . $_FILES["uploadedfile"]["tmp_name"] . "<br>";
    if (file_exists("articles/".$_FILES["uploadedfile"]["name"])) 
	  {
      //echo $_FILES["uploadedfile"]["name"] . " already exists. ";
      echo '<meta http-equiv="refresh" content="8;url=choose_or_upload.php ">';
      echo '<center><b>File name already exists..<br>redirecting to selection page in few seconds....</b>';
    } 
	 else 
	 {
      move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], "articles/".$_FILES["uploadedfile"]["name"]);
	    include 'dbconnect.inc.php';
		  mysqli_query($link,"insert into articles values('$name_without_extension','$_POST[file_desc]')");
	    mysqli_close($link);
      //echo "Stored in: " . "articles/" . $_FILES["uploadedfile"]["name"];
      echo '<meta http-equiv="refresh" content="8;url=choose_or_upload.php ">';
      echo '<center><b>File uploaded successfully<br>redirecting to selection page in few seconds....</b>';
    }
  }
} 
else 
{
  echo '<meta http-equiv="refresh" content="8;url=choose_or_upload.php ">';
      echo '<center><b>Invalid File..Please upload html files only<br>redirecting to selection page in few seconds....</b>';
}
?>