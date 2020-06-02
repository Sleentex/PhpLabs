<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php 
	require_once "../../../connect2/connect.php"; 
	require_once "../../classes/Gallery.php";

	$authorId = $_POST['author_id'];
	$gallery = new Gallery();

	function myHeader($authorId) {
		header("Location: ../gallery.php?author_id={$authorId}");
	}

	for ($id = 1; $id <= $gallery->getMaxId(); $id++) { 
		if (isset($_POST["update_{$id}"]) && $_POST["update_{$id}"] != "") {
			break;
		}
	}

	$target_dir = "../../assets/uploadsImagine/";
	$target_file = $target_dir . basename($_FILES["photo_{$id}"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
		myHeader($authorId);
		exit();
	  	
	}

	$newGallery = $gallery->setId($id)->setPhoto($_FILES["photo_{$id}"]["name"])->setAuthorId($authorId);
	
	if (file_exists($target_file)) {
		$gallery->update($newGallery);
	  	myHeader($authorId);
	}

	if (move_uploaded_file($_FILES["photo_{$id}"]["tmp_name"], $target_file)) {
	    $gallery->update($newGallery);
	} else {
	    echo "Sorry, there was an error uploading your file.";   
	}

	myHeader($authorId);
?>
<?php else: ?>
	<?php header("Location: ../admin.php"); ?>
<?php endif; ?>