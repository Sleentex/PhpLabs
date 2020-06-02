<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php require_once "help_pages/header.php"; ?>

<div class="myTable">
	<form action="forms/biographyInsertForm.php">
		<table cellspacing="0" cellpadding="0">
			<input type="hidden" name="author_id" value="<?=$_GET['author_id']?>">
			<th style="width: 500px;">Біографія</th>
			<th colspan="2">
				<input type="submit" name="insert" value="Добавити" style="width: 300px; margin: 10px;" onclick="return confirm('Do you really want to insert this?');">
			</th>
			<tr>
				<td colspan="3">
					<textarea name="textarea" style="width: 800px; height: 190px;" required></textarea>
				</td>
			</tr>		
		</table>	
	</form>			
</div>

<?php require_once "help_pages/footer.php"; ?>

<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>

