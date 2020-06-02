<?php if(isset($_COOKIE['adminLogin'])) : ?>

<?php 
	require_once "help_pages/header.php";
	require_once "../../connect2/connect.php"; 
	require_once "../classes/Gallery.php";
	require_once "../classes/Author.php";

	$gallery = new Gallery();
	$gallerys = $gallery->getGallerysForAuthorId($_GET['author_id']);

	$error = "";
	if (isset($_GET["error"]) && $_GET["error"] != "") {
		$error = $_GET["error"];
		$_GET["error"] = "";
	}
?>

<style>
	.myTable input[type="file"] {
		width: auto;
		border: none;
		text-align: center;
		padding-left: 30px;
		padding-right: 1px;
	}
</style>

<div class="myTable">
	<form action="forms/galleryInsertForm.php" method="POST" enctype="multipart/form-data">
		<table cellspacing="0" cellpadding="0" style="width: 300px;">
			<tr><td style="width: 150px;">Галерея</td>
			<td><input type="submit" name="submit" value="Добавити" style="margin: 5px;"></td></tr>
			<input type="hidden" name="author_id" value="<?=$_GET['author_id']?>">
			<tr>
				<td colspan="2"><input type="file" name="fileToUpload" ></td>
			</tr>
			<tr><td colspan="2"><span style="color: red; font-size: 15px; "><?=$error;?></span></td></tr>
		</table>
	</form>	

</div>

<?php require_once "help_pages/footer.php"; ?>

<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>

