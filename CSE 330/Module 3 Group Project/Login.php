<?php
session_start();
require 'database.php';
//https://classes.engineering.wustl.edu/cse330/index.php?title=Web_Application_Security,_Part_2#Password_Security
$stmt = $mysqli->prepare("SELECT COUNT(*), id, hashed_pass FROM users WHERE id=?");

$stmt->bind_param('s', $user);
$user = $_POST['username'];
if( !preg_match('/^[\w_\-]+$/', $user) ){
    echo "Invalid Username";
    header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.php");
    exit;
}
$stmt->execute();

$stmt->bind_result($cnt, $user_id, $pwd_hash);
$stmt->fetch();

//Compare submitted password to hashed password
$pass = trim($_POST['password']);
if( !preg_match('/^[\w_\-]+$/', $pass) ){
    echo "Invalid Password";
    header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.php");
    exit;
}
//If username doesn't exist
if($cnt == 0){
    echo "Invalid Username";
    header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.php");
    exit;
}
if($cnt == 1 && password_verify($pass, $pwd_hash)){ ///if one result 
    echo "Login Succeded!";
    $_SESSION['user_id'] = $user_id;
    header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.php");
    exit;
} else{   ///more than one result
    echo "Invalid Password";
    header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.php");
    exit;
}
//End Citation
?>