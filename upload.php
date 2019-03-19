<?php
session_start();
require_once "functions.php";

if(isset($_POST['imageTitle']) && isset($_POST['imageDesciption']) && isset($_FILES['uploadFile'])){
    $target_dir = "uploads/";
    $file=$_FILES["uploadFile"];
    $target_file = $target_dir .bin2hex(random_bytes(5))."_".basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    if(isset($_POST["submit"])) {
        $check = getimagesize($file["tmp_name"]);
        if($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
 
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    if ($file["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $db = getDB();
            $sql = "INSERT INTO pictures (imageTitle, imageDescription, imageFile, userId, isPrivate) VALUES (?,?,?,?,?)";
            $query= $db->prepare($sql);
            $isPrivate = (isset($_POST['checkBoxPrivate']))?1:0;
            $result = $query->execute([$_POST['imageTitle'], $_POST['imageDesciption'],$target_file,$_SESSION['user']['id'],$isPrivate]);   
            if($result){
                redirectWithMessage('zdjęcie zostało dodane','gallery.php');
            }else{
                redirectWithMessage('zdęcie niestety nie zostało dodane','gallery.php');
            }



        }