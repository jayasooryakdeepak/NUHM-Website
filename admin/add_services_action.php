<?php
include('../mysql_conn.php');

//$inst_code = 103;
$service_name = $_POST['service_name'];
$service_desc = $_POST['service_desc'];
$category = $_POST['category'];

//Icon upload
$target_dir1 = 'uploads/services/icons/';
echo $target_file1 = $target_dir1 . basename($_FILES['fileicon']['name']);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
$FileType = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));

//Image upload
$target_dir2 = 'uploads/services/images/';
echo $target_file2 = $target_dir2 . basename($_FILES['fileimg']['name']);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));
$FileType = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));


if (isset($_POST['submit'])) {

    if (move_uploaded_file($_FILES['fileicon']['tmp_name'], $target_file1) && move_uploaded_file($_FILES['fileimg']['tmp_name'], $target_file2)) {
        $rt = 2;
        if ($rt == 1) {
            echo "<script>alert('Already Exists');window.location='admin_products.php';</script>";
        } else {
            $sql1 = "insert into Services_Table (Service_Name,Service_Desc,Category,Service_Icon,Service_Img) 
            values('$service_name','$service_desc','$category','$target_file1','$target_file2')";
            $conn->query($sql1);
            echo "<script>alert('Service Added Successfully');window.location='add_services.php';</script>";
        }
    } else {
        // echo "<script>alert('Sorry, there was an error uploading your file.');window.location='admin_products.php';</script>";
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
}
