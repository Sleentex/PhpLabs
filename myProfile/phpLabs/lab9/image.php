<?php 
	$day = $_GET["endDate"];
	

	if($day / 100 > 1) {
		$height = 30;
		$width = 48;
	} 
	else if($day / 10 > 1) {
		$height = 30;
		$width = 38;
	} 
	else {
		$height = 30;
		$width = 28;
	}

	//$myImg = imageCreateFromJpeg('formatJpg.jpg');
	$img = imageCreateTrueColor($width, $height);
	$red = imagecolorallocate($img, 200, 100, 100);
	$white = imagecolorallocate($img, 100, 100, 100);
	$blue = imagecolorallocate($img, 0, 100, 100);

	imageline($img, 1, 1, $width-2, 1, $red);
	imageline($img, 1, 1, 1, 28, $red);
	imageline($img, $width-2, 1, $width-2, 28, $red);
	imageline($img, 1, 28, $width-2, 28, $red);

	//imagefilledrectangle($img, 0, 0, 200, 200, $white);
	//imagearc($img, 10, 10, 10, 10, 90, 360, $blue);

	//imagechar($img, 5, 130, 130, $string, $blue);
	imagestring($img, 5, 1, 7, $day, $red);

	header("Content-Type:image/jpeg");
	imagejpeg($img,NULL,100);
?>