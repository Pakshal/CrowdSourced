
//function for hiding all the form(edit textarea) initially
/*
function hideform(id)
{
	//this is jquery code for hiding all the edit textareas initially
	$(document).ready(function(){
	  $(".hiden"+id).hide();
	});
	alert(id);
}*/

//opens the textarea of the particular annotation and hides the edit button corresponding to it
function edit(thiss)
{

	
	var id=thiss.name;
	$(document).ready(function(){
	$("#open"+id).hide();	//hiding the edit button
	$(".hiden"+id).show();  //displaying the form
    });
  

	
} 

//called when the add answer button is pressed
function f(object)
{
	var i=object.name;
	alert(i);
	document.getElementById('fade2'+i).style.display = 'block';
	document.getElementById('light2'+i).style.display = 'block';

}

//called when the cancel button is pressed in the popup appeared after clicking answer button
function c(object)
{
	var i=object.name;
	alert(i);
	document.getElementById('fade2'+i).style.display = 'none';
	document.getElementById('light2'+i).style.display = 'none';

}



// called when the cancel button is pressed in the suggest edit form
function cancelaction(th)
{
	var i=th.name;
	$(document).ready(function(){
		$(".hiden"+i).hide(); //hiding the edit textarea 
		$("#open"+i).show(); // displaying the edit button 
	});
}


//called when the submit button is pressed in the edit form displayed after pressing the edit button
function dbupdate(the)
{
	 var hid = the.name;//getting the id of the annotation
	 //getting the edited value for updating the databse
	 var evalue=document.getElementById(hid).value;


	 

	 //sending annotation id and edited value to the edit.php to update in the database
	 $.post('edit.php',{hiddenid:hid,edit:evalue},//jquery code to update annotations in the content table
		function(data)
		{
			$('#annotationpanel'+hid).html(""+data);
			
		});
	 //calling cancelfunction to hide the edit form 
	 cancelaction(the);
	 
	 return false;
}


