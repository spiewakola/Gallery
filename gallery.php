<?php
session_start();
require_once 'functions.php';
if (!isset($_SESSION['user'])){
    redirectWithMessage('aby zobaczyć tą stronę musisz się zalogować','signin.php');

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gallery_main</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
</head>

<body>


<a href='logout.php'>Log out</a>
<div class="container-fluid">
    <h1>YOUR GALLERY</h1>
    <?php if (isset($_SESSION['message'])):?>
    <div class="alert alert-info" role="alert">
  <?php 
    echo $_SESSION['message'];
    unset($_SESSION['message']);
  
  ?>
</div>
<?php  endif; ?> 
    <div class="row">
    <?php foreach (getOurPrivatePicturesOrPublicPictures() as $picture):?>
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="<?php echo $picture['imageFile'] ?>"  alt="">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $picture['imageTitle'] ?></h5>
                    <p class="card-text"><?php echo $picture['imageDescription'] ?></p>
                    <form method="POST" action="delete.php">
                    <button type="submit" name="delete" value="<?php echo $picture['id'] ?>" class="btn btn-dark">Delete </button>
                </form>
                </div>
            </div>
        </div>
<?php endforeach; ?>
    </div>
</div>
            


        
           
                
                
                    <div class="container-fluid mt-5">
                    <div class="row">
                        
                        <div class="col-4 offset-4" id="cards">
                            <div class="card" style="width: 21rem;">
                                <i class="fas fa-camera-retro fa-5x"></i>
                                <div class="card-body">

                               
                                    <form enctype="multipart/form-data" action="upload.php" method="post">
                                        
                                            
                                            <div class="form-group">
                                            <input name="imageTitle" type="text" class="form-control" placeholder="Image title">
                                            </div>
                                            <div class="form-group">
                
                                                <input name="imageDesciption" type="text" class="form-control" placeholder="Image description">
                                                
                                                
                
                                            </div>
                                            <div class="form-group">
                                            <input name="uploadFile" type="file" placeholder="Upload file">
                                            </div>
                
                                            
                                                
                                            <div class="form-group form-check">
                                                <input name="checkBoxPrivate" type="checkbox" class="form-check-input" id="checkbox-private">
                                                <label class="form-check-label" for="checkbox-private">Private</label>
                                            </div>
                                            <button name="submit" type="submit" class="btn btn-dark">UPLOAD</button>
                                            
                
                                    </form>
                
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    </div>
                    </div>
                
              

        </div>








    </div>

</body>

</html>