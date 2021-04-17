<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="header-style.css">
        <link rel="stylesheet" type="text/css" href="Checker.css">
        
        
        <title>Certificate Checker</title>
    </head>
    <body>
        <div class="bg-color">
        <div class="header">
            <div class="logo">
                <img class="logo-main" src="logo.PNG">
                </div>
            <div class="links">
            <a href="Pages/Certificate_Checker/" >Certificate Checker</a>
           <a href="Pages/Contact_us.php" >Contact Us</a>
           <a href="Form/signup.php" >Login / SignUp</a>
           <a href="Quiz/Quiz.php" >Quiz</a>
            <a href="Localhost:8080/QuizGURU" >Home</a>
            
                </div>
            </div>
        </div>
        
        <div class="Checker_main">
            <form method="post" action="index.php">
            <h1>Enter The Unique Id Number</h1>
            <input type="text" name ="checkid"class="box">
            <button type="submit" name="chec">Check Now </button>
                
            </form>
        </div>
        <?php
    session_start();
   
$conn= mysqli_connect('localhost','root','','records') ;
if(isset($_POST['chec']))
{
    $Check=$_POST['checkid'];
        $query="SELECT * FROM samdata WHERE unique_id = '$Check'";
        $query_run= mysqli_query($conn,$query);
        if(mysqli_num_rows($query) == 1)
        {
            echo "<h1>Its Valid</h1>";
        }
        else
        echo "<h1>Its Not Valid</h1>";
    }
        mysqli_close($conn);
?>
    </body>
</html>
