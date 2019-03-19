<?php
function redirectWithMessage($message, $pageName){
    $_SESSION['message'] = $message;
    header("Location: ./$pageName");
    die();
    
}

// function getDB(){
//     $host = '127.0.0.1'; //localhost
//     $db   = 'gallery';
//     $user = 'root';
//     $pass = '';
//     $charset = 'utf8';

//     $connectionDetails = "mysql:host=$host;dbname=$db;charset=$charset";

//     $pdo = new PDO($connectionDetails, $user, $pass);
//     return $pdo;
// }

function getDB(){
    $host = '127.0.0.1'; //localhost
    $db   = 'spiewako_galeria';
    $user = 'spiewako_galeria';
    $pass = 'Magazyn1234567!';
    $charset = 'utf8';

    $connectionDetails = "mysql:host=$host;dbname=$db;charset=$charset";

    $pdo = new PDO($connectionDetails, $user, $pass);
    return $pdo;
}

function getAllPictures(){
    $db = getDB();
    $query = $db->query("SELECT * FROM pictures");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getOurPrivatePicturesOrPublicPictures(){
    $db = getDB();
    $query = $db->prepare("SELECT * FROM pictures WHERE (userId=? AND isPrivate = 1) OR isPrivate = 0");
    $query->execute([$_SESSION['user']['id']]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}