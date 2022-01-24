<?php
ini_set("session.cookie_httponly", 1);
session_start();
require 'database2.php';
//https://classes.engineering.wustl.edu/cse330/index.php?title=AJAX_and_JSON
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str, true);
//End Citation

$uid = $mysqli->real_escape_string(trim($_SESSION['user_id'])); //SQL Injection Protection
$eid = $mysqli->real_escape_string($json_obj['eid']); //SQL Injection Protection
$token = $json_obj['token'];

if(!hash_equals($_SESSION['token'],$token)){ //CSRF Protection
	die("Request forgery detected");
}

$stmt = $mysqli->prepare("delete from calendar.events where uid=? and eid=?");

if(!$stmt){
    echo json_encode(array(
    "success" => false,
		"message" => "Failed to delete event"
    )); 
    exit;
}
$stmt->bind_param('ss',$uid,$eid);
$stmt->execute();
//if no rows are affected(event doesn't exist) 

if($stmt->affected_rows == 0){
  echo json_encode(array(
    "success" => false,
		"message" => "Event doesn't exist"
    ));
    exit;   
} 

$stmt->close();
echo json_encode(array(
    "success" => true,
    "message" => "Event has been deleted"
));
exit;
?>