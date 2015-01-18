<!-- displays the annotations on the right panel.
 annotation with highest no. of votes will be displayed first(decreasing order)
vote button,edit button,add answer option for all the questions
annotation author and also the name of the editors just below the author name
-->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/base_annotator.js"></script>
<script type="text/javascript" src="js/signinpopup.js"></script>
<script type="text/javascript" src="js/alertnotsigned.js"></script>
<script type="text/javascript" src="js/suggestedit.js"></script>
<script type="text/javascript" src="js/watchers.js"></script>
<script type="text/javascript" src="js/admin.js"></script>
<script type="text/javascript" src="js/addanswer.js"></script>
<script type="text/javascript" src="js/suggesteditans.js"></script>
<script type="text/javascript" src="js/vote_incrm_forans.js"></script>



<?php
//connecting to database

require 'dbconnect.inc.php';

//if session is set store the id array in $b which is used to get all the annotations in the right panel
if(isset($_SESSION['id'])){

  $b=$_SESSION['id'];  
}
else
{
  $_SESSION['id']=null;
  $b=$_SESSION['id'];
}


//if session emaild is set then user has logged in 
if(isset($_SESSION['emaild']))
{
  $user=$_SESSION['emaild'];
}
else
{
  $_SESSION['emaild']=null;
  $user=$_SESSION['emaild'];
}


$id=$b[0];
$start=-1;
$end=-1;


$reslt=mysqli_query($link,"select text from content where id='$id'");
$txt=mysqli_fetch_array($reslt);

if(mysqli_num_rows($reslt)==0) {
  echo '<div id="right_panel_text">';
  echo 'Click on a highlighted text portion to view its annotations! <br><br> Select a text range to add an annotation to it!';
  echo '</div>';
}

//display the annotations in the right panel one by one
for($j=0;$j<count($b);$j++)//count is php inbuilt function to get no of elements in an array
{
	  $id=$b[$j];
   
    $reslt=mysqli_query($link,"select * from content where id='$id'");
    $pos=mysqli_fetch_array($reslt);

    if($start!=$pos['spos'] || $end!=$pos['epos'])
    {
      echo '<div class="text_line"></div>';
      if($j!=0){
        echo '<hr>';
      }
      echo '<div id="right_panel_text">';
      //displaying the text on the right panel
      echo '" '.$pos['text'].'"';
      echo '</div>';
      // the watch button and add annotation buttons for the text
      echo '<form >
      
      <input type="button" name="'.$id.'" value="watch" style="margin-left:10px;"';
      include 'alertforwatch.php';  
      echo '></form><br>';
      $start=$pos['spos'];
      $end=$pos['epos'];
    }
    
      //showing ans button on all the questions
      //hiding the anser popup initially and displaying it
      //whenever the add answer button is clicked 
      //similar to the procedure of adding new annotation
      
      $s=substr($pos['annotation'],0,3);
      // $s has the annotation category
      //if the category is of the type [Q]
      //then only the add answer button will be displayed
      if($s=='[Q]')
      {
         echo '<input type="Button" name='.$id.' value="Add answer" onclick="f(this);">';
         echo '<div id="light2'.$id.'" class="white_content2"><br><center>
            <form id="answerform'.$id.'"><center><b>Add your answer</b></center><br>
                
                <textarea name="edit" rows="10" cols="50" id="textarea'.$id.'"></textarea><br>
                <input type="button" name="'.$id.'" value="Submit" onclick="postanswer(this);">

                <input type="button" value="Close" name='.$id.' onclick="c(this);">
            </form></center>      
                      
        </div>
        
                    
      <div id="fade2'.$id.'" class="black_overlay"></div>';
      }
    //-------------------------------------




      echo '<div class="text_line"></div>';
      
      echo '<div id="annotationpanel'.$id.'" class="annotationpanel">';
      //bcz if we edit, then value of only that particular annotation 
      //should appear in edit box
      echo $pos['annotation'];//printing the annotations 
      echo '</div>';
      echo '<div id="votepanel">';
      echo '<form name="voteform">';
      
      $voteresult=mysqli_query($link,"select * from votes where id='$id' and user='$user'");
      $votenumrows=mysqli_num_rows($voteresult);
      $voterow=mysqli_fetch_array($voteresult);

      //adding code for gif image
      if($votenumrows==0||$voterow['votetype']==5)//votetype=0 means he has downvoted, 1 means upvoted, 5 means vote is 0(could also be 
	   //voted up and then  down by the same voter)
    //if he has not voted, prompting hand image will be displayed o/w not
        echo '<img src="static/hand_new.gif" id="hideimg'.$id.'"  width="59px">';
     else
        echo '<img src="static/hand_new.gif" id="hideimg'.$id.'"  width="59px" style="display:none;">';


      
        if($voterow['votetype']==1 && $votenumrows>0 && isset($_SESSION['emaild']))//means he has upvoted once,increase the size of image 
	//for up vote 
        {
            echo '<input type="image"  name="'.$id.'" value="up" src="static/up.jpg" height="25px" width="25px" style="vertical-align:middle;" ';
            include 'alert.php';
            echo '><br>';
        }
        else
        {
            echo '<input type="image" name="'.$id.'" value="up" src="static/up.jpg" height="20px" width="20px" style="vertical-align:middle;" ';
            include 'alert.php';   
            echo '><br>';
        }
        $reslt=mysqli_query($link,"select * from content where id='$id'");
        $row=mysqli_fetch_array($reslt);
        echo '<div id="current_vote'.$id.'">&nbsp;'.$row['votes'].'</div>';//to display the votes between upvote and downvote image
        if($voterow['votetype']==0 && $votenumrows>0 && isset($_SESSION['emaild']))//increase the downvote image size
        { 
            echo '<input type="image" name="'.$id.'" value="down" src="static/down.jpg" height="25px" width="25px" style="vertical-align:middle;" ';
            include 'alert.php';  
            echo '><br>';
  		    
        }
        else
        {
  	    echo '<input type="image" name="'.$id.'" value="down" src="static/down.jpg" height="20px" width="20px style="vertical-align:middle;" ';
            include 'alert.php';
            echo '><br>';
        }


      
        $date=$row['date']; 
        
        $date=date("jS F Y h:i:s A", strtotime($date));//edit textarea will be hidden initially
	
//dbupdate and cancelaction functions are in suggestedit.js making use of jquery to hide and show certain things
      echo '<input  type="hidden" name="hide" value="'.$id.'">
      		</form>
      		</div>
            <form class="hiden'.$id.'" id="sform" style="display:none;">
            <textarea class="txtarea" name="edit" id="'.$id.'">'.$row['annotation'].'</textarea>
            
            <br><input type="submit" name="'.$id.'"  value="submit" onclick="return dbupdate(this);">
            <input type="button" name="'.$id.'" id="closeform" value="cancel" onclick="cancelaction(this);">
            </form>
            <br><input type="button" id="open'.$id.'" name="'.$id.'"  value="edit" style="margin-left:10px;" ';
            include 'editalert.php';
            echo '>';
            //include 'adminbt.inc.php';//used for including the delete and revert button if admin has logged in
            $auth=explode("@",$row['user']);
            $author=$auth[0];

        //displaying author name and date on which annotation was created     
	echo '<br><div id="annotation_property"> Created by '.$author.' on '.$date;

            $edits_query = mysqli_query($link,"select distinct user from edit_log where annoid='$id'" );
            if(mysqli_num_rows($edits_query)>1)
            {
                 $ctr=1; //$ctr is used to not print the name of the creator of the annotation
                  echo '<br>Edited by ';
                  while($editors = mysqli_fetch_array($edits_query)){
                  if($ctr!=1){
                     $editorname = explode("@",$editors['user']);
                      echo $editorname[0].', ';
                  }
                  $ctr++;
                }
              echo '.';
            }


             echo '</div>';

             include 'showanswers.php';




}
mysqli_close($link);
?>
