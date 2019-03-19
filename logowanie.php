<?php
session_start();
require_once 'functions.php';



function checkUserFromDatabase(){
    if(isset($_POST["email"]) && isset($_POST["password"])){  
        $db = getDB();
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        $query = $db->prepare("SELECT id, name FROM users WHERE email=? AND password=?");
        $query->execute([$email, $password]); 
        return $query->fetch(PDO::FETCH_ASSOC);


$databeaseResult = checkUserFromDatabase();
if ($databeaseResult == NULL){
    redirectWithMessage('login and password incorrect','signin.php');
}else{
    $_SESSION['user']= [
        'id' => $databeaseResult['id']
    ];
    redirectWithMessage('login and password correct','gallery.php');

} 





   