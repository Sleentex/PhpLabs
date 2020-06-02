<?php if(isset($_COOKIE['adminLogin'])) : ?>
<?php
require_once "../../../connect2/connect.php"; 
require_once "../../classes/Author.php";

function errorHeader($error) {
    header("Location: ../authorInsert.php?error={$error}");
}

function myHeader() {
  header("Location: ../index.php");
}

$target_dir = "../../assets/uploadsImagine/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$error = "";
$author = new Author();

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

$author ->setFirstName($_POST["fname"])
        ->setLastName($_POST["lname"])
        ->setSurname($_POST["surname"])
        ->setPhoto($_FILES["fileToUpload"]["name"]);


// Check if file already exists
if (file_exists($target_file)) {
  $author->insert();
  myHeader();
}

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  $author->insert();
  myHeader();
} else {
  $error = "Вибачте, ми не смогли загрузити файл";
  errorHeader($error);
}

myHeader();

?>
<?php else: ?>
  <?php header("Location: ../admin.php"); ?>
<?php endif; ?>