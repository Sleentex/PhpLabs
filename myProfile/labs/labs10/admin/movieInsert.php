<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php require_once "help_pages/header.php"; ?>
<?php 
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
	<form action="forms/movieInsertForm.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="author_id" value="<?=$_GET["author_id"]?>">
		<table cellspacing="0" cellpadding="0">
			<th colspan="2" style="width: 500px; padding: 10px;">Фільм</th>
			<tr>
				<td>
					<input type="text" name="name" placeholder="Введіть назву фільма" style="width: 200px; margin: 10px;" required>
				</td>
				<td>
					<input type="text" name="video" placeholder="Введіть силку фільма" style="width: 200px; margin: 10px;" required>
				</td>
			</tr>	
			<tr>
				<td colspan="2">
					<textarea name="describe" maxlength="250" placeholder="Введіть опис фільма" style="width: 800px; height: 100px;  margin: 10px;" required></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="file" name="fileToUpload" required><br>	
					<span style="color: red; font-size: 15px; "><?=$error;?></span>
				</td>
			</tr>
			<tr>
				<td colspan="3"><input type="submit" name="submit" value="Добавити" style="width: 300px; margin: 10px;"></td>
			</tr>	
		</table>	
	</form>			
</div>

<?php require_once "help_pages/footer.php"; ?>

<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>

