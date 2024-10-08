<?php

include('../mysql_conn.php');

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:../login/login.html');
};

if (isset($_POST['add_product'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'uploads/institutions/' . $image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if (mysqli_num_rows($select_product_name) > 0) {
      $message[] = 'product name already exist!';
   } else {
      $insert_product = mysqli_query($conn, "INSERT INTO `products`(name, details, price, image) VALUES('$name', '$details', '$price', '$image')") or die('query failed');

      if ($insert_product) {
         if ($image_size > 2000000) {
            $message[] = 'image size is too large!';
         } else {
            move_uploaded_file($image_tmp_name, $image_folter);
            $message[] = 'product added successfully!';
         }
      }
   }
}

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
   <title>Add Institutions</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php @include 'admin_header.php'; ?>

   <section class="add-products">

      <form action="add_inst_action.php" method="POST" enctype="multipart/form-data">
         <h3><u>ADD INSTITUTIONS</h3></u>

         <input type="text" class="box" placeholder="Institution Name" name="inst_name" required><br><br>

         <input type="text" class="box" placeholder="Place" name="place" required><br><br>

         <h2><u>CATEGORY</h2></u>
         <select name="category" class="box" placeholder="Category">
            <option value="UPHC">UPHC</option>
            <option value="UCHC">UCHC</option>
            <option value="UHWC">UHWC</option>
         </select>

         <textarea id="about" class="box" placeholder="About" name="about" rows="7" cols="30"></textarea>

         <input type="text" class="box" placeholder="Address Line 1" name="address1" required><br><br>

         <input type="text" class="box" placeholder="Address Line 2" name="address2" required><br><br>

         <input type="text" class="box" placeholder="Address Line 3" name="address3" required><br><br>

         <input type="number" class="box" placeholder="Pincode" name="pincode" required><br><br>

         <input type="number" class="box" placeholder="Phone" name="phone" required><br><br>

         <input type="email" class="box" placeholder="Email" name="email" required><br><br>

         <input type="time" class="box" placeholder="Opening Time" name="opentime" value="09:00" required><br><br>

         <input type="time" class="box" placeholder="Closing Time" name="closetime" value="17:00" required><br><br>

         <input type="text" class="box" placeholder="Location" name="location" required><br><br>

         <input type="file" class="box" name="file" id="file" required><br><br><br><br>

         <input type="submit" value="submit" id="submit" class="btn" name="submit">
         <br><br>

      </form>

      <!-- 
   <form action="" method="POST" enctype="multipart/form-data">
      <h3>Add New Product</h3>
      <input type="text" class="box" required placeholder="enter product name" name="name">
      <input type="number" min="0" class="box" required placeholder="enter product price" name="price">
      <textarea name="details" class="box" required placeholder="enter product details" cols="30" rows="10"></textarea>
      <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
      <input type="submit" value="add product" name="add_product" class="btn">
   </form> -->

   </section>

   <section class="show-products">

      <div class="box-container">

         <?php
         $select_institution = mysqli_query($conn, "SELECT * FROM Institutions_Table,Institutions_Details_Table WHERE 
         Institutions_Table.Institution_Code = Institutions_Details_Table.Institution_Code") or die('query failed');
         // $select_institution2 = mysqli_query($conn, "SELECT * FROM `Institutions_Details_Table`") or die('query failed');
         if (mysqli_num_rows($select_institution) > 0) {
            while ($fetch_inst = mysqli_fetch_assoc($select_institution)) {
               // while ($fetch_inst = mysqli_fetch_assoc($select_institution2)) {
         ?>
               <div class="box">
                  <div class="name"><?php echo $fetch_inst['Category']; ?></div>
                  <div class="price"><?php echo $fetch_inst['Institution_Code']; ?></div>
                  <img class="img-responsive" src="<?php echo $fetch_inst['Main_Img']; ?>" alt="" style="width: 100%; height: auto">
                  <!-- <iframe
                     src="<?php //echo $fetch_inst['Location']; 
                           ?>"
                     width="300"
                     height="250"
                     style="border: 0"
                     allowfullscreen=""
                     loading="lazy"
                     referrerpolicy="no-referrer-when-downgrade"></iframe> -->

                  <div class="name"><?php echo $fetch_inst['Institution_Name']; ?></div>
                  <div class="name"><?php echo $fetch_inst['Place']; ?></div>
                  <div class="name"><?php echo $fetch_inst['Phone']; ?></div>
                  <div class="name"><?php echo $fetch_inst['Email']; ?></div>
                  <?php
                  //Converting TimeStamp to AM/PM
                  $optime = $fetch_inst['Opening_Time'];
                  $new_OP_Time_1 = date('h:i A', strtotime($optime));
                  $cltime = $fetch_inst['Closing_Time'];
                  $new_OP_Time_2 = date('h:i A', strtotime($cltime));
                  ?>
                  <div class="name">
                     <?php
                     echo $new_OP_Time_1;
                     echo "-";
                     echo $new_OP_Time_2 ?>
                  </div>

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


-->