<?php
/**
 * Created by PhpStorm.
 * User: wilder14
 * Date: 04/04/18
 * Time: 16:14
 */

if(!empty($_FILES)) {

    $fileName = $_FILES['files']['name'];
    $fileType = $_FILES['files']['type'];
    $fileTmpName = $_FILES['files']['tmp_name'];
    $fileSize = $_FILES['files']['size'];
    $fileError = $_FILES['files']['error'];

    $file_extension = strrchr($fileName,".");
    $autorised_extension = array('image/jpg', 'image/gif', 'image/png', 'image/jpeg');

    $upload_max_filesize = 1048576;
    $uploadDir = 'upload/' .$fileName;

    if(in_array($fileType, $autorised_extension)) {
        echo 'Le format du fichier est : ' .$file_extension;

        if($fileError === 0){

            if($fileSize <= $upload_max_filesize){
                echo ' La taille du fichier est de ' .$fileSize. ' octets ';

                if(move_uploaded_file($_FILES['files']['tmp_name'], $uploadDir)) {
                    echo 'Le fichier a été téléchargé avec succès';
                }
            }else{
                echo 'La taille de l\'image est trop volumineuse';
            }
        }else{
            echo 'Une erreur est survenue lors du téléchargement de l\'image';
        }
    }else {
        echo 'Le format du fichier doit être .jpg, .gif, .png ';
    }
}

$directory = 'upload/';
$listUpload = new FilesystemIterator($directory);

if(isset($_POST['delete'])) {
    unlink('upload/' . $_POST['delete']);
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Upload</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="files" multiple="multiple"/>
        <input type="submit" value="Upload" />
    </form>
    <div class="row">
        <?php foreach ($listUpload as $image): ?>
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="<?= $image ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"></p>
                    <a href="" class="btn btn-danger">Delete</a>
                </div>
            </div>
        <?php endforeach?>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

