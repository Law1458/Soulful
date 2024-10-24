<?php
    $insert = false;
?>
<?php
    
    session_start();
    if(!$_SESSION['username']){
        header('Location: ../Login/adminlogin.php');
    }
    echo $_SESSION['username'];

?>

<?php
    
    include("../config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >

    <title>Admin Dashboard Panel</title> 
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../Dashboard/Images/logo.png" alt="">
            </div>

            <span class="logo_name">Soulful Charity</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="../Dashboard/index.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>
                <li><a href="../Admin/adminadd.php">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Add NGO</span>
                </a></li>
                <li><a href="../Admin/adminupdate.php">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Update NGO</span>
                </a></li>
                <li><a href="../Admin/delete.php">
                    <i class="uil uil-thumbs-up"></i>
                    <span class="link-name">Delete NGO</span>
                </a></li>
                <!-- <li><a href="#">
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Donation History</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-share"></i>
                    <span class="link-name">Expenditure</span>
                </a></li> -->
            </ul>
            
            <ul class="logout-mode">
                <li><a href="../logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name" >Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            
            <!-- <img src="images/profile.jpg" alt=""> -->
        </div>
        
        <div class="dash-content">
        <?php
        if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
        }
        ?>
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Add NGO</span>
                </div>
                <form action="../Admin/adminadd.php" method="post">
                <!-- <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">ID</label>
                    <input type="text" class="form-control" name="id" id="exampleFormControlInput1" placeholder="Enter username">
                </div> -->
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" class="form-control" name="Username" id="exampleFormControlInput1" placeholder="Enter username">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="Email" id="exampleFormControlInput1" placeholder="Enter Email">
                </div>
                <label for="inputPassword5" class="form-label">Password</label>
                <input type="password" id="inputPassword5" name="Password" class="form-control" aria-describedby="passwordHelpBlock">
                <div id="passwordHelpBlock" class="form-text">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                </div>
                <div class="col-auto">
                    <button type="submit" name="submit" class="btn btn-primary mb-3">Add</button>
                </div>
                </form>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Activity</span>
                </div>

                <div class="activity-data">
                <table class="table table-bordered table-striped table-hover border-dark">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    $sql = "SELECT * FROM `ngo`";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>
                        <th scope='row'>".$row['Id']."</th>
                        <td>".$row['Username']."</td>
                        <td>".$row["Email"]."</td>
                        <td>".$row['Password']."</td>
                      </tr>";
                    }
                    ?>
                    </tbody>
                  </table>
                
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="script.js"></script>
</body>
</html>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['Username'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];

        $sql = "INSERT INTO ngo (Username, Email, Password) VALUES ('$username', '$email', '$password')";
        $result = mysqli_query($conn,$sql);
        
        if($result){
            $insert = true;
        }
        else{
            echo "Error";
            mysqli_error($conn);
        }
    }
?>