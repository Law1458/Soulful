<?php
    include("../config.php");
    session_start();
    $user = $_SESSION['username'];
    if($user == true){
       
    }
    else{
        header('Location: ../Login/userlogin.php');
    }
?>

<?php
    include("../config.php");
?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $account_no = $_POST['account'];
        $bank_name = $_POST['bank'];
        $ifsc_code = $_POST['ifsc'];
        $amount = $_POST['amount'];
        $tno = 10;
        $user = 1;

        $sql = "SELECT MAX(Trans_No) +1 FROM deposit";
        $result = mysqli_query($conn,$sql);
        if($row = $result -> fetch_row()){
            $tno = $row[0];
        }
        if($tno === null){
            $tno = 10;
        }
        if($user === null){
            $user = 1;
        }

        $date = date('Y/m/d');
        $sql = "INSERT INTO deposit (User_Id, Trans_No, Account_No, Bank_Name, IFSC_Code, Amount) VALUES ('$user', '$tno', '$account_no', '$bank_name', '$ifsc_code', $amount)";
        $result = mysqli_query($conn,$sql);
    }
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

    <title>User Dashboard Panel</title> 
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
                <li><a href="../User/update.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>
                <li><a href="../User/profile.php">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Profile</span>
                </a></li>
                <li><a href="../User/viewngo.php">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">View NGO</span>
                </a></li>
                <li><a href="../User/Deposit.php">
                    <i class="uil uil-thumbs-up"></i>
                    <span class="link-name">Deposit</span>
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
       
        ?>
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Deposit Amount</span>
                </div>
                <form action="../User/Deposit.php" method="post">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Account No.</label>
                    <input type="number" class="form-control" name="account" id="exampleFormControlInput1" placeholder="Enter Account No.">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Bank Name</label>
                    <input type="text" class="form-control" name="bank" id="exampleFormControlInput1" placeholder="Enter Bank Name">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">IFSC Code</label>
                    <input type="text" class="form-control" name="ifsc" id="exampleFormControlInput1" placeholder="Enter IFSC Code">
                </div>
                <label for="inputPassword5" class="form-label">Amount</label>
                <input type="number" id="inputPassword5" name="amount" class="form-control">
                <br>
                <div class="col-auto">
                    <button type="submit" name="submit" class="btn btn-primary mb-3">Deposit</button>
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
                        <th scope="col">Trans_Id</th>
                        <th scope="col">Account No.</th>
                        <th scope="col">Bank Name</th>
                        <th scope="col">IFSC Code</th>
                        <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                    $sql = "SELECT * FROM `deposit`";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>
                        <th scope='row'>".$row['Trans_No']."</th>
                        <td>".$row['Account_No']."</td>
                        <td>".$row["Bank_Name"]."</td>
                        <td>".$row['IFSC_Code']."</td>
                        <td>".$row['Amount']."</td>
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