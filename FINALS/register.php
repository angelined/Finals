<?php
if (isset($_POST['btn_Submit'])) {
    include_once 'DBConnect.php';
    
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $database = new dbConnect();
    
    $db = $database->openConnection();
    $sql1 = "select name, email from registration where email='$email'";
    
    $user = $db->query($sql1);
    $result = $user->fetchAll();
    $_SESSION['email'] = $result[0]['email'];
    
    if (empty($result)) {
        $sql = "insert into registration values (?,?,?) values('$username','$email','$password')";
        
        $db->exec($sql);
        
        $database->closeConnection();
        $response = array(
            "type" => "success",
            "message" => "You have registered successfully.<br/><a href='CreateNew.php'>Now Login</a>."
        );
    } else {
        $response = array(
            "type" => "error",
            "message" => "Email already in use."
        );
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
<!--        <link href = "Progtable/Connection+BookStore+Logo.jpg" rel="icon" type="image/jpg">-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="register.css">   
        
        <script>
    function signupvalidation(){
        var username = document.getElementById('username').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var confirm_pasword = document.getElementById('confirm_pasword').value;
        var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    	
        var valid=true;

        if(username == ""){
            valid = false;
            document.getElementById('username_error').innerHTML = "required.";
        }

        if(email == ""){
            valid = false;
            document.getElementById('email_error').innerHTML = "required.";
        } else {
            if(!emailRegex.test(email)){
                valid = false;
                document.getElementById('email_error').innerHTML = "invalid.";
            }
        }

        if(password == "" ){
            valid = false;
            document.getElementById('password_error').innerHTML = "required.";
        }
        if(confirm_pasword == "" ){
            valid = false;
            document.getElementById('confirm_password_error').innerHTML = "required.";
        }

        if(password != confirm_pasword){
            valid = false;
            document.getElementById('confirm_password_error').innerHTML = "Both passwords must be same.";
        }

        return valid;
    }
    </script>
    </head>
    <body>   
        <div class="whitespace">
            
            <div class="ws">
        <?php
        if (! empty($response)) {
            ?>
        <div id="response" class="<?php echo $response["type"]; ?>"><?php echo $response["message"]; ?></div>
        <?php
        }
        ?>
            
            
            <fieldset>
                <legend>Registration</legend>
                <form method="post" action="" onsubmit="return signupvalidation()">
                    
                 
                    <span id="username_error"></span>
                    <input type="text" name="username" placeholder="Enter your Username" id="username">
                    
                    <span id="email_error"></span>
                    <input type="email" name="email" placeholder="Enter your Email" id="email">

                    <span id="password_error"></span>
                    <input type="Password"  name="password" placeholder="Password" id="password">
                    
                    <span id="confirm_password_error"></span>
                    <input type="Password"  name="confirm_password" placeholder="Confirm Password" id="confirm_password">
                    
                    <p>
                        Already a member? <a href="CreateNew.php"> Sign in</a>
                    </p>
                    <br>
                    <p>
                        <a href='bookHTML.html'>HOMEPAGE</a>
                    </p>
                    </fieldset>

                    <input type="submit" value="Submit">
                    </form>
                </div>
