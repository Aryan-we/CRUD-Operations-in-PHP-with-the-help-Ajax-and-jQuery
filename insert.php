<?php
include("connection.php");
  $username=$_POST["username"];
    $password=$_POST["password"];
    
    $query="insert into form(username,password) values('{$username}','{$password}')";
    if(!empty($username) and !empty("$password")){
        if(mysqli_query($connect,$query)){
            echo 1;
        }else{
            echo 0;
        }
    }else{
        echo 2;
    }

    


?>