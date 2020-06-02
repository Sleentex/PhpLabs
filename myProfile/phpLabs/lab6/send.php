<?php require_once "../connect/connect.php"; ?>

<?php  
	if(isset($_POST['submit'])) {
		$query = "INSERT INTO exams VALUES (NULL,'" . $_POST['name'] . "','" . $_POST['semester'] . "','" . 
				  $_POST['hour'] . "','" . $_POST['formControl'] . "','" . $_POST['pib'] . "')";

		$result = $mysqli->query($query);
 
		if (!$result) {
		    $message  = 'Неверный запрос: ' . $mysqli->error . "</br>";
		    $message .= 'Запрос целиком: ' . $query;
		    die($message);
		}
	}
	header("Location: http://localhost/myProfile/phpLabs/lab6");
?>