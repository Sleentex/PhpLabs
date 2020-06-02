<?php  
	require_once "../../connect2/connect.php";
	require_once "../classes/User.php";

	$authorId = $_POST["author_id"];

	$user = new User();
	$user->setLogin(filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING))
		 ->setPass(filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING));

	$user->setPass(md5("{$user->getPass()}strongPass"));

	$users = $user->getAuthorization();

	if(empty($users)) {
		$error = "Такий користувач не знайден!";
		header("Location: ../index.php?author_id={$authorId}&error={$error}");
		echo "Такий користувач не знайден!";
		exit();
	}

	foreach ($users as $value) {
		setcookie('userId', $value->getId(), time() + 3600, "/");
		setcookie('userName', $value->getName(), time() + 3600, "/");
		setcookie('userLogin', $value->getLogin(), time() + 3600, "/");
	}

	header("Location: ../index.php?author_id={$authorId}");
?>