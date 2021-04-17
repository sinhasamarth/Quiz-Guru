<?php
    session_start();
    require('FPDF/fpdf.php');
    $name = $_SESSION['name'];
    $topics = $_SESSION['topic'];
    $email = $_SESSION['emailu'];
    $dates = date("d / m /y");
    $uniquid = uniqid();
    $conn = mysqli_connect("localhost","root","","records");
    $query="INSERT INTO samdata (names,email,unique_id) values ('$name','$email','$uniquid')";
    if(mysqli_query($conn,$query))
    {    
    $pdf = new FPDF('L','mm',array(131,184));
    $pdf->AddPage();
    $pdf->AddFont('myfont','','myfont.php');
    $pdf->SetFont('myfont','',25); 
    $pdf->Image("Certificate_blank2.jpeg",0,0); 
    $pdf->Cell(0,100,$name,0,0,'C');
    $pdf->SetXY(0,0); 
    $pdf->AddFont('Roboto-Regular','','Roboto-Regular.php');
    $pdf->SetFont('Roboto-Regular','',15); 
    $pdf->SetXY(52,75);
    $pdf->Cell(0,0,"This certificate certify that  $name ",0,0,'c');
    $pdf->SetXY(40,85);
    $pdf->Cell(0,0," have passed the Quiz of $topics with the more than 75%",0,0,'c');
    $pdf->SetXY(60,95);
    $pdf->Cell(0,0," on $dates at Quiz Guru ",0,0,'c');
    $pdf->SetXY(46,110);
    $pdf->AddFont('Roboto-Regular','','Roboto-Regular.php');
    $pdf->SetFont('Roboto-Regular','',12); 
    $pdf->Cell(0,0,"$uniquid",0,0,'c');
    $pdf->SetFont('Roboto-Regular','',10); 
    $pdf->Output();
    ob_end_clean();
    }

    else{
        echo "error" . mysqli_error($conn);
    }

?>