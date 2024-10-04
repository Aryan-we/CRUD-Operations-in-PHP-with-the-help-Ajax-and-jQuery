<?php
include("connection.php");
 // $username=$_POST["username"];
   // $password=$_POST["password"];
    $query="select * from form";
    $result=mysqli_query($connect,$query);
    $rows=mysqli_num_rows($result);
    if($rows>0){
        $output="";
       // $output.="<tbody width='100%'>";
        while($row=mysqli_fetch_assoc($result)){
            $output.="<tr>
                    <td>{$row["username"]}</td><td>{$row["password"]}</td>
                    <td><button class='delete-btn' data-id='{$row["id"]}'>Delete</button></td>
                    <td><button class='edit-btn' data-eid='{$row["id"]}'>Edit</button></td>
                </tr>";
        }
       // $output.="</tbody>";
        echo $output;
    }else{
        echo "";
    }
        
    


?>