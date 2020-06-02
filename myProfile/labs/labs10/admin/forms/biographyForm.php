<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php 
	require_once "../../../connect2/connect.php"; 
	require_once "../../classes/Biography.php";

	$biography = new Biography();

	for ($id=1; $id <= $biography->getMaxId(); $id++) { 
		if(isset($_GET["update_{$id}"])) {
			$newBio = $biography->setId($id)->setText($_GET["textarea_{$id}"])->setAuthorId($_GET['author_id']);
			$biography->update($newBio);
			break;
		}

		if(isset($_GET["delete_{$id}"])) {
			$biography->deleteById($id);
			break;
		}

	}

	header("Location: ../biography.php?author_id={$_GET['author_id']}");
?>
<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>