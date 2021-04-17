<?php
    session_start();
   
$conn= mysqli_connect('localhost','root','','register') ;
    $email= $_SESSION['emailu'];
        $query="SELECT * FROM users WHERE email = '$email'";
        $query_run= mysqli_query($conn,$query);

        while($row= mysqli_fetch_array($query_run))
        {
             $_SESSION['name'] = $row['name'] ;
             $_SESSION['uidofu']=$row['unique_id'] ;


        }


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="Dashboard_blank.css">
    <link rel="stylesheet" type="text/css" href="Dashboard_quiz.css">
    <script src="all.js"></script>

</head>
<body>
    <h2 class="UserName" style="float: right;margin-right:30px;"> Welcome Back <?php
    echo  $_SESSION['name'];
    ?></h1>
    <h2 class="UserName" >Select The Topic</h1>
    <div class="content_colum">
        <div class = "Content_row_1">
            <a href="Quiz_Panel/Quiz_html.php">
                <div class="row_1_colum_1">
                    <h1 class="top_1_row_1_num"> HTML</h1>
                </div>
                </a>
                <a href="Quiz_Panel/Quiz_css.php">
                <div class="row_1_colum_1">
                    <h1 class="top_1_row_1_num"> CSS</h1>
                </div>
            </a>
            <a href="Quiz_Panel/Quiz_js.php">
                <div class="row_1_colum_1">
                    <h1 class="top_1_row_1_num"> JAVASCRIPT</h1>
                </div>
            </a>
        </div>
    
    
     <div class="content_colum">
        <div class = "Content_row_1">
        <a href="Quiz_Panel/Quiz_java.php">
                <div class="row_1_colum_1">
                    <h1 class="top_1_row_1_num"> JAVA</h1>
                </div>
           
    </div>
</body>
</html>