
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 
    <title>Generate Hash Password</title>
  </head>
  <body>
   <div class="container mt-4 ">
       <div>
           <h3 class="text-success">This Is an  Automated Password generator Tool to generate password  also Generate Hash Password.</h3>
           <h3 class="text-info">We use password_hash() function and 'PASSWORD_DEFAULT' Algorithm to generate password hash in php.</h3>
           <h2 class="text-success">Enjoy It!</h2><br>
       </div>
       <div id="showpass"></div>
    
  <div class="mb-3 display-inline-block ">
    <label for="exampleInputEmail1" class="form-label">Enter your password or Generate Password</label>
    <input type="text" name="password" placeholder="Enter Your Password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  
  <a id="gentxt" onclick="genHash();" class="btn btn-primary text-white">Generate Hash Password</a>
  
  <a style="" onclick="genaratepassword();"  class="btn btn-success text-white">Generate Random Text Password</a>
   </div>
   

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

   
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.14/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    
     <script>
    function genHash(){
        var pass = document.getElementById("exampleInputEmail1").value;
        document.getElementById("gentxt").innerHTML='Generating Hash Password....';
         $.ajax({
                url:'generatePassword.php',
                type:'post',
                data:{
                    password:pass,
                    pass:123
                },
                success:function(result){
                    var obj=JSON.parse(result);
                    if(obj.status===true){
                        console.log(obj.textpass);
                        var hashpass = obj.password;
                        document.getElementById("showpass").innerHTML ='<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Hash Generated!</strong> '+hashpass+'<button onclick="copyText();" style="margin-left:50px; border-radius:4px; " class="btn btn-sm btn-success" >Copy</button><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><input type="hidden" id="hashid" value="'+hashpass+'"> ';
                        document.getElementById("gentxt").innerHTML='Generate Hash Again';
                    }else{
                        document.getElementById("showpass").innerHTML ='<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Hash Generated!</strong> Password Gereration Failed Please generate text Password before<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                        document.getElementById("gentxt").innerHTML='Generate Hash Again';
                    }
                }
            });
        }
    function genaratepassword(){
           var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
         var passwordLength = 12;
         var password = "";
         for (var i = 0; i <= passwordLength; i++) {
         var randomNumber = Math.floor(Math.random() * chars.length);
         password += chars.substring(randomNumber, randomNumber +1);
        }
           
        document.getElementById("exampleInputEmail1").value=password;
    }
        genaratepassword();
    
    function copyText(){
        var hashpass = document.getElementById("hashid");
     navigator.clipboard.writeText(hashpass.value);
      alert("Password Copied Success!");
    }

</script>
  </body>
</html>