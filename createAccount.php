<?php
session_start();
function getOld($value){
    if(isset($_SESSION['old'])){
        return $_SESSION['old'][$value];
    }
    return '';
}
function destroyOld(){
    if(isset($_SESSION['old'])){
        unset($_SESSION['old']);
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create_account</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
        crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
    <div class="row">
        
        <div class="offset-4 col-4 loginCard">
            <div class="card text-center" style="width: 21rem;">
                <i class="fas fa-camera-retro fa-5x"></i>
                <div>
                <?php 
                if (isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
              }
                ?>
                </div>

                <div class="card-body">
                    <form method="POST" action="registration.php">
                        <div class="form-group">
                            <input type="text" name="name" value="<?php  echo getOld('name');?>" class="form-control" id="exampleInputPassword1" placeholder="Name">
                            <div class="form-group"></div>
                            <input type="email" name="email" value="<?php echo getOld('email');?>"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="Enter email">
                            </div>
                            <?php destroyOld(); ?>
                            <div class="form-group">

                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                <div class="form-group"></div>
                                <input type="password" name="passwordRepeat" class="form-control" id="exampleInputPassword1" placeholder="Password">

                            </div>

                            <div class="form-check">
                                
                            </div>
                            <button type="submit" class="btn btn-dark">Create</button>
                            

                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

</html>