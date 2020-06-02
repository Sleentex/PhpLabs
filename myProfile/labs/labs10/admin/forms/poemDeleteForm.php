<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php 
	require_once "../../../connect2/connect.php"; 
	require_once "../../classes/Poem.php";

	$poem = new Poem();

	if(isset($_GET["poem_id"])) {
		$poem->deleteById($_GET["poem_id"]);
	}

	header("Location: ../poems.php?author_id={$_GET['author_id']}");
?>
<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>