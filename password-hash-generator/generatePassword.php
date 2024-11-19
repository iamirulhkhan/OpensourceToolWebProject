<?php
 if(isset($_POST['password']) && $_POST['password']!=''){
     $pass = $_POST['password'];
     $password = password_hash($pass,PASSWORD_DEFAULT);
     echo json_encode(array('status'=>true, 'password'=>$password,'textpass' =>$pass));
 }else{
     echo json_encode(array('status'=>false, 'password'=>null));
     
 }
 
 
 
?>