<?php  if(isset($_COOKIE['adminLogin'])) : ?>
<?php 
	require_once "help_pages/header.php";
	require_once "../../connect2/connect.php"; 
	require_once "../classes/Author.php";

	$author = new Author();
?>

<div class="myTable">
	<form action="#">
		<table cellspacing="0" cellpadding="0">
			<th style="width: 500px;">
				<?php  
					$value = $author->getById($_GET['author_id']);
					echo "{$value->getFirstName()} {$value->getLastName()} {$value->getSurname()}";
				?>
			</th>
	

			<tr>
				<td><a href="biography.php?author_id=<?=$_GET['author_id']?>">Біографія</a></td>
			</tr>
			<tr>
				<td><a href="poems.php?author_id=<?=$_GET['author_id']?>">Вірші</a></td>
			</tr>
			<tr>
				<td><a href="gallery.php?author_id=<?=$_GET['author_id']?>">Галерея</a></td>
			</tr>
			<tr>
				<td><a href="movies.php?author_id=<?=$_GET['author_id']?>">Фільми</a></td>
			</tr>
		</table>				
	</form>
</div>


<?php require_once "help_pages/footer.php"; ?>

<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>

