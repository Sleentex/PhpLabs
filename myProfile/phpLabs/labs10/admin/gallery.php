<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php require_once "help_pages/header.php"; ?>

<?php 
	require_once "../../connect2/connect.php"; 
	require_once "../classes/Gallery.php";
	require_once "../classes/Author.php";

	$gallery = new Gallery();
	$gallerys = $gallery->getGallerysForAuthorId($_GET['author_id']);
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
	<table cellspacing="0" cellpadding="0" style="width: 200px;">
		<td style="width: 150px;">Галерея</td>
		<td>
			<a href="galleryInsert.php?author_id=<?=$_GET['author_id']?>">
				<input type="submit" name="insert" value="Добавити" style="margin: 5px;">
			</a>
		</td>
		<form action="forms/galleryUpdateForm.php" method="POST" enctype="multipart/form-data">	
			<input type="hidden" name="author_id" value="<?=$_GET['author_id']?>">
			<?php foreach ($gallerys as $value) : ?>
				<tr>
					<td>
						<img src="../assets/uploadsImagine/<?=$value->getPhoto()?>"><br>
						<input type="file" name="photo_<?=$value->getId()?>">
					</td>
					<td>
						<input type="submit" name="update_<?=$value->getId()?>" value="Оновити" style="margin: 5px;" onclick="return confirm('Ви дійсно хочете оновити це?');">
						<!-- <button name="update_<?=$value->getId()?>">
							<img src="../assets/img/btnUpdate.png" alt="update" style="width: 30px; height: 30px;">
						</button> -->
						<a href="forms/galleryDeleteForm.php?author_id=<?=$_GET['author_id']?>&gallery_id=<?=$value->getId()?>" onclick="return confirm('Ви дійсно хочете видалити це?');">
							<img src="../assets/img/btnDelete.png" alt="delete" style="width: 30px; height: 30px;">
						</a>
					</td>
				</tr>		
			<?php endforeach; ?>
		</form>
	</table>				
</div>

<?php require_once "help_pages/footer.php"; ?>

<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>

