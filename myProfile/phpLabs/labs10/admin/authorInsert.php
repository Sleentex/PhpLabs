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
	<form action="forms/authorInsertForm.php" method="POST" enctype="multipart/form-data">
		<table cellspacing="0" cellpadding="0">
			<th colspan="3" style="width: 500px; padding: 10px;">Автор</th>
			<tr>
				<td>
					<input type="text" name="surname" placeholder="Введіть прізвище" style="width: 200px; margin: 10px;" pattern="[А-Я-І][а-я-і]{2,}"  required>
				</td>
				<td>
					<input type="text" name="fname" placeholder="Введіть ім'я" style="width: 200px; margin: 10px;" pattern="[А-Я-І][а-я-і]{2,}" required>
				</td>
				<td>
					<input type="text" name="lname" placeholder="Введіть по батькові" style="width: 200px; margin: 10px;" pattern="[А-Я-І][а-я-і]{2,}" required>
				</td>
			</tr>	
			<tr>
				<td colspan="3">
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

