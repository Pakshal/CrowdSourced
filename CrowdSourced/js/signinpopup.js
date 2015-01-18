function post()
{
      var username=$('#username').val();
      var password=$('#password').val();
      //var redir=document.referrer;

                  

      $.post('validate.php',{postname:username,pass:password},
          function(data)
          {
              if(data=="0")
              {
                  $('#result').html("The email or password you entered is incorrect.");
                            
              }
              else if(data==2)
              {
                  $('#result').html("Your account is not activated..please check your email and verify");
              }
              else
              {
                 window.location.href=document.URL;
                 //stay in same page after logging in
                
              }

          });
  }
            

    