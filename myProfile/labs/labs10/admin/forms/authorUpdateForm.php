<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php
require_once "../../../connect2/connect.php"; 
require_once "../../classes/Author.php";

function errorHeader($authorId, $error) {
    header("Location: ../authorUpdate.php?author_id={$authorId}&error={$error}");
}

function myHeader() {
  	header("Location: ../index.php");
}

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$target_dir = "../../assets/uploadsImagine/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$error = "";
	$authorId = $_POST["author_id"];
	$author = new Author();
	$checkAuthor = $author->getById($authorId);

	$author ->setId($_POST["author_id"])
			->setFirstName($_POST["fname"])
	        ->setLastName($_POST["lname"])
	        ->setSurname($_POST["surname"]);

	//$author->update($author);

	if(!empty($_FILES["fileToUpload"]["tmp_name"])) {
		$author->setPhoto($_FILES["fileToUpload"]["name"]);
	} 

	if($checkAuthor->getPhoto() == null || ($checkAuthor->getPhoto() != null && !empty($_FILES["fileToUpload"]["tmp_name"]))) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check === false) {
			$error = "Це не зображеня";
			errorHeader($authorId, $error);
			return;
		}

		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
				$error = "Тільки JPG, JPEG, PNG файли";
				errorHeader($authorId, $error);
				return;
		}
	}

	// Check if file already exists
	if (file_exists($target_file)) {
	  	$author->update($author);
	  	myHeader();
	  	return;
	}

	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	  	$author->update($author);
	  	myHeader();
	  	return;
	} else {
	  	$error = "Вибачте, ми не смогли загрузити файл";
	  	errorHeader($authorId, $error);
	}

		myHeader();
		return;
}

	myHeader();
?>
<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>