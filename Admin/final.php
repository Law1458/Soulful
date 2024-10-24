<?php

include("../config.php");

    $Id = $_POST['Id'];
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    $sql = "UPDATE `ngo` SET Username='{$username}', Email='{$email}', Password='{$password}' WHERE Id='{$Id}'";
    $result = mysqli_query($conn, $sql);

    header("Location: http://localhost/Soulful/Admin/adminupdate.php");

    mysqli_close($conn);

?>