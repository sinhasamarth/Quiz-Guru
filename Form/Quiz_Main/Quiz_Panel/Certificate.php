<?php
session_start(); 

$sam='<script type="text/javascript"> document.write(localStorage.getItem("score"));</script>';
echo $sam;

$_SESSION['marks']=$sam;
?>