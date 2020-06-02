<?php  
	require_once "../../connect2/connect.php";
	require_once "../classes/Admin.php";

	$admin = new Admin();
	$admin->setLogin(filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING))
		  ->setPass(filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING));

	$admin->setPass(md5("{$admin->getPass()}"));

	$admins = $admin->getAuthorization();

	if(empty($admins)) {
		$error = "Такий адміністратор не знайден!";
		header("Location: ../admin.php?login={$_POST['login']}&error={$error}");
		return;
	}

	foreach ($admins as $value) {
		setcookie('adminName', $value->getName(), time() + 3600, "/");
		setcookie('adminLogin', $value->getLogin(), time() + 3600, "/");
	}

	header("Location: index.php");
?>