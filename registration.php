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
                        redirectWithMessage('ok','gallery.php');
                        
                
            }else{
                redirectWithMessage('something wants wrong','createAccount.php');
            }
        }else{
            redirectWithMessage('passwors should contains more than 8 chars','createAccount.php');
        }
        }else{
            
            redirectWithMessage('this mail already exist in database','createAccount.php');
        }
       }else{
        redirectWithMessage('passwords are different','createAccount.php');
        }
    }else{
        redirectWithMessage('fill all inputes','createAccount.php');
    }

}
