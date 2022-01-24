<?php
require 'database.php';
session_start();
if(!hash_equals($_SESSION['token'], $_POST['token'])){///CSRF protection
    die("Request forgery detected");
}
$sid = $_POST['sid'];
//Delete comments on that story
$stmt2 = $mysqli->prepare("delete from news.comments where sid=?");
if(!$stmt2){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt2->bind_param('i', $sid);
$stmt2->execute();
$stmt2->close();

//Delete story
$stmt3 = $mysqli->prepare("delete from news.stories where id=?");
if(!$stmt3){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt3->bind_param('i', $sid);
$stmt3->execute();
$stmt3->close();

echo "Deleting...";
header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.php");
exit;
?>