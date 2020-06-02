<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php
require_once "../../../connect2/connect.php"; 
require_once "../../classes/Movie.php";

function errorHeader($movieId, $authorId, $error) {
    header("Location: ../movieUpdate.php?movie_id={$movieId}author_id={$authorId}&error={$error}");
}

function myHeader($authorId) {
  header("Location: ../movies.php?author_id={$authorId}");
}

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$target_dir = "../../assets/uploadsImagine/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$error = "";
	$authorId = $_POST["author_id"];
	$movieId = $_POST["movie_id"];
	$movie = new Movie();
	$checkMovie = $movie->getById($movieId);

	$movie  ->setId($movieId)
			->setName($_POST["name"])
	        ->setVideo($_POST["video"])
	        ->setVideoDescribe($_POST["describe"])
	        ->setAuthorId($authorId);

	//$author->update($author);

	if(!empty($_FILES["fileToUpload"]["tmp_name"])) {
		$movie->setPhoto($_FILES["fileToUpload"]["name"]);
	} 

	if($checkMovie->getPhoto() == null || ($checkMovie->getPhoto() != null && !empty($_FILES["fileToUpload"]["tmp_name"]))) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check === false) {
			$error = "Це не зображеня";
			errorHeader($movieId, $authorId, $error);
			return;
		}

		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
				$error = "Тільки JPG, JPEG, PNG файли";
				errorHeader($movieId, $authorId, $error);
				return;
		}
	}

	// Check if file already exists
	if (file_exists($target_file)) {
	  	$movie->update($movie);
	  	myHeader($authorId);
	  	return;
	}

	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	  	$movie->update($movie);
	  	myHeader($authorId);
	  	return;
	} else {
	  	$error = "Вибачте, ми не смогли загрузити файл";
	  	errorHeader($movieId, $authorId, $error);
	}

		myHeader($authorId);
		return;
}

	myHeader($authorId);
?>
<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>