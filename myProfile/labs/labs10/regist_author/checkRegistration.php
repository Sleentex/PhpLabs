<?php  
	require_once "../../connect2/connect.php";
	require_once "../classes/User.php";

	$user = new User();
	$user->setLogin(filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING))
		 ->setName(filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING))
		 ->setPass(filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING));

	$flag = false;
	$errorLogin = "";
	$errorName = "";
	$$errorPass = "";
	$login = $_POST['login'];
	$name = $_POST['name'];

	if(mb_strlen($user->getLogin()) < 5 || mb_strlen($user->getLogin()) > 10) {
		$errorLogin = "Недоступна довжина логіна(від 5 до 10 символов)";
		$flag = true;
	} 
	if(mb_strlen($user->getName()) < 3 || mb_strlen($user->getName()) > 15) {
		$errorName = "Недоступна довжина імені(від 3 до 20 символов)";
		$flag = true;
	}  
	if(mb_strlen($user->getPass()) < 3 || mb_strlen($user->getPass()) > 10) {
		$errorPass = "Недоступна довжина пароля(від 3 до 10 символов)";
		$flag = true;
	} 
	if(!empty($user->checkLoginUnique())) {
		$errorLogin = "Такий логін вже існує!";
		$flag = true;
	}

	if($flag) {
		header("Location: registration.php?login={$login}&name={$name}&errorL={$errorLogin}&errorN={$errorName}&errorP={$errorPass}");
		return;
	}



	$user->setPass(md5("{$user->getPass()}strongPass"));
	$user->insert();

	header("Location: ../index.php?author_id=1");
?>