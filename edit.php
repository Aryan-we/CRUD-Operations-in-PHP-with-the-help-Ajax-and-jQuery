<?php
include("connection.php");
    $id=$_POST['eid'];
    $query="select * from form where id='$id'";
    $result=mysqli_query($connect,$query);
    $rows=mysqli_num_rows($result);
    if($rows>0){
        $output="";
       // $output.="<tbody width='100%'>";
        while($row=mysqli_fetch_assoc($result)){
            $output.="<tr>
                        <td>User Name</td>
                        <td> <input type='text' id='edit-username' value='{$row["username"]}'>
                        <input type='text' id='edit-id' hidden value='{$row["id"]}'></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td> <input type='text' id='edit-password' value='{$row["password"]}'> </td>
                    </tr>
                    <tr><td> <input type='submit'  colspan='2' id='edit-submit' value='Save'> </td></tr>";
        }
       // $output.="</tbody>";
        echo $output;
    }else{
        echo "";
    }
        
    


?>