#!/usr/bin/php

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Login</title>
            <link rel="stylesheet"  href="register.css" >
            <script defer src="registerpage.js"></script>
</head>
<body>
    <div class="registerForm" id="registerForm">
        <form>
                <h2><b>REGISTER</b></h2>
                <div class = "inputBox">
                    <br><label style="color: lightskyblue;"> Username </label>
                    <label style="color:red;">* </label>
                    <input type="text" name="" required="required" placeholder="Enter Your Name">   
                </div>
                <div class = "inputBox">
                    <br><label style="color: lightskyblue;"> Password </label>
                    <label style="color:red;">* </label>
                    <input type="password" name="" required="required" placeholder="Enter Your Password">   
                </div>
                <br><input type="submit" id ="loginSubmit" name="" value="REGISTER" style="color: white;"> 

        </form>
    </div>

</body>
 

    
</html>
