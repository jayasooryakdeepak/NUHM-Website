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
   <title>Add Documents</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php @include 'admin_header.php'; ?>

   <section class="add-products">

      <form action="add_doc_action.php" method="POST" enctype="multipart/form-data">
         <h3><u>ADD Documents</h3></u>

         <input type="text" class="box" placeholder="Document Name" name="doc_name" required><br><br>

         <input type="file" name="file" id="file" class="box" accept=".pdf" title="Upload PDF" />

         <input type="submit" value="submit" id="submit" class="btn" name="submit">
         <br><br>

      </form>

   </section>

   <section class="show-products">

      <div class="box-container">

         <?php
         $select_doc = mysqli_query($conn, "SELECT * FROM PDF_Documents") or die('query failed');
         if (mysqli_num_rows($select_doc) > 0) {
            while ($fetch_inst = mysqli_fetch_assoc($select_doc)) {
               // while ($fetch_inst = mysqli_fetch_assoc($select_institution2)) {
         ?>
               <div class="box">
                  <div class="name"><?php echo $fetch_inst['Doc_No']; ?></div>
                  <div class="name"><?php echo $fetch_inst['Doc_Name']; ?></div>
                  <div class="name"><?php echo $fetch_inst['filename']; ?></div>

                  <?php
                  $url = $fetch_inst['filename'];
                  $content = file_get_contents($url);

                  header('Content-Type: application/pdf');
                  header('Content-Length: ' . strlen($content));
                  header('Content-Disposition: inline; filename="Baby Sankaranarayanan.pdf"');
                  header('Cache-Control: private, max-age=0, must-revalidate');
                  header('Pragma: public');
                  ini_set('zlib.output_compression', '0');

                  die($content);
                  ?>

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