<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php require_once "help_pages/header.php"; ?>

<?php 
	require_once "../../connect2/connect.php"; 
	require_once "../classes/Biography.php";

	$biografy = new Biography();
	$biografys = $biografy->getBiographysForAuthorId($_GET['author_id']);
?>

<script type="text/javascript">
</script>

<div class="myTable">
	<table cellspacing="0" cellpadding="0">
		<th style="width: 500px;">Біографія</th>
		<th colspan="2">
			<a href="biographyInsert.php?author_id=<?=$_GET['author_id']?>">
				<input type="submit" name="insert" value="Добавити" style="width: 300px; margin: 10px; ">
			</a>
		</th>
		<form action="forms/biographyForm.php">
			<input type="hidden" name="author_id" value="<?=$_GET['author_id']?>">
			<?php foreach ($biografys as $value) : ?>
				<tr>
					<td>
						<textarea name="textarea_<?=$value->getId()?>" cols="65" rows="5" ><?=$value->getText()?></textarea>
					</td>
					<td><input type="submit" name="update_<?=$value->getId()?>" value="Оновити" onclick="return confirm('Ви дійсно хочете оновити це?');"></td>
					<td><input type="submit" name="delete_<?=$value->getId()?>" value="Видалити" onclick="return confirm('Ви дійсно хочете видалити це?');"></td>
				</tr>		
			<?php endforeach; ?>
		</form>
	</table>				
</div>

<?php require_once "help_pages/footer.php"; ?>

<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>

