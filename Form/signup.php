<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="header-style.css">
        <link rel="stylesheet" type="text/css" href="style_signup.css">
        <title>Sign Up / Login</title>
    </head>
    <body>
        <div class="bg-color">
        <div class="header">
            <div class="logo">
                <img class="logo-main" src="logo.PNG">
                </div>
            <div class="links">
            <a href="header-style.css" >Certificate Checker</a>
            <a href="header-style.css" >Contact Us</a>
            <a href="header-style.css" >Login / SignUp</a>
            <a href="header-style.css" >Quiz</a>
                <a href="header-style.css" >Home</a>
            
                </div>
                </div>
            </div>
        </div>
        <div class="hero">
            <div class="image-form-login">
            <div class="image-form-login-1"><img id="image-form-login-1"src="494641-PHESOO-113.jpg"> </div>
                <div class="image-form-login-2"><img  id="image-form-login-2"src="4957136.jpg"></div>
                </div>
            <div class="form-box">
                <div class="select-box">
                    <div id="btn"></div>
                    <button type="button" class="select-button"  id="log-button" onclick="login()">Login</button>
                    <button type="button" class="select-button" id="sign-button" onclick="signup()">Sign up</button>
                </div>
                <form class="login-form" id="Login-box" method="POST">
                    <label class="login-form-fields-label">Email Id </label>
                    <input type="email" class= "login-form-fields" name="email" required>
                    <span></span>
                    <label class="login-form-fields-label">Password </label>
                    <input type="password" class= "login-form-fields" name="password" required>
                    <span></span>
                    <button type="submit "class="submit-btn" name="login">Log In</button>
                    <button type="reset" class="reset-btn">Reset</button>
                </form>
               
                <form class="login-form" action="signup.php" method="POST" id= "Signup-box"> 
                
                    <label class="login-form-fields-label"> Full Name</label>
                    <input type="text" class= "login-form-fields" name="name" required>
                    <label class="login-form-fields-label">Email Id </label>
                    <input type="email" class= "login-form-fields" name="email" required>
                    <label class="login-form-fields-label">Password </label>
                    <input type="password" class= "login-form-fields" name="password" required>
                    <label class="login-form-fields-label">Confirm Password </label>
                    <input type="password" class= "login-form-fields" name="confirm_password" required  >
                  
                    <input type="checkbox" class="checkbox" required ><p id="Termsandcondition">I agree to the <a href=termsandcondition>Terms and conditions</a> </p>
                    <button type="submit "class="submit-btn" name="signup">Sign Up</button>
                    
                   
                </form>
            </div>
            <?php
                    if(isset($_POST['login']))
                    {
                        session_start();
                        $conn =  mysqli_connect("localhost","root","","register") or die(mysqli_error($conn));
                        $email=$_POST['email'];
                        $password=$_POST['password'];
                        $check_login =  " select * from users where email = '$email '&& password ='$password'";
                        $connect= mysqli_query($conn,$check_login);
                        $check_again = mysqli_num_rows($connect);
                        $check_login_email =  " select * from users where email = '$email'";
                        $connect_email= mysqli_query($conn,$check_login_email);
                        $check_again_email = mysqli_num_rows($connect_email);

                            if($check_again_email == 0)
                            {
                                echo "<h3 style='background-color: red; color:white;position:absolute;padding:10px; margin:auto; left:52%; top:13%;'> Error: Email id is not registered. Please Sign Up</h3>";
                            }
                            else if($check_again == 1){
                                
                                echo "<h3 style='background-color: green; color:white;position:absolute;padding:15px; margin:auto; RIGHT:18%; top:13%;'> 
                                Welcome Back Bro </h3>" ;
                                header('Location: Quiz_Main/Quiz_option.php');
                                $_SESSION['emailu']= $email; 
                                exit();
                            }
                            else
                            {
                                echo "<h3 style='background-color: red; color:white;position:absolute;padding:10px; margin:auto; left:65%; top:13%;'> Error: Password is wrong</h3>";
                            }
                        }


                    ?>

                    <?php
                    if(isset($_POST['signup']))
                    {
                    $confirm_password = $_POST['confirm_password'];
                    $password=$_POST['password'];
                    if($confirm_password==$password)
                    {
                        session_start();
                        $conn =  mysqli_connect("localhost","root","","register") or die(mysqli_error($conn));
                        $name=$_POST['name'];
                        $email=$_POST['email'];
                        $unique_id=uniqid();
                        $checker_email = "select * from users where email = '$email'";
                        $values = mysqli_query($conn,$checker_email);
                        $values_count = mysqli_num_rows($values);
                        if($values_count == 1)
                            {
                                echo "<h3 style='background-color: red; color:white;position:absolute;padding:10px; margin:auto; left:52%; top:13%;'> Error: Email Id already used . Please Login</h3>";
                            }
                         elseif(strlen($password)<6)
                            {
                                echo "<h3 style='background-color: red; color:white;position:absolute;padding:10px; margin:auto; left:52%; top:13%;'> Error: Minimum Length of Password must be 6.</h3>";
                            }
                         else
                                {
                                    date_default_timezone_set('Asia/Kolkata');
                                    $Currentdate = date('d-y-m');
                                    $Currenttime = date('H:i:s');
                                    $conn_table =  mysqli_connect("localhost","root","","records") or die(mysqli_error($conn_table));
                                    $create_table = "CREATE TABLE $unique_id(
                                        Topic VARCHAR(30) NOT NULL,
                                        CertificateUID VARCHAR(100),
                                        Marks VARCHAR(10),
                                        Dates VARCHAR(10)
                                        )";
                                    if(mysqli_query($conn_table,$create_table))
                                    {
                                         $query="insert into users (name,email,password,unique_id) values('$name','$email','$password','$unique_id')";

                                        if(mysqli_query($conn,$query))
                                         {
                                        echo "<h3 style='background-color: green; color:white;position:absolute;padding:10px; margin:auto; left:58%; top:13%;'> Thanks For Registration Please Login </h3>";
                                        }
                                    }

                                    else
                                    {
                                        echo "error in Database Conn" . mysqli_error($conn_table);
                                    }
                        
                                  }
                    }

                     else
                     {
                         echo "<h3 style='background-color: red; color:white;position:absolute;padding:10px; margin:auto; left:52%; top:13%;'> Error: Not Same Password Please Register Again</h3>";
                     }
                    }

                ?>
        </div>
    </body>
    <script>
        var x = document.getElementById("Login-box");
        var y = document.getElementById("Signup-box");
        var z = document.getElementById("btn");
        var a = document.getElementById("log-button");
        var b = document.getElementById("sign-button");
        var c = document.getElementById("image-form-login-1");
        var d = document.getElementById("image-form-login-2");
            function login()
            {
                x.style.left="50px";
                y.style.left="450px";
                z.style.left="0px";
                b.style.color="#120a94";
                a.style.color="white";
                d.style.display="none";
                c.style.display="block";
            
                
            }
            function signup()
            {
                x.style.left="450px";
                y.style.left="50px";
                z.style.left="110px";
                a.style.color="#120a94";
                b.style.color="white";
                c.style.display="none";
                d.style.display="block";
                
            }  
        </script>
</html>
<?php

    $conn= mysqli_connect("localhost","root","","register") or die(mysqli_error($conn));
    mysqli_select_db($conn,"register")or die(mysqli_error($conn));
    
    if(isset($_POST['signup']))
    {
         $name=$_POST['name'];
         $email=$_POST['email'];
         $password=$_POST['password'];
       
    }

?>


