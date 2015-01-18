function do_this(articlename)
{
        if(articlename=="null" || articlename=="")
        {
            alert("please select any article");
            return;
        }
        //sending selected article name to main.php
        window.location.href = "main.php?article="+articlename;
}

