<?php
include('../mysql_conn.php');

//$inst_code = 103;
$service_name = $_POST['service_name'];
$category = $_POST['category'];

//Image upload
$target_dir = 'uploads/services/';
echo $target_file = $target_dir . basename($_FILES['file']['name']);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST['submit'])) {

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        $rt = 2;
        if ($rt == 1) {
            echo "<script>alert('Already Exists');window.location='admin_products.php';</script>";
        } else {
            $sql1 = "insert into Services_Table (Service_Name,Category,Service_Icon) 
            values('$service_name','$category','$target_file')";
            $conn->query($sql1);
            echo "<script>alert('Service Added Successfully');window.location='add_services.php';</script>";
        }
    } else {
        // echo "<script>alert('Sorry, there was an error uploading your file.');window.location='admin_products.php';</script>";
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
}
