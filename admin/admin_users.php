<?php

include('../mysql_conn.php');

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.html');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($Con, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>USERS</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title">users account</h1>

   <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `User_Credentials`") or die('query failed');
         
         if(mysqli_num_rows($select_users) > 0){
            while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p>User Id : <span><?php echo $fetch_users['id']; ?></span></p>
         <p>User Name : <span><?php echo $fetch_users['user_name']; ?></span></p>
         <p>Password : <span><?php echo $fetch_users['pwd']; ?></span></p>
         <p>User type : <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; }; ?>"><?php echo $fetch_users['user_type']; ?></span></p>
         <!-- <a href="admin_users.php?delete=<?php echo $fetch_users_type['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete</a> -->
      </div>
      <?php
         }
      }
      ?>
   </div>

</section>













<script src="js/admin_script.js"></script>

</body>
</html>