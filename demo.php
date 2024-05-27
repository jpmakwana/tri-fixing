<?php
$targetDirectory = "uploads/"; // Change this to your desired directory
$uploadedFiles = [];

if (!empty($_FILES['images']['name'][0])) {
  foreach ($_FILES['images']['name'] as $key => $name) {
    $targetFile = $targetDirectory . basename($name);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file already exists
    if (file_exists($targetFile)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES['images']['size'][$key] > 5000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow only certain file formats
    $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowedFormats)) {
      echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
      $uploadOk = 0;
    }

    // Upload the file if everything is ok
    if ($uploadOk == 1) {
      if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFile)) {
        $uploadedFiles[] = $targetFile;
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }

  // Display uploaded images on the frontend
  foreach ($uploadedFiles as $file) {
    echo "<img src='$file' alt='Uploaded Image'>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Multiple Image Upload</title>
</head>

<body>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="images[]" multiple>
    <input type="submit" value="Upload Images">
  </form>
</body>

</html>