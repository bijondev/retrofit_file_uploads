<?php
$target_dir = "uploads/";
$target_file = $target_dir . time().basename($_FILES["upload_image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$data['msg']="";
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["upload_image"]["tmp_name"]);
  if($check !== false) {
    $data['msg']= "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $data['msg']= "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $data['msg']= "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["upload_image"]["size"] > 500000) {
  $data['msg']= "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $data['msg']= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //$data['msg']= "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
	echo json_encode($data); die;
} else {
  if (move_uploaded_file($_FILES["upload_image"]["tmp_name"], $target_file)) {
    $data['msg']= "The file ". htmlspecialchars( basename( $_FILES["upload_image"]["name"])). " has been uploaded.";
  } else {
    $data['msg']= "Sorry, there was an error uploading your file.";
  }
}
echo json_encode($data);
?>