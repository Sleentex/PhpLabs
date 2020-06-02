<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php require_once "help_pages/header.php"; ?>

<?php 
	require_once "../../connect2/connect.php"; 
	require_once "../classes/Poem.php";
	$poem = new Poem();
?>

<div class="myTable">
	<form action="forms/poemInsertForm.php" method="POST">
		<input type="hidden" name="author_id" value="<?=$_GET["author_id"]?>">
		<table cellspacing="0" cellpadding="0" style="width: 300px;">
			<th style="padding: 10px; font-size: 23px;">Добавлення вірша</th>	
			<tr>
				<td colspan="2">
					<input type="text" name="name" style="width: 285px;" placeholder="Введіть назву" required><br><br>
					<textarea name="textarea" style="width: 300px; height: 190px; margin: 0px;" placeholder="Введіть вірш" required></textarea>
				</td>
			</tr>	
			<tr>
				<td><input type="submit" name="insert" value="Добавити" style="width: 300px;"></td>
			</tr>
		</table>	
	</form>			
</div>

<?php require_once "help_pages/footer.php"; ?>

<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>

