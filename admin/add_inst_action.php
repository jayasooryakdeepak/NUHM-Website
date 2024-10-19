<?php
include('../mysql_conn.php');

//$prodcode = $_POST[ 'pcode' ];
$inst_code = 0;
$instname = $_POST['inst_name'];
$place = $_POST['place'];
$category = $_POST['category'];
$about = $_POST['about'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$address3 = $_POST['address3'];
$pincode = $_POST['pincode'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$opentime = $_POST['opentime'];
$closetime = $_POST['closetime'];
$iframe_string = $_POST['location'];

//Extracting map link from the entered iframe link

preg_match('/src="([^"]+)"/', $iframe_string, $match);
$location = $match[1];

// ***

//Image upload
$target_dir = 'uploads/inst/';
echo $target_file = $target_dir . basename($_FILES['file']['name']);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST['submit'])) {

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        // $s = "select * from Product_details where productname='$prodname'";
        $rt = 2;
        if ($rt == 1) {
            echo "<script>alert('Already Exists');window.location='add_inst.php';</script>";
        } else {
            // $sql = "insert into Product_Details (productname,qty,unitprice,sellingprice,description,filename) 
            // values('$prodname','$quantity','$uprice','$sprice','$descp','$target_file')";
            // $conn->query($sql);
            // echo "<script>alert('Product Added Successfully');window.location='admin_products.php';</script>";

            $sql1 = "insert into Institutions_Table (Institution_Name,Place,Category) 
            values('$instname','$place','$category')";
            $conn->query($sql1);

            $query = "SELECT MAX(Institution_Code) FROM Institutions_Table" ;

            $res_array = mysqli_query($conn, $query);

            //$inscode = mysqli_fetch_assoc($res_array);

            while($inscode = mysqli_fetch_assoc($res_array)){
                $inst_code=$inst_code+$inscode['MAX(Institution_Code)'];
                echo $inst_code;
             };
            
            $sql2 = "insert into Institutions_Details_Table (Institution_Code,About,Address_Line_1,Address_Line_2,Address_Line_3,
            Pincode,Phone,Email,Opening_Time,Closing_Time,Location,Main_Img) 
            values('$inst_code','$about','$address1','$address2','$address3','$pincode',
            '$phone','$email','$opentime','$closetime','$location','$target_file')";
            $conn->query($sql2);
            $inst_code = 0;
            echo "<script>alert('Institution Added Successfully');window.location='add_inst.php';</script>";
            
        }
    } else {
        // echo "<script>alert('Sorry, there was an error uploading your file.');window.location='admin_products.php';</script>";
        echo "Error: " . $sql1 . "<br>" . $conn->error;
        echo "Error: " . $sql2 . "<br>" . $conn->error;
        
        
    }
}
