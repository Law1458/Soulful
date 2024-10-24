<?php

include("../config.php");

if(isset($_POST['delete'])){
  $Id = $_POST['Id'];

  $sql = "DELETE FROM `ngologin` WHERE Id = {$Id}";
  $result = mysqli_query($conn, $sql);

  header("Location: http://localhost/Soulful/Admin/adminupdate.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="hidden" name="Id" value="<?=$row['Id'];?>">
      <div class="mb-3">
        <label class="form-label">Id</label>
        <input type="text" class="form-control" name="Id">
      </div>
      <input class="submit btn btn-primary" type="submit" name="delete" value="Delete"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>