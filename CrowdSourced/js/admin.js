function deleteadmin(objd)
{
	var id=objd.name;

	$.post('admindelete.php',{hiddenid:id},
		function(data)
		{
			window.location = "wikilog_edits.php";
			//$('#annotationpanel'+id).html(""+data);
			
		});
	
}
function revertadmin(objr)
{
	var id=objr.name;//getting the id of the annotation
	 //getting the edited value for updating the databse
	 
	 $.post('adminrevert.php',{hiddenid:id},
		function(data)
		{
			window.location = "wikilog_edits.php";
			//splitted_data=data.split("~");
			//$('#annotationpanel'+id).html(""+splitted_data[0]);//contains annotation
			//displaying the reverted annotation in the anntation panel
			//data has the value current anno(  echo $current_anno; which was in adminrevert.php) 
			//$('#current_vote'+id).html(" &nbsp "+splitted_data[1]);
			//splitted data[1] contains vote
		});
	
}



function deleteadminans(objd)
{
	var id=objd.name;

	$.post('admindeleteans.php',{hiddenid:id},
		function(data)
		{
			window.location = "wikilog_edits.php";
			//$('#annotationpanel'+id).html(""+data);
			
		});
	
}

function revertadminans(objr)
{
	var id=objr.name;//getting the id of the annotation
	 //getting the edited value for updating the databse
	 
	 $.post('adminrevertans.php',{hiddenid:id},
		function(data)
		{
			window.location = "wikilog_edits.php";
			//splitted_data=data.split("~");
			//$('#annotationpanel'+id).html(""+splitted_data[0]);//contains annotation
			//displaying the reverted annotation in the anntation panel
			//data has the value current anno(  echo $current_anno; which was in adminrevert.php) 
			//$('#current_vote'+id).html(" &nbsp "+splitted_data[1]);
			//splitted data[1] contains vote
		});
	
}
