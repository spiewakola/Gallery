<?php
session_start();
require_once 'functions.php';

function checkEmail(){
    $db = getDB();
    $email=$_POST['email'];
    $query1 = $db->prepare("SELECT id, name FROM users WHERE email=?");
    $query1->execute([$email]);
    return $query1->fetch(PDO::FETCH_ASSOC);
}
function addUserToDatabase(){
     $db = getDB();
    $sql = "INSERT INTO users (name, email, password) VALUES (?,?,?)";
    $query= $db->prepare($sql);
    $password=md5($_POST['password']);
    
     $result = $query->execute([$_POST['name'], $_POST['email'],$password]);
     return $result;
     
}




if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['passwordRepeat'])){
    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])&& !empty($_POST['passwordRepeat'])){
       $_SESSION['old']=[
        'name' => $_POST['name'],
        'email' => $_POST['email'],
       ];
        if($_POST['password']==$_POST["passwordRepeat"]){
            $query1=checkEmail();
                if($query1 == false){

           
           
                    if (strlen($_POST['password'])>=8 ){
                    $result= addUserToDatabase();
                        if ($result == true){
                        redirectWithMessage('ok','signin.php');
                        
                
            }else{
                redirectWithMessage('coś poszło nie tak','createAccount.php');
            }
        }else{
            redirectWithMessage('hasło musi być większe niż 8 znaków','createAccount.php');
        }
        }else{
            
            redirectWithMessage('podany email istnieje w bazie','createAccount.php');
        }
       }else{
        redirectWithMessage('hasła nie są identyczne','createAccount.php');
        }
    }else{
        redirectWithMessage('formularz wypełniony nieprawidłowo','createAccount.php');
    }

}
