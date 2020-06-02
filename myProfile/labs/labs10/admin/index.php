<?php if(isset($_COOKIE['adminLogin'])) : ?>

<?php 
	require_once "help_pages/header.php";
	require_once "../../connect2/connect.php"; 
	require_once "../classes/Author.php";

	$author = new Author();
	$authors = $author->getAll();
?>

<div class="myTable">
	
		<table cellspacing="0" cellpadding="0">
			<th style="width: 500px;">Автори</th>
				<th colspan="2">
					<a href="authorInsert.php">
						<input type="submit" value="Добавити" style="width: 300px; margin: 10px; ">
					</a>
				</th>

			<?php foreach ($authors as $value) : ?>
				<tr>
					<td>
						<a href="menu.php?author_id=<?=$value->getId()?>">
							<?="{$value->getFirstName()} {$value->getLastName()} {$value->getSurname()}"?>
						</a>
					</td>
					<input type="hidden" name="author_id" value="<?=$_GET['author_id']?>">
					<td>
						<a href="authorUpdate.php?author_id=<?=$value->getId()?>">
							<input type="submit" value="Оновити">
						</a>
					</td>
					<td>
						<a href="forms/authorDeleteForm.php?author_id=<?=$value->getId()?>">
							<input type="submit" name="delete_<?=$value->getId()?>" value="Видалити" onclick="return confirm('Ви дійсно хочете видалити це?');">
						</a>
					</td>
				</tr>		
			<?php endforeach; ?>
		</table>				
	
</div>



<?php require_once "help_pages/footer.php"; ?>

<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>

