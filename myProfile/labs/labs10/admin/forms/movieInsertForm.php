<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php
require_once "../../../connect2/connect.php"; 
require_once "../../classes/Movie.php";

function errorHeader($error) {
    header("Location: ../movieInsert.php?error={$error}");
}

function myHeader($author_id) {
  header("Location: ../movies.php?author_id={$author_id}");
}

$target_dir = "../../assets/uploadsImagine/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$error = "";
$author_id = $_POST["author_id"];
$movie = new Movie();

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check === false) {
    $error = "Це не зображеня";
    errorHeader($error);
  } 
}

// Allow certain file formats

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  $error = "Тільки JPG, JPEG, PNG файли";
  errorHeader($error);
  exit();
}

$movie  ->setName($_POST["name"])
        ->setVideo($_POST["video"])
        ->setVideoDescribe($_POST["describe"])
        ->setPhoto($_FILES["fileToUpload"]["name"])
        ->setAuthorId($author_id);


// Check if file already exists
if (file_exists($target_file)) {
  $movie->insert();
  myHeader($author_id);
}

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  $movie->insert();
  myHeader($author_id);
} else {
  $error = "Вибачте, ми не смогли загрузити файл";
  errorHeader($error);
}

myHeader($author_id);

?>
<?php else: ?>
  <?php header("Location: ../admin.php"); ?>
<?php endif; ?>