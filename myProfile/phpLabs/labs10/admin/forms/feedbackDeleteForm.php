<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php 
	require_once "../../../connect2/connect.php"; 
	require_once "../../classes/Feedback.php";

	$feedback = new Feedback();

	if(isset($_POST["feedback_id"])) {
		$feedback->deleteById($_POST["feedback_id"]);
	}

	header("Location: ../feedbacks.php?movie_id={$_POST['movie_id']}");
?>
<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>