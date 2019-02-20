<?php

function uploadCover()
{
    $file = $_FILES['file']['name'];
    $max_size = 2000000;
    $size = $_FILES['file']['size'];
    $extensions = array('.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF');
    $extension = strrchr($file, '.');
    if (!in_array($extension, $extensions)) {
        $error = "Cette image n'est pas valable";
    } 
    if ($size > $max_size) {
        $error = "Le fichier est trop volumineux";
    }
    if (!isset($error)) {
        $coverKey = md5($_FILES['file']['name']) . time() . $extension;
        move_uploaded_file($_FILES['file']['tmp_name'], 'public/img/' . $coverKey);
        $cover = $coverKey;
        return $cover;
    }
}

function uploadTrack()
{
    $file = $_FILES['file2']['name'];
    $max_size = 200000000;
    $size = $_FILES['file2']['size'];
    $extensions = array('.mp3', '.MP3');
    $extension = strrchr($file, '.');
    if (!in_array($extension, $extensions)) {
        $error = "Cette musique n'est pas valable";
    }
    if ($size > $max_size) {
        $error = "Le fichier est trop volumineux";
    }
    if (!isset($error)) {
        $trackKey = md5($_FILES['file2']['name']) . time() . $extension;
        move_uploaded_file($_FILES['file2']['tmp_name'], 'public/mp3/' . $trackKey);
        $track = $trackKey;
        return $track;
    }
    
}

function uploadScreenshot()
{
    $file = $_FILES['file3']['name'];
    $max_size = 2000000;
    $size = $_FILES['file3']['size'];
    $extensions = array('.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF');
    $extension = strrchr($file, '.');
    if (!in_array($extension, $extensions)) {
        $error = "Cette image n'est pas valable";
    }
    if ($size > $max_size) {
        $error = "Le fichier est trop volumineux";
    }
    if (!isset($error)) {
        $screenshotKey = md5($_FILES['file3']['name']) . time() . $extension;
        move_uploaded_file($_FILES['file3']['tmp_name'], 'public/img/' . $screenshotKey);
        $screenshot = $screenshotKey;
        return $screenshot;
    }
    
}