<?php
include('../mysql_conn.php');

$inst_code = 103;
$doc_name = $_POST['doc_name'];

//Image upload
$target_dir = 'uploads/documents/';
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
            $sql1 = "insert into PDF_Documents (Doc_Name,filename) 
            values('$doc_name','$target_file')";
            $conn->query($sql1);
            echo "<script>alert('Document Added Successfully');window.location='add_doc.php';</script>";
        }
    } else {
        // echo "<script>alert('Sorry, there was an error uploading your file.');window.location='admin_products.php';</script>";
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
}
