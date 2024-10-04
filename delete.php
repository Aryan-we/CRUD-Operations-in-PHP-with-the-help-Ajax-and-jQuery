<?php
include("connection.php");
$id=$_POST["id"];
$query="delete from form where id='$id'";
$result=mysqli_query($connect,$query);

    if($result){
        echo 1;
    }else{
        echo 0;
    }

?>