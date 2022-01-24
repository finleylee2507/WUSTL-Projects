<?php
require 'database.php';
session_start();
if(!hash_equals($_SESSION['token'], $_POST['token'])){///CSRF protection
    die("Request forgery detected");
}
$title = $_POST['title'];
$link = $_POST['link'];
$uid=$_POST['uid'];
$stmt = $mysqli->prepare("insert into stories (name, link,uid) values (?, ?,?)");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('sss', $title, $link,$uid);
$stmt->execute();
$stmt->close();
echo "Submitting...";
header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.php");
exit;
?>