<?php 
    include('../config.php');
    session_start();
    if(isset($_POST['Signin'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM admin WHERE Username = '$username' OR Password = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_num_rows($result);

        if($row == 1){
            $_SESSION['username'] = $username;
            header("Location: ../Dashboard/index.php");
          }
        else{
          echo '<script>
                  alert("Invalid Username or Password");
                  window.location.href = "adminlogin.php";
                  </script>';
        }
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

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
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,500;0,600;0,700;1,100;1,200;1,300&display=swap');
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;

}
body{
    background: #6a62d2;
}

.login-page {
    height: 100vh;
    width: 100%;
    align-items: center;
    display: flex;
    justify-content: center;
}

.form {
  position: relative;
  filter:drop-shadow(0 0 2px #000000);
  border-radius: 5px;
  width: 360px;
  height: 420px;
  background-color: #ffffff;
  padding:40px;
}

.form img {
    position: absolute;
    height: 20px;
    top: 254px;
    right: 60px;
    cursor: pointer;
}

.form input {
    outline: 0;
    background: #f2f2f2;
    border-radius: 4px;
    width: 100%;
    border: 0;
    margin: 15px 0;
    padding: 15px;
    font-size: 14px;
}

.form input:focus {
    box-shadow: 0 0 5px 0 rgba(106, 98, 210);
}

span {
    color: red;
    margin: 10px 0;
    font-size: 14px;
}

.form button {
    outline: 0;
    background: #6a62d2;
    width: 100%;
    border: 0;
    margin-top: 10px;
    border-radius: 3px;
    padding: 15px;
    color: #FFFFFF;
    font-size: 15px;
    -webkit-transition: all 0.3 ease;
    transition: all 0.4s ease-in-out;
    cursor: pointer;
}

.form button:hover,
.form button:active,
.form button:focus {
    background: black;
    color: #fff;

}

.message{
    margin: 15px 0;
    text-align: center;

}
.form .message a {
    font-size: 14px;
    color: #6a62d2;
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

    <div class="login-page">
        <div class="form">
            <form class="login-form" action="" method="POST">
                <h2>SIGN IN TO YOUR ACCOUNT</h2>
                <input type="text" required placeholder="Username" id="user" autocomplete="off" name="username"/>
                <input oninput="return formvalid()" type="password" required placeholder="Password" id="pass" name="password" autocomplete="off" />
                <img src="https://cdn2.iconfinder.com/data/icons/basic-ui-interface-v-2/32/hide-512.png"
                    onclick="show()" id="showimg">
                <span id="vaild-pass"></span>
                <button type="submit" name="Signin">SIGN IN</button>
                <p class="message"><a href="../Signup/adminsignup.php">Sign Up</a></p>
            </form>
        </div>
    </div>
    <script>
        function formvalid() {
  var vaildpass = document.getElementById("pass").value;

  if (vaildpass.length <= 8 || vaildpass.length >= 20) {
    document.getElementById("vaild-pass").innerHTML = "Minimum 8 characters";
    return false;
  } else {
    document.getElementById("vaild-pass").innerHTML = "";
  }
}

function show() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
    document.getElementById("showimg").src =
      "https://static.thenounproject.com/png/777494-200.png";
  } else {
    x.type = "password";
    document.getElementById("showimg").src =
      "https://cdn2.iconfinder.com/data/icons/basic-ui-interface-v-2/32/hide-512.png";
  }
}
    </script>
</body>
</html>

