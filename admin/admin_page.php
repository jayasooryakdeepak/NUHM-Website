<?php

include('../mysql_conn.php');

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:../login/login.html');
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php @include 'admin_header.php'; ?>

   <section class="dashboard">

      <h1 class="title">Dashboard</h1>

      <div class="box-container">

         <div class="box">
            <?php
            $total_pendings = 0;
            $select_pendings = mysqli_query($conn, "SELECT COUNT(*) FROM `Institutions_Table`") or die('query failed');
            while ($fetch_pendings = mysqli_fetch_assoc($select_pendings)) {
               $total_pendings = $fetch_pendings['COUNT(*)'];
            };
            ?>
            <h3><?php echo $total_pendings; ?></h3>
            <p>Total Institutions</p>
         </div>

         <div class="box">
            <?php
            $total_pendings = 0;
            $select_pendings = mysqli_query($conn, "SELECT COUNT(*) FROM `User_Credentials`") or die('query failed');
            while ($fetch_pendings = mysqli_fetch_assoc($select_pendings)) {
               $total_pendings = $fetch_pendings['COUNT(*)'];
            };
            ?>
            <h3><?php echo $total_pendings; ?></h3>
            <p>Total Users</p>
         </div>

         <div class="box">
            <?php
            $total_pendings = 0;
            $select_pendings = mysqli_query($conn, "SELECT COUNT(*) FROM `Events_Table`") or die('query failed');
            while ($fetch_pendings = mysqli_fetch_assoc($select_pendings)) {
               $total_pendings = $fetch_pendings['COUNT(*)'];
            };
            ?>
            <h3><?php echo $total_pendings; ?></h3>
            <p>Total Events</p>
         </div>

         <div class="box">
            <?php
            $total_pendings = 0;
            $select_pendings = mysqli_query($conn, "SELECT COUNT(*) FROM `Services_Table`") or die('query failed');
            while ($fetch_pendings = mysqli_fetch_assoc($select_pendings)) {
               $total_pendings = $fetch_pendings['COUNT(*)'];
            };
            ?>
            <h3><?php echo $total_pendings; ?></h3>
            <p>Total Services</p>
         </div>

      </div>

   </section>

   <script src="js/admin_script.js"></script>

</body>

</html>