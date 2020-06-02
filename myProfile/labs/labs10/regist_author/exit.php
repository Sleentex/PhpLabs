<?php 
	setcookie('userId', "", time() - 3600, "/");
	setcookie('userName', "", time() - 3600, "/");
	setcookie('userLogin', "", time() - 3600, "/");
	header("Location: ../index.php?author_id={$_GET["author_id"]}");
?>