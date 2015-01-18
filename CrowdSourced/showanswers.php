<?php
/* similar to show_annotation procedure
here the answers are displayed on the right panel
with all the options such as edit,vote and the gif image
and information of the author and editor of the answer*/

  $res=mysqli_query($link,"select * from qanswer where annoid='$id' order by votes desc");
  		if(mysqli_num_rows($res)>0)
  		{
          while($ans=mysqli_fetch_array($res))
          {
          $ansid=$ans['ansid'];
          $id1=$id.'s'.$ansid;
          echo '<div id="annotationpanel'.$id1.'" class="annotationpanel">';
          echo $ans['answer'];
          echo '</div>';
          echo '<div id="votepanel">';
           echo '<form name="voteform">';
      
          $voteresult=mysqli_query($link,"select * from ansvotes where id='$id' and user='$user' and ansid='$ansid'");
          $votenumrows=mysqli_num_rows($voteresult);
          $voterow=mysqli_fetch_array($voteresult);

      		//adding code for gif image
          if($votenumrows==0||$voterow['votetype']==5)
            echo '<img src="static/hand_new.gif" id="hideimg'.$id1.'"  width="59px">';
            else
            echo '<img src="static/hand_new.gif" id="hideimg'.$id1.'"  width="59px" style="display:none;">';


      
            if($voterow['votetype']==1 && $votenumrows>0 && isset($_SESSION['emaild']))
            {
              echo '<input type="image"  name="'.$id1.'" value="up" src="static/up.jpg" height="25px" width="25px" style="vertical-align:middle;" ';
              include 'alertans.php';
              echo '><br>';
            }
            else
            {
              echo '<input type="image" name="'.$id1.'" value="up" src="static/up.jpg" height="20px" width="20px" style="vertical-align:middle;" ';
              include 'alertans.php';   
              echo '><br>';
            }
             $reslt=mysqli_query($link,"select * from qanswer where annoid='$id' and ansid='$ansid'");
            $row=mysqli_fetch_array($reslt);
            echo '<div id="current_vote'.$id1.'">&nbsp;'.$row['votes'].'</div>';
            if($voterow['votetype']==0 && $votenumrows>0 && isset($_SESSION['emaild']))
            { 
              echo '<input type="image" name="'.$id1.'" value="down" src="static/down.jpg" height="25px" width="25px" style="vertical-align:middle;" ';
              include 'alertans.php';  
              echo '><br>';
          
            }
            else
            {
              echo '<input type="image" name="'.$id1.'" value="down" src="static/down.jpg" height="20px" width="20px style="vertical-align:middle;" ';
              include 'alertans.php';
              echo '><br>';
            }
              $pdate=$row['date'];
              //storing date in dd-mm-yyyy format
              $date=date("jS F Y", strtotime($pdate));

            echo '<input  type="hidden" name="hide" value="'.$id1.'"> 
              </form>
              </div>
              <form class="hiden'.$id1.'" id="sform" style="display:none;">
              <textarea class="txtarea" name="edit" id="'.$id1.'">'.$row['answer'].'</textarea>
            
              <br><input type="submit" name="'.$id1.'"  value="submit" onclick="return dbupdateans(this);">
              <input type="button" name="'.$id1.'" id="closeform" value="cancel" onclick="cancelactionans(this);">
              </form>
              <br><input type="button" id="open'.$id1.'" name="'.$id1.'"  value="edit" style="margin-left:10px;" ';
              include 'editalertans.php';
              echo '>';
             
              //revert and delete option is given in edit log
              //so the below code is commented
             /* if(isset($_SESSION['emaild']) && $_SESSION['emaild']=='admin@admin.com')
              {
                echo '<input type="button" id="'.$id1.'" name="'.$id1.'"  value="deleteans" onclick="delans(this);">';
                echo '<input type="button" id="'.$id1.'" name="'.$id1.'"  value="Revertans" onclick="revertans(this);">';

              }*/
              
              $auth=explode("@",$row['user']);
              $author=$auth[0];
              
              echo '<br><div id="annotation_property">Answered by '.$author.' on '.$date;
             	echo "<br>";
              $edits_query = mysqli_query($link,"select distinct user from edit_logans where annoid='$id' and ansid='$ansid'" );
              
              if(mysqli_num_rows($edits_query)>1)
              { 
                 	$ctr=1; 
                 	//$ctr is used to not print the name of the creator of the annotation
                  echo '<br>Edited by ';
                  while($editors = mysqli_fetch_array($edits_query)){
                  if($ctr!=1)
                  {
                     $editorname = explode("@",$editors['user']);
                      echo $editorname[0].', ';
                	}
                  $ctr++;
              }
              echo '.';
              }
             	echo '</div>';
          }
      }
     