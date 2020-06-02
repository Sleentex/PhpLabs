<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php 
	require_once "../../../connect2/connect.php"; 
	require_once "../../classes/Gallery.php";

	$gallery = new Gallery();

	if(isset($_GET["gallery_id"])) {
		$gallery->deleteById($_GET["gallery_id"]);
	}

	header("Location: ../gallery.php?author_id={$_GET['author_id']}");
?>
<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>