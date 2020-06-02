<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php
require_once "../../../connect2/connect.php"; 
require_once "../../classes/Gallery.php";

function errorHeader($authorId, $error) {
    header("Location: ../galleryInsert.php?author_id={$authorId}&error={$error}");
}

function myHeader($authorId) {
  header("Location: ../gallery.php?author_id={$authorId}");
}

$target_dir = "../../assets/uploadsImagine/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$error = "";
$authorId = $_POST["author_id"];
$gallery = new Gallery();

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check === false) {
    $error = "Це не зображення";
    errorHeader($authorId, $error);
  } 
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  $error = "Тільки JPG, JPEG, PNG файли";
  errorHeader($authorId, $error);
  exit();
}

$gallery->setPhoto($_FILES["fileToUpload"]["name"])->setAuthorId($authorId);

// Check if file already exists
if (file_exists($target_file)) {
  $gallery->insert();
  myHeader($authorId);
}

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $gallery->insert();
    myHeader($authorId);
} else {
  $error = "Вибачте, ми не смогли загрузити файл";
  errorHeader($authorId, $error);
}

myHeader($authorId);

?>
<?php else: ?>
  <?php header("Location: ../admin.php"); ?>
<?php endif; ?>