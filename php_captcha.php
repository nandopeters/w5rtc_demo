<?php
session_start();
$RandomStr = md5(microtime());// md5 to generate the random string
$ResultStr = substr($RandomStr,0,5);//trim 5 digit 
$NewImage =imagecreatefromjpeg("img.jpg");//image create by existing image and as back ground 
$TextColor = imagecolorallocate($NewImage, 000, 000, 000);//text color-white
imagestring($NewImage, 5, 20, 10, $ResultStr, $TextColor);// Draw a random string horizontally 
$_SESSION['captcha'] = $ResultStr;
header("Content-type: image/jpeg");// out out the image 
imagejpeg($NewImage);//Output image to browser
?>

