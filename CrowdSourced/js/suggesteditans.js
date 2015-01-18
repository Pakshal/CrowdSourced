function editans(thiss)
{

	
	var id=thiss.name;
	//alert(id);
	$(document).ready(function(){
	$("#open"+id).hide();	//hiding the edit button
	$(".hiden"+id).show();  //displaying the form
    });
   // alert(id);

	
} 


// called when the cancel button is pressed in the suggest edit form
function cancelactionans(th)
{
	var i=th.name;
	//alert(i);
	$(document).ready(function(){
		$(".hiden"+i).hide(); //hiding the form
		$("#open"+i).show(); // displaying the edit button 
	});
}


//called when the submit button is pressed in the edit form displayed after pressing the edit button
function dbupdateans(the)
{
	 var hid = the.name;//getting the id of the annotation
	 //getting the edited value for updating the databse
	 //alert(hid);
	 var res = hid.split("s");
	 var evalue=document.getElementById(hid).value;
	 //alert(evalue);

	 

	 //sending annotation id and edited value to the edit.php to update in the database
	 $.post('editans.php',{annotationid:res[0],ansid:res[1],value:evalue},
	 //$.post('editans.php',{hiddenid:hid,edit:evalue},
		function(data)
		{
			$('#annotationpanel'+hid).html(""+data);
			
		});
	 //calling cancelfunction to hide the edit form 
	 cancelaction(the);
	 
	 return false;
}

