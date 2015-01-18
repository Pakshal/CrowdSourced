<?php  
 // Connect and query the database for the users 
   
// Pick a filename and destination directory for the file 
// Remember that the folder where you want to write the file has to be writable $filename = "/tmp/db_user_export_".time().".csv";   
$datestamp=date('Y-m-d-H-i-s');
//Creating a directory

$name="backup".$datestamp;   //name is the directory
mkdir("$name");

include 'dbconnect.inc.php';

//Querying for ansvotes table
$result=mysqli_query($link,"select * from ansvotes") or die("database error");
$filename = $name."/ansvotes.csv";   

// Actually create the file 
// The w+ parameter will wipe out and overwrite any existing file with the same name 

$handle = fopen($filename, 'w+');   
// Write the spreadsheet column titles / labels 
fputcsv($handle, array('id','ansid','user','votetype'));   
// Write all the user records to the spreadsheet 

foreach($result as $row)
{ 
	
	fputcsv($handle, array($row['id'], $row['ansid'],$row['user'],$row['votetype'])) or die("nono"); 
}   
// Finish writing the file 
fclose($handle);
//Backup article table
$result=mysqli_query($link,"select * from articles");
echo mysqli_num_rows($result);
$filename = $name."/articles.csv";   

// Actually create the file 
// The w+ parameter will wipe out and overwrite any existing file with the same name 

$handle = fopen($filename, 'w+');   
// Write the spreadsheet column titles / labels 
fputcsv($handle, array('articlename','description'));   
// Write all the user records to the spreadsheet 
while($row=mysqli_fetch_array($result)) 
{ 
	echo $row['articlename'];
	echo 'jamesh kat suuba \n';
	fputcsv($handle, array($row['articlename'], $row['description'])); 
}   
// Finish writing the file 
fclose($handle);

/*
///////////////////content table ///////////////////
$result=mysqli_query($link,"select * from content");

$filename = $name."/content.csv";   

// Actually create the file 
// The w+ parameter will wipe out and overwrite any existing file with the same name 

$handle = fopen($filename, 'w+');   
// Write the spreadsheet column titles / labels 
fputcsv($handle, array('id','text','annotation','votes','date','spos','epos','user'));   
// Write all the user records to the spreadsheet 
foreach($result as $row) 
{ 
	fputcsv($handle, array($row['id'], $row['text'],$row['annotation'],$row['votes'],$row['date'],$row['spos'],$row['epos'],$row['user'])); 
}   
// Finish writing the file 
fclose($handle);   

////////////credential table///////////////////////
$result=mysqli_query($link,"select * from credential");

$filename = $name."/credential.csv";   

// Actually create the file 
// The w+ parameter will wipe out and overwrite any existing file with the same name 

$handle = fopen($filename, 'w+');   
// Write the spreadsheet column titles / labels 
fputcsv($handle, array('firstname','lastname','emailid','profession','password','status','Ekey'));   
// Write all the user records to the spreadsheet 
foreach($result as $row) 
{ 
	fputcsv($handle, array($row['firstname'], $row['lastname'],$row['emailid'],$row['profession'],$row['password'],$row['status'],$row['Ekey']));  
}   
// Finish writing the file 
fclose($handle);

///////////edit_log table /////////////////////////////

$result=mysqli_query($link,"select * from edit_log");

$filename = $name."/edit_log.csv";   

// Actually create the file 
// The w+ parameter will wipe out and overwrite any existing file with the same name 

$handle = fopen($filename, 'w+');   
// Write the spreadsheet column titles / labels 
fputcsv($handle, array('annoid','anno','user','datetime','votes'));   
// Write all the user records to the spreadsheet 
foreach($result as $row) 
{ 
	fputcsv($handle, array($row['annoid'], $row['anno'],$row['user'],$row['datetime'],$row['votes'])); 
}   
// Finish writing the file 
fclose($handle);

////////////////////edit_logans table ///////////////

$result=mysqli_query($link,"select * from edit_logans");

$filename = $name."/edit_logans.csv";   

// Actually create the file 
// The w+ parameter will wipe out and overwrite any existing file with the same name 

$handle = fopen($filename, 'w+');   
// Write the spreadsheet column titles / labels 
fputcsv($handle, array('annoid','ansid','ans','votes','user','datetime'));   
// Write all the user records to the spreadsheet 
foreach($result as $row) 
{ 
	fputcsv($handle, array($row['annoid'], $row['ansid'],$row['ans'],$row['votes'],$row['user'],$row['datetime'])); 
}   
// Finish writing the file 
fclose($handle);

//////////////// LeaderBoard ////////////////////////
$result=mysqli_query($link,"select * from leaderboard");

$filename = $name."/leaderboard.csv";   

// Actually create the file 
// The w+ parameter will wipe out and overwrite any existing file with the same name 

$handle = fopen($filename, 'w+');   
// Write the spreadsheet column titles / labels 
fputcsv($handle, array('emailid','article','points'));   
// Write all the user records to the spreadsheet 
foreach($result as $row) 
{ 
	fputcsv($handle, array($row['emailid'], $row['article'],$row['points'])); 
}   
// Finish writing the file 
fclose($handle);

//////////////plus_login table //////////////////////
$result=mysqli_query($link,"select * from plus_login");

$filename = $name."/plus_login.csv";   

// Actually create the file 
// The w+ parameter will wipe out and overwrite any existing file with the same name 

$handle = fopen($filename, 'w+');   
// Write the spreadsheet column titles / labels 
fputcsv($handle, array('sessionid','emailid','ip','tm','status'));   
// Write all the user records to the spreadsheet 
foreach($result as $row) 
{ 
	fputcsv($handle, array($row['sessionid'], $row['emailid'],$row['ip'],$row['tm'],$row['status'])); 
}   
// Finish writing the file 
fclose($handle);

/////////  qanswer table ///////////////
$result=mysqli_query($link,"select * from qanswer");

$filename = $name."/qanswer.csv";   

// Actually create the file 
// The w+ parameter will wipe out and overwrite any existing file with the same name 

$handle = fopen($filename, 'w+');   
// Write the spreadsheet column titles / labels 
fputcsv($handle, array('annoid','ansid','votes','date','user'));   
// Write all the user records to the spreadsheet 
foreach($result as $row) 
{ 
	fputcsv($handle, array($row['annoid'], $row['ansid'],$row['votes'],$row['date'],$row['user'])); 
}   
// Finish writing the file 
fclose($handle);


////////////votes table ////////////////
$result=mysqli_query($link,"select * from votes");

$filename = $name."/votes.csv";   

// Actually create the file 
// The w+ parameter will wipe out and overwrite any existing file with the same name 

$handle = fopen($filename, 'w+');   
// Write the spreadsheet column titles / labels 
fputcsv($handle, array('id','user','votetype'));   
// Write all the user records to the spreadsheet 
foreach($result as $row) 
{ 
	fputcsv($handle, array($row['id'], $row['user'],$row['votetype'])); 
}   
// Finish writing the file 
fclose($handle);

////////////// watchers table /////////////
$result=mysqli_query($link,"select * from watchers");

$filename = $name."/watchers.csv";   

// Actually create the file 
// The w+ parameter will wipe out and overwrite any existing file with the same name 

$handle = fopen($filename, 'w+');   
// Write the spreadsheet column titles / labels 
fputcsv($handle, array('fid','emailid'));   
// Write all the user records to the spreadsheet 
foreach($result as $row) 
{ 
	fputcsv($handle, array($row['fid'], $row['emailid'])); 
}   
// Finish writing the file 
fclose($handle);


////////////////////////////////////////////
//zipping the folders

    $zipname = $name.'.zip';   //name of the zip file
    $zip = new ZipArchive;    //create a object for the ziparchive
    $zip->open($zipname, ZipArchive::CREATE);  
    if ($handle = opendir($name))  //open the directory whish has to be zipped 
    {
      
      while (false != ($entry = readdir($handle))) //read the folder 
      {
        if ($entry != "." && $entry != ".." ) //sometimes while reading it reads .. . so avoiding
        {   
            
            $zip->addFile($name."/".$entry);   //adding files to zip archieve
            //
            
        }
      }
      
     closedir($handle); 
    }

    $zip->close();
	header('Content-Type: application/zip');
    header("Content-Disposition: attachment; filename=".$zipname.'"');
    header('Content-Length: ' . filesize($zipname));
    header("Location: $zipname");  //locating to the zip folder to download files locally

*/
/////////////////


/////////////////////////////////////////////////////

?>
