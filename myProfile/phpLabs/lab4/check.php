<?php 
	$resultFile = fopen("assets/documents/searchFile.txt", "w");
	if(!$resultFile) {
		die("Couldn`t open file searchFile.txt");
	}

	$file = fopen("assets/documents/doc.txt", "r");
	if(!$file) {
		die("Couldn`t open file doc.txt");
	}

	if ($_POST['submit1']) {
		$num = 0;
		$line = $_POST['searchName'];
	} elseif ($_POST['submit2']) {
		$num = 1;
		$line = $_POST['searchSemester'];
	} elseif ($_POST['submit3']) {
		$num = 2;
		$line = $_POST['searchHour'];
	} elseif ($_POST['submit4']) {
		$num = 3;
		$line = $_POST['searchFormControl'];
	} elseif ($_POST['submit5']) {
		$num = 4;
		$line = $_POST['searchpPib'];
	}
	/*if ($_POST['searchpPib']) {
		$num = 4;
		$line = $_POST['searchpPib'];
	}*/

	while(!feof($file)) {
  		$str = fgets($file);
  		$arr = explode(";", $str);  
  		
  		if(stristr($arr[$num], $line) !== false) {
  			fwrite($resultFile, $str);
		} 
  	}
?>
<?php header("Location: http://localhost/myProfile/phpLabs/lab4"); ?>