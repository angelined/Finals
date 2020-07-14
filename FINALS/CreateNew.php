<?php
session_start();
if (isset($_POST['btn_Submit'])) {
    include_once 'DBConnect.php';
    
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $database = new dbConnect();
    
    $db = $database->openConnection();
    
    $sql = "select * from registration where email = '$email' and password= '$password'";
    $user = $db->query($sql);
    $result = $user->fetchAll(PDO::FETCH_ASSOC);
    
    $id = $result[0]['id'];
    $name = $result[0]['name'];
    $email = $result[0]['email'];
    $_SESSION['name'] = $name;
    $_SESSION['id'] = $id;
    
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link href = "Progtable/Connection+BookStore+Logo.jpg" rel="icon" type="image/jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script>
    function loginvalidation(){
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;

        var valid = true;

        if(username == ""){
        	   valid = false;
            document.getElementById('username_error').innerHTML = "required.";
        }

        if(password == ""){
        	   valid = false;
            document.getElementById('password_error').innerHTML = "required.";
        }
        return valid;
    }
    </script>
    </head>
    <body>   
        <style type="text/css">         

            div.whitespace {
                border-radius: 5px;
                background-color:#f2f2f2;
                padding: 20px;
                height: 390px;
                width: 520px;
                position: absolute;
                margin-left: 450px;
                margin-top: 50px;
                
                
            }

            input[type=text] {
                width: 350px;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            input[type=password] {
                width: 350px;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            input[type=submit] {
                width: 100%;
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type=submit]:hover {
                background-color: #45a049;
            }



            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: black;
                text-align: center;
                font-size: 20px;

            }


            li {
                float: left;
            }

            li a {
                display: block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            li a:hover {
                background-color: black;
            }
            
            .ws {
                padding: 30px 60px;
                background-color: #fff2e6;
                border: #efe3d8 1px solid;
                display: inline-block;
            }

        </style>
        </head>
    <body>
        <div class="whitespace">
            <div class="ws">

            <fieldset>
                <legend>Log in</legend>
                <form action="" onsubmit="return loginvalidation();">

                    <input type="text" name="username" placeholder="Enter your Username" class="form-control">
                    
                    <input type="Password"  name="password" placeholder="Password" class="form-control">     
                    
                    <p>
                        No account yet? <a href="register.php"> Create New</a>
                    </p>
                    <br>
                     <p>
                        <a href='bookHTML.html'>HOMEPAGE</a>
                    </p>
                    </fieldset>

                    <input type="submit" value="Log in">
                    </form>
                </div>