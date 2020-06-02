<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php require_once "help_pages/header.php"; ?>

<?php 
	require_once "../../connect2/connect.php"; 
	require_once "../classes/Poem.php";
	$poem = new Poem();
	$poem = $poem->getById($_GET["poem_id"]);
?>

<div class="myTable">
	<form action="forms/poemUpdateForm.php" method="POST">
		<input type="hidden" name="author_id" value="<?=$_GET["author_id"]?>">
		<input type="hidden" name="poem_id" value="<?=$_GET["poem_id"]?>">
		<table cellspacing="0" cellpadding="0" style="width: 300px;">
			<th style="padding: 10px; font-size: 23px;">Оновлення вірша</th>	
			<tr>
				<td colspan="2">
					<input type="text" name="name" value="<?=$poem->getName()?>" placeholder="Введіть назву" required style="width: 285px;"><br><br>
					<textarea name="textarea" style="width: 300px; height: 190px; margin: 0px;" placeholder="Введіть вірш" required><?=$poem->getText()?></textarea>
				</td>
			</tr>	
			<tr>
				<td><input type="submit" name="update" value="Оновити" style="width: 300px;"></td>
			</tr>
		</table>	
	</form>			
</div>

<?php require_once "help_pages/footer.php"; ?>

<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>

