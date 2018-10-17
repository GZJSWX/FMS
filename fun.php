<?php
header("Content-type:text/html;charset = utf-8");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
$conn = mysqli_connect("localhost","root","180811","android");
mysqli_query($conn,"SET NAMES utf8");
?>