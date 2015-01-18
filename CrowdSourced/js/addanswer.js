function postanswer(ob)
{
      var annotationid=ob.name;
      //alert(annotationid);
      var answer=$('#textarea'+annotationid).val();
      //alert(answer);
    
      if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
      } 
      else 
      { 
            // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function() {
    
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
     }
 }
 
 xmlhttp.open("GET","answers.php?annotationid="+annotationid+"&answers="+answer,true);
 xmlhttp.send();


}      