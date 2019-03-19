<?php
session_start();
require_once "functions.php";

if(isset($_POST['delete'])){
    $db = getDB();
    $sql = "DELETE  FROM pictures WHERE id = ?";
    $query= $db->prepare($sql);
    $result = $query->execute([$_POST['delete']]);
    if($result){
        redirectWithMessage("photo deleted", "gallery.php");
    }else{
        redirectWithMessage("zdjęcie nie zostało usunięte", "gallery.php");
    }
}