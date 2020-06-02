<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php 
	require_once "../../../connect2/connect.php"; 
	require_once "../../classes/Poem.php";

	$poem = new Poem();

	if(isset($_POST["insert"])) {
		$poem->setName($_POST["name"])->setText($_POST['textarea'])->setAuthorId($_POST['author_id']);
		$poem->insert();
	}

	header("Location: ../poems.php?author_id={$_POST['author_id']}");
?>
<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>