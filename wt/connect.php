<?php
    $servername="localhost";
    $username="root";
    $password="";
    $retype="";
    $db="data";
    $conn=mysqli_connect($servername,$username,$password,$retype) or die('Connection failed:'.mysqli_connect());
    mysqli_select_db($conn,$db);
    mysqli_connect();
?>
