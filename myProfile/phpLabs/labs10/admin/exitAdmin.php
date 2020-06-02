<?php  
	setcookie('adminLogin', "", time() - 3600, "/");
	setcookie('adminName', "", time() - 3600, "/");
	header("Location: ../admin.php");
?>