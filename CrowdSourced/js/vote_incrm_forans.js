function voteincrementans(th)
{
var id=th.name;
//alert(id);
var res = id.split("s");
//alert(res[0]);
//alert(res[1]);

//getting the value up or down based on the button press
var val=th.value;

$.post('incrmvoteans.php',{annotationid:res[0],ansid:res[1],value:val},
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

return false;	
}