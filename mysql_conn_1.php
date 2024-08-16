<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "NUHM";

global $user_name;
global $pwd;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if ($conn->connect_error) {
    die("connect failed" . $conn->connect_error);
}
