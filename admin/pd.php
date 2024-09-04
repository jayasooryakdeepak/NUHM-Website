<?php 

$filename = $_GET["pdfname"]; 
// Header 
header("Content-type: application/pdf"); header("Content-Length: " . filesize($filename)); 
// Send the file to the browser. 
readfile($filename); 
?>