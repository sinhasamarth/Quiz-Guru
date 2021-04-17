<html>
    <head>
        <title>Not Eligible </title>
        <link type="text/css" rel="stylesheet"  href="notpass_style.css" >
        <link type="text/css" rel="stylesheet"  href="header-style.css" >
    </head>
    
    <body>
         <div class="bg-color">
            <div class="header">
                <div class="logo">
                    <image class="logo-main" src="logo.PNG">
                    </div>
                    <div class="links">
                       <a href="Checker/Certificate_Checker.php" >Certificate Checker</a>
                       <a href="Pages/Contact_us.php" >Contact Us</a>
                       <a href="Form/signup.php" >Login / SignUp</a>
                       <a href="Quiz/Quiz.php" >Quiz</a>
                        <a href="Localhost:8080/QuizGURU" >Home</a>
                    </div> 
                </div>
             </div>
        </div>
          <div class="logout_main">
            <img  class ="colum-1"src="lose%20(2).png">
            <h1 class="colum-2">You are Not Eligible For Certificate <br>You have scored less than 75% </h1>
        </div>
    </body>
</html>
<?php
session_start();
session_destroy();
?>