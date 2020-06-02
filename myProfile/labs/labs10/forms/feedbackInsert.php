<?php  
	require_once "../../connect2/connect.php";
	require_once "../classes/Feedback.php";

	$feedback = new Feedback();

	if(isset($_POST["submit"]) && $_POST["feedback"] != "") {
		$feedback->setUserId($_POST["user_id"])->setMovieId($_POST["movie_id"])->setFeedback($_POST["feedback"]);
		$feedback->insert();
	}

	header("Location: ../showVideo.php?author_id={$_POST["author_id"]}&movie_id={$_POST["movie_id"]}");
?>