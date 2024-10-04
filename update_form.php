<?php
include("connection.php");
    $id=$_POST['id'];
    $name=$_POST['name'];
    $password=$_POST['password'];

    $query="update form set username='$name',password='$password' where id='$id'";
    $result=mysqli_query($connect,$query);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
        
    


?>