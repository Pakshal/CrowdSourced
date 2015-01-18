function alertnotsigned(id)
{
	alert("please Sign In to continue");
	return false;
}


function voteincrement(th)
{
	
	//getting the id of the annotation
	var id=th.name;
	//getting the value up or down based on the button press
	var val=th.value;

	//sending the annotation id and value(up or down) to the to the incrmvote.php
	//$('#current_vote'+id).html(" &nbsp "+data); displays the incremented vote in the particular div where
	//the up or down key was pressed
	$.post('incrmvote.php',{annotationid:id,value:val},
		function(data)
		{
			//alert(data);
			var n = data.length;
			//alert(n);
			var x = data.charAt(n-1);
			
			if((x=='s'))
			{	
					
				data = data.slice(0, n-1);
				$('#current_vote'+id).html(" &nbsp "+data);
				document.getElementById("hideimg"+id).style.display='block';

			}
			else
			{
				$('#current_vote'+id).html(" &nbsp "+data);	
				document.getElementById("hideimg"+id).style.display='none';
			}


		});

	/*if(val=='up')
	{
		th.style.height="25px";
		th.style.width="25px";		
	}
	if(val=='down')
	{
		th.style.height="25px";
		th.style.width="25px";		
	}*/


	
	return false;
}
