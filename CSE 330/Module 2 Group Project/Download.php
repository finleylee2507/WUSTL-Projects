<?php
session_start();
$file = basename($_GET['file']);
$dir = '/home/andrew.wu/user_files/'.$_SESSION['userID'].'/'.$file;

//Citation: https://stackoverflow.com/questions/12094080/download-files-from-server-php
if(!file_exists($dir)){
    die('file not found');
} else {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");
    readfile($dir);
}
//End Citation
?>