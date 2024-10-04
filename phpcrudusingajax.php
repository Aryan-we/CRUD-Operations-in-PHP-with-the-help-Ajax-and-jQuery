<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Crud Operation using AJAX</title>
    <script src="../jquery.js"></script>
    <style>
        .container{
            width: 100%;
            text-align:center;
        }
    
        .container .login form input{
            padding :10px;
            border: 2px solid green;
            margin: 10px;
        }
        .container .login form button{
            background-color: red;
            color: white;
            border: none;

        } .container .login form button:hover{
            background-color: green;
            
        } 
        .container .data #display-table{
            margin-top:10px;
            background-image: linear-gradient(to left,pink, magenta, blue,yellow);
        }
        .container .data table td{
            padding: 20px;
            color:white;
            border-radius: 20px;
            font-size: 25px;
        }
        .container .data table th{
            padding: 20px;
        }
        .container .data table thead th{
            font-size: 30px;
            
        } 
        .container .data table tr td input,button{
            padding: 10px;
        }
        .delete-btn,.edit-btn{
            padding: 10px;
            font-size: 20px;
            border: 0px;
            background-color:red;
            cursor: pointer;
            color:white;
            border-radius: 10px;
        }
        .delete-btn:hover,.edit-btn:hover{
            background-color:blue;
            border-radius: 20px;
        }
        #modal{
            background-color:rgba(0,0,0,0.7);
            position: fixed;
            left:0px;
            top:0px;
            width: 100%;
            height: 100%;
            z-index:100px;
            display: none;
        }
        #modal-form{
            background-color: white;
            position: relative;
            top: 30%;
            width: 30%;
            left:calc(50% - 15%);
            padding: 15px;
            border-radius: 5px;
        }
        #modal-form table tr td{
            background-color: white;
            color: black;
        }

        #close-btn{
            background-color: red;
            color: white;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            position: absolute;
            top: -15px;
            right: -15px;
            cursor: pointer;
            border-radius: 50%;
        }
        h1{
            border: 0px solid black;
            width: 50%;
            margin-bottom: 3%;
            margin-left: auto;
            margin-right: auto;
            background-image: linear-gradient(to left,crimson,aqua,lime,wheat);
        }
       
    </style>
</head>
<body>
    <div class="container">
    <div class="login">
        <h1>ADD RECORDS</h1>
        <form action="#">
            <input type="text" placeholder="Username" id="username" required autocomplete="off">
            <input type="password" placeholder="Password" id="password" required>
            <button type="submit" id="btn">Submit</button>
        </form>
    </div>
    <div class="data">
        <h1>Display Records</h1>
        <table width="100%" bgcolor="red" id="display-table">
            <thead>
                <th>Username</th>
                <th>Password</th>
                <th>Delete</th>
                <th>Edit</th>
            </thead>
            <tbody id="data"></tbody>
        </table>
        <div id="modal">
            <div id="modal-form">
                <h2>Edit Form</h2>
                <table width="100%" cellpadding="0" id="edit-table">
                  <!--  <tr>
                        <td>User Name</td>
                        <td> <input type="text" id="edit-username"> </td></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td> <input type="text" id="edit-password"> </td></td>
                    </tr>
                    <tr><td> <input type="submit"  colspan="2" id="edit-submit" value="Save"> </td></tr>-->
                </table>
                <div id="close-btn">
                X
                </div>
            </div>
        </div>
    </div>

</div>
</body>
<script>
    $(document).ready(function(){
        $("#btn").click(function(e){
            e.preventDefault();
            let user=$("#username").val();
            let pass=$("#password").val();
            $.ajax({
            url:"./insert.php",
            data: {username:user,password:pass},
            type:"POST",
            success:function(data){
                if(data==1){
                    alert("Data Saved Successfully");
                    window.location="phpcrudusingajax.php";
                }else if(data==2){
                    alert("Please Fill the fields");
                }else if(data==0){
                    alert("Data Failed to Saved");
                }
            }
        })

        })
        
        $.ajax({
            url:"./fetch.php",
            type:"POST",
            success:function(data){
                $("#data").html(data);
               
            }
            
        })
            $(document).on("click",".delete-btn",function(){
                var userId=$(".delete-btn").data("id");
               // alert(userId);
               $.ajax({
                url:"./delete.php",
                data:{id : userId},
                type:"POST",
                success:function(data){
                    if(data==1){
                        alert("Record is Deleted Successfully");
                        window.location="phpcrudusingajax.php";
                        
                    }else{
                        alert("Record is not successfully Deleted");
                    } 
                }
               })
            })
            
            $(document).on("click",".edit-btn",function(){
                var userId=$(this).data("eid");
                $("#modal").show();
                $.ajax({
                    url: "./edit.php",
                    type: "POST",
                    data:{eid:userId},
                    success:function(data){
                        $("#edit-table").html(data);
                    }
                })
            })
            $(document).on("click","#edit-submit",function(){
                var name=$("#edit-username").val();
                var password=$("#edit-password").val();
                var id=$("#edit-id").val();
                
                $.ajax({
                    url: "./update_form.php",
                    type: "POST",
                    data:{id:id,name:name,password:password},
                    success:function(data){
                        //$("#edit-table").html(data);
                        if(data==1){
                            $("#modal").hide();
                            //alert("Record Updated Successfully");
                            window.location="phpcrudusingajax.php";
                        }else{
                            alert("Record Fialed to Update");
                        }
                    }
                })
            })
            $("#close-btn").click(function(){
                $("#modal").hide();
            })
        })
</script>
</html>