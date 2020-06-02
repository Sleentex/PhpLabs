<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php 
	require_once "../../../connect2/connect.php"; 
	require_once "../../classes/Biography.php";

	$biography = new Biography();

	if(isset($_GET["insert"])) {
		$biography->setText($_GET["textarea"])->setAuthorId($_GET['author_id']);
		$biography->insert();
	}

	header("Location: ../biography.php?author_id={$_GET['author_id']}");
?>
<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>