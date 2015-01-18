<?php
//if the logged in user is admin then only display the delete and revert button
//deletadmin and revertadmin functions are in admin.js
if(isset($_SESSION['emaild']) && $_SESSION['emaild']=='admin@admin.com')
{
	echo '<input type="button" id="'.$id.'" name="'.$id.'"  value="delete" onclick="deleteadmin(this);">';
	echo '<input type="button" id="'.$id.'" name="'.$id.'"  value="Revert" onclick="revertadmin(this);">';

}

?>
