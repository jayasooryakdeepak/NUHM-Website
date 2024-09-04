<?php 
$filename = "Baby_Sankaranarayanan.pdf"; 
// Header 
header("Content-type: application/pdf"); header("Content-Length: " . filesize($filename)); 
// Send the file to the browser. 
readfile($filename); 
?>