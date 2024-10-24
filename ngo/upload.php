<?php
if(isset($_POST['Signup'])){
    $file = $_FILES['file'];
    $files = $_FILES['files'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileNames = $_FILES['files']['name'];
    $fileTmpNames = $_FILES['files']['tmp_name'];
    $fileSizes = $_FILES['files']['size'];
    $fileErrors = $_FILES['files']['error'];
    $fileTypes = $_FILES['files']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $fileExts = explode('.', $fileNames);
    $fileActualExts = strtolower(end($fileExts));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if(in_array($fileActualExt, $allowed) || in_array($fileActualExts, $allowed)){
        if($fileError === 0 || $fileErrors === 0){
            if($fileSize < 10000000 || $fileSizes < 10000000){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDest = '../ngo/uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDest);
                header("Location: ../Login/ngologin.php");
                $fileNameNews = uniqid('', true).".".$fileActualExts;
                $fileDests = '../ngo/uploads/'.$fileNameNews;
                move_uploaded_file($fileTmpNames, $fileDests);
                header("Location: ../Login/ngologin.php");
            }
            else{
                echo '<script>
                alert("File is Too Big!!")
                window.location.href = "../Signup/ngosignup.php";
                </script>';
            }
        }
        else{
            echo '<script>
            alert("Error while Uploading!");
            window.location.href = "../Signup/ngosignup.php";
            </script>';
        }
    }
    else{
        echo'<script>
            alert("File Type Not Allowed");
            window.location.href = "../Singup/ngosignup.php";
            </script>';
    }
}

?>