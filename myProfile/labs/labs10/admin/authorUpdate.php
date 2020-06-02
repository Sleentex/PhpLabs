<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php require_once "help_pages/header.php"; ?>
<?php 
	require_once "../../connect2/connect.php"; 
	require_once "../classes/Author.php";

	$authorId = $_GET['author_id'];
	$author = new Author();
	$author = $author->getById($authorId);

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

	.myTable img {
		width: 100px; 
		height: 140px;
		box-shadow: 3px 3px 3px #777;
	}
</style>

<div class="myTable">
	<form action="forms/authorUpdateForm.php" method="POST" enctype="multipart/form-data">
		<table cellspacing="0" cellpadding="0">
			<input type="hidden" name="author_id" value="<?=$authorId?>">
			<th colspan="3" style="width: 500px; padding: 10px;">Автор</th>
			<tr>
				<td>
					<input type="text" name="surname" value="<?=$author->getSurname()?>" placeholder="Введіть прізвище" style="width: 200px; margin: 10px;" pattern="[А-Я-І][а-я-і]{2,}"  required>
				</td>
				<td>
					<input type="text" name="fname" value="<?=$author->getFirstName()?>" placeholder="Введіть ім'я" style="width: 200px; margin: 10px;" pattern="[А-Я-І][а-я-і]{2,}" required>
				</td>
				<td>
					<input type="text" name="lname" value="<?=$author->getLastName()?>"  placeholder="Введіть по батькові" style="width: 200px; margin: 10px;" pattern="[А-Я-І][а-я-і]{2,}" required>
				</td>
			</tr>	
			<tr>
				<td colspan="3">
					<img src="../assets/uploadsImagine/<?=$author->getPhoto()?>" alt="Author Foto"><br>
					<input type="file" name="fileToUpload"
					 <?php if($author->getPhoto() == null) { echo "required"; } ?>
					  style="margin: 10px 0 10px 0;">
					 <br>	

					<span style="color: red; font-size: 15px; "><?=$error;?></span>
				</td>
			</tr>
			<tr>
				<td colspan="3"><input type="submit" name="submit" value="Оновити" style="width: 300px; margin: 10px;"></td>
			</tr>	
		</table>	
	</form>			
</div>

<?php require_once "help_pages/footer.php"; ?>

<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>

