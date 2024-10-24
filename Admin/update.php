<?php
  include("../config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">

<?php
$Id = $_GET['Id'];
$sql = "SELECT * FROM `ngo` WHERE Id = {$Id}";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0)
      {
        while($row = mysqli_fetch_assoc($result)){
?>
      <form action="../Admin/final.php" method="POST">
        <input type="hidden" name="Id" value="<?=$row['Id'];?>">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="Username" value="<?=$row['Username'];?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="Email" value="<?=$row['Email'];?>">
      </div>
      <label class="form-label">Password</label>
        <input type="password" class="form-control" name="Password" value="<?=$row['Password'];?>" aria-describedby="passwordHelpBlock">
        <div id="passwordHelpBlock" class="form-text">
        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
        </div>
        <input class="submit btn btn-primary" type="submit" value="Update"/>
    </div>
    </form>

    <?php
      }
    }
    ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>