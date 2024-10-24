<?php
session_start();

if(isset($_POST['update_profile'])){

   $update_name = mysqli_real_escape_string($conn, $_POST['update_username']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $user_id = $_SESSION['id'];

   mysqli_query($conn, "UPDATE `user` SET Username = '$update_name', Email = '$update_email' WHERE Id = '$user_id'") or die('query failed');

   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['update_password']));

   if(!empty($new_pass) || !empty($confirm_pass)){
      if($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `userlogin` SET Password = '$confirm_pass' WHERE Id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style2.css">

</head>
<body>
   
<div class="update-profile">

<?php
   //  $select = mysqli_query($conn, "SELECT * FROM `userlogin`") or die('query failed');
   //  if(mysqli_num_rows($select) > 0){
   //     $fetch = mysqli_fetch_assoc($select);
   //    }
?>

   <form action="" method="post" enctype="multipart/form-data">
   <div class="flex">
         <div class="inputBox">
            <span>Username :</span>
            <input type="text" name="update_username" value="" class="box">
            <span>Your Email :</span>
            <input type="email" name="update_email" value="" class="box">
         </div>
         <div class="inputBox">
            <span>New Password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>Confirm Password :</span>
            <input type="password" name="update_password" placeholder="confirm new password" class="box">
         </div>
      </div>
      <input type="submit" value="Update" name="update_profile" class="btn">
   </form>


</div>

</body>
</html>