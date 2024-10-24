<?php
  if(isset($_POST['Signup'])){
    include('../config.php');
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pancard = $_POST['file'];
    $passbook = $_POST['files'];

    $sql = "SELECT * FROM ngo where Username='$username'";
    $result = mysqli_query($conn, $sql);
    $count_admin = mysqli_num_rows($result);

    $sql = "SELECT * FROM ngo where Email='$email'";
    $result = mysqli_query($conn, $sql);
    $count_admin_email = mysqli_num_rows($result);

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

    if($count_admin==0 || $count_admin_email==0){
      if($password==$password){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO ngo(Username, Email, Password) VALUES('$username', '$email', '$hash')";
        $result = mysqli_query($conn, $sql);
      }
      else{
        echo '<script>alert("Password do not match!!");
        window.location.href = "adminsignup.php";
        </script>';
      }
    }
    else{
      echo '<script>alert("User Already Exists!!");
      window.location.href = "adminsignup.php";
      </script>';
    }

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO SignUp</title>

    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Overpass:300,400,400i,600,700" rel="stylesheet">

    <link rel="stylesheet" href="../css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">

    <link rel="stylesheet" href="../css/aos.css">

    <link rel="stylesheet" href="../css/ionicons.min.css">

    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/icomoon.css">
    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

.cont {
  height: 100vh;
  width: 100%;
  align-items: center;
  display: flex;
  justify-content: center;
  background-image: radial-gradient(
    circle farthest-corner at 10% 20%,
    rgba(253, 101, 133, 1) 0%,
    rgba(255, 211, 165, 1) 90%
  );
}

.car {
  border-radius: 10px;
  box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.3);
  width: 400px;
  height: 560px;
  background-color: #ffffff;
  padding: 10px 30px;
}

.car_title {
  text-align: center;
  padding: 10px;
}

.car_title h1 {
  font-size: 26px;
  font-weight: bold;
}

.formm input {
  margin: 10px 0;
  width: 100%;
  background-color: #e2e2e2;
  border: none;
  outline: none;
  padding: 12px 20px;
  border-radius: 4px;
}

.formm button {
  background-color: #4796ff;
  color: #ffffff;
  font-size: 16px;
  outline: none;
  border-radius: 5px;
  border: none;
  padding: 8px 15px;
  width: 100%;
  -webkit-transition: all 0.3 ease;
  transition: all 0.4s ease-in-out;
  cursor: pointer;
}

.car_terms {
  display: flex;
  align-items: center;
  padding: 10px;
}

.car_terms input[type="checkbox"] {
  background-color: #e2e2e2;
}

.car_terms span {
  margin: 5px;
  font-size: 13px;
}

.formm button:hover,
.formm button:active,
.formm button:focus {
    background: black;
    color: #fff;
}

.car a {
  color: #4796ff;
  text-decoration: none;
}
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.php">SOULFUL CHARITY</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="../index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="../about.php" class="nav-link">About</a></li>
          <!-- <li class="nav-item"><a href="causes.html" class="nav-link">Causes</a></li> -->
          <li class="nav-item"><a href="../donate.php" class="nav-link">Donate</a></li>
          <li class="nav-item"><a href="../blog.php" class="nav-link">Blog</a></li>
          <li class="nav-item"><a href="../gallery.php" class="nav-link">Gallery</a></li>
          <li class="nav-item"><a href="../contact.php" class="nav-link">Contact</a></li>
          <!-- <div class="w3-dropdown-hover" style="top: 7px;"> -->
          <li class="nav-item w3-dropdown-hover"><a href="#" class="nav-link" style="color: azure;">Sign In/Sign Up</a>
            <div class="w3-dropdown-content w3-bar-block w3-border">
            <a href="../Login/adminlogin.php" class="w3-bar-item w3-button">Admin</a>
            <a href="../Login/userlogin.php" class="w3-bar-item w3-button">User</a>
            <a href="../Login/ngologin.php" class="w3-bar-item w3-button">NGO</a>
            </div>
          </li>
        </div>
        </ul>
      </div>
    </div>
  </nav>

    <div class="cont">
        <div class="car">
          <div class="car_title">
            <h1>Create Account</h1>
            <span>Already have an account? <a href="../Login/ngologin.php">Sign In</a></span>
          </div>
          <div class="formm">
          <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="username" id="username" placeholder="Username" />
            <input type="email" name="email" placeholder="Email" id="email" />
            <input type="password" name="password" placeholder="Create Password" id="password" />
            <span>Add Pan Card Image</span>
            <input type="file" required name="file"/>
            <span>Add Bank Passbook PDF</span>
            <input type="file" required name="files"/>
            <button name="Signup">Sign Up</button>
            </form>
          </div>
          <!-- <div class="car_terms">
              <input type="checkbox" name="" id="terms"> <span>I have read and agree to the <a href="">Terms of Service</a></span>
          </div> -->
        </div>
      </div>
</body>
</html>