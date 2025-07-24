<?php
header('Content-Type: image/png');
$code = isset($_GET['code']) ? $_GET['code'] : '0000';
$image = imagecreate(200, 60);
$bg = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0,0,0);
imagestring($image, 5, 10, 5, $code, $black);
imagepng($image);
imagedestroy($image);
?>
