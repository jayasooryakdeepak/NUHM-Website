<?php

include('../mysql_conn.php');

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:../login/login.html');
};

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   unlink('uploaded_img/' . $fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Services</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php @include 'admin_header.php'; ?>

   <section class="add-products">

      <form action="add_services_action.php" method="POST" enctype="multipart/form-data">
         <h3><u>ADD Service</h3></u>

         <input type="text" class="box" placeholder="Service Name" name="service_name" required><br><br>

         <h2><u>Type Of Service</h2></u>
         <select name="category" class="box" placeholder="Category">
            <option value="Clinical">Clinical Service</option>
            <option value="NCD">NCD</option>
            <option value="LAB">LAB</option>
         </select>

         <input type="file" class="box" name="file" id="file" required><br><br><br><br>

         <input type="submit" value="submit" id="submit" class="btn" name="submit">
         <br><br>

      </form>

   </section>

   <section class="show-products">

      <div class="box-container">

         <?php
         // $select_events = mysqli_query($conn, "SELECT * FROM Institutions_Table,Events_Table WHERE 
         // Institutions_Table.Institution_Code = Events_Table.Institution_Code") or die('query failed');

         $select_events = mysqli_query($conn, "SELECT * FROM Services_Table") or die('query failed');
         if (mysqli_num_rows($select_events) > 0) {
            while ($fetch_inst = mysqli_fetch_assoc($select_events)) {
               // while ($fetch_inst = mysqli_fetch_assoc($select_institution2)) {
         ?>
               <div class="box">
                  <div class="name"><?php echo $fetch_inst['Service_Code']; ?></div>
                  <img class="img-responsive" src="<?php echo $fetch_inst['Service_Icon']; ?>" alt="" style="width: 100%; height: auto">
                  <div class="name"><?php echo $fetch_inst['Service_Name']; ?></div>
                  <div class="name"><?php echo $fetch_inst['Category']; ?></div>

                  <!-- <a href="admin_update_product.php?update=<?php echo $fetch_inst['id']; ?>" class="option-btn">update</a>
         <a href="admin_products.php?delete=<?php echo $fetch_inst['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a> -->
               </div>
         <?php
               // }
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>


   </section>
   <script src="js/admin_script.js"></script>

</body>

</html>

<!-- 
Table Structures


Institutions Table

Institution Code
Institution Name
Place
Category



Institutions Details Table

Institution Code
About
Address Line 1
Address Line 2
Address Line 3
Pincode
Phone
Email
Opening Time
Closing Time                  
Location
Map
Main Img



Events Page


Event_Code
Institution_Code
Event_Name
Event_Desc
Date
Event_Image

Services Page

Service_Code
Service_Name
Category
Service_Icon


-->