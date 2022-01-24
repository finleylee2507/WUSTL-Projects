<?php
require 'database.php';
session_start();
if (isset($_POST['submitComment'])){
    if(!hash_equals($_SESSION['token'], $_POST['token'])){ ///CSRF protection 
        die("Request forgery detected");
    }
    $message = $_POST['message'];
    $cid = $_POST['cid'];
    $stmt2 = $mysqli->prepare("update news.comments set message=? where cid=?");
    if(!$stmt2){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt2->bind_param('si', $message, $cid);
    $stmt2->execute();
    $stmt2->close();
    echo "Commenting...";
    header("Refresh: 0; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.php");
}
?>