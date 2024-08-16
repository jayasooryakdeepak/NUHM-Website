<?php

$str  = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.187927841866!2d76.31954369999997!3d10.0013303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b080df5cbd7318f%3A0xdd19290adf28552c!2sUPHC%20vennala!5e0!3m2!1sen!2sin!4v1723797696789!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';

$iframe_string = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.187927841866!2d76.31954369999997!3d10.0013303!2m3!1f0!2f0!3f0!3m2!
    1i1024!2i768!4f13.1!3m3!1m2!1s0x3b080df5cbd7318f%3A0xdd19290adf28552c!2sUPHC%
    20vennala!5e0!3m2!1sen!2sin!4v1723797696789!5m2!1sen!2sin" 
    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';



// //forward slashes are the start and end delimeters
// //third parameter is the array we want to fill with matches
// if (preg_match('/"([^"]+)"/', $str, $m)) {
//     print $m[1];   
//     $val = $m[1];
// } else {
//    //preg_match returns the number of matches found, 
//    //so if here didn't match pattern
// }

preg_match('/src="([^"]+)"/', $iframe_string, $match);
$url = $match[1];

echo "The link is : ", $url; 