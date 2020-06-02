<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php require_once "help_pages/header.php"; ?>

<?php 
	require_once "../../connect2/connect.php"; 
	require_once "../classes/Poem.php";
	$poemId = $_GET['poem_id'];
	$poem = new Poem();
	$poem = $poem->getById($poemId);
?>

<div class="myTable">
	<table cellspacing="0" cellpadding="0">
		<th style="width: 500px; padding: 10px; font-size: 23px;"><?=$poem->getName()?></th>
		<tr>
			<td style=" padding: 10px; font-size: 18px;"><?php echo str_replace("\r\n", "<br>", $poem->getText());?></td>
		</tr>
	</table>				
</div>

<?php require_once "help_pages/footer.php"; ?>

<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>

