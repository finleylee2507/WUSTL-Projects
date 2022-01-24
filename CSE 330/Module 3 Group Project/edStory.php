<?php
require 'database.php';
session_start();
if(!hash_equals($_SESSION['token'], $_POST['token'])){///CSRF protection
    die("Request forgery detected");
}
$title = $_POST['title'];
$link = $_POST['link'];
$id=$_POST['id'];
$stmt = $mysqli->prepare("update news.stories set name=?, link=? where id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('ssi', $title, $link, $id);
$stmt->execute();
$stmt->close();
echo "Editing...";
header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.php");
exit;
?>