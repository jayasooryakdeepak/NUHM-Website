<?php
include('../mysql_conn.php');

$inst_code = 103;
$event_name = $_POST['event_name'];
$event_desc = $_POST['event_desc'];
$event_date = $_POST['event_date'];

//Image upload
$target_dir = 'uploads/events/';
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
            $sql1 = "insert into Events_Table (Institution_Code,Event_Name,Event_Desc,Date,Event_Image) 
            values('$inst_code','$event_name','$event_desc','$event_date','$target_file')";
            $conn->query($sql1);
            echo "<script>alert('Events Added Successfully');window.location='add_events.php';</script>";
        }
    } else {
        // echo "<script>alert('Sorry, there was an error uploading your file.');window.location='admin_products.php';</script>";
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
}
