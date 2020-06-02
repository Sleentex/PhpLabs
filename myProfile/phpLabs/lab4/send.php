<?php 
	$file = fopen('assets/documents/doc.txt', 'a');

	if(!$file) {
		die("Couldn`t open file!");
	}

	$line = "\r\n" . $_POST['name'] . ';' . $_POST['semester'] . ';' . $_POST['hour'] . ';' . 
	$_POST['formControl'] . ';' . $_POST['pib'] . ";";

	fwrite($file, $line);
?>

<?php header("Location: index.php"); ?>
<!-- <script type="text/javascript">
  	window.location.href = "http://localhost/labs/lab3";
 </script> --> 


