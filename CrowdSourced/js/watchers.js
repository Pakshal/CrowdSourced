
//called from alertforwatch.php in else condition
function insertwatchers(thi)
{
	var id=thi.name; //getting the id of the text

	//sending id to watchers.php 
	//printed value in watchers.php will be accessed by variable data below
	$.post('watchers.php',{watch:id},
		function(data)
		{
			alert(""+data);
			
		});
	//return false;
}