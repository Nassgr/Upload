<?php
/**
 * Created by PhpStorm.
 * User: wilder14
 * Date: 16/04/18
 * Time: 14:38
 */
if (file_exists("upload/" . $_POST['id'])) {
    unlink("upload/" . $_POST['id']);
    header('Location: index.php');
    exit();
}