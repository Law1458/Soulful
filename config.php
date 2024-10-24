<?php 
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "souldb";
    $conn = mysqli_connect($host, $user, $password, $dbname);
    if($conn){
        // echo "Connected.";
    }
    else{
        echo "Something went wrong.";
    }
?>