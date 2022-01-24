<?php 
ini_set("session.cookie_httponly", 1);
session_start();
require 'database2.php';
header("Content-Type: application/json");
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str, true);

$user = $mysqli->real_escape_string($_SESSION['user_id']);

$stmt = $mysqli->prepare("select datetime, content, eid from events where uid=?");

if(!$stmt){
    echo json_encode(array(
		"success" => false,
		"message" => "No Events"
	   ));
    exit;
}

$stmt->bind_param('s', $user);
$stmt->execute();
$result = $stmt->get_result();
$eventArray = array();
while($row = $result->fetch_assoc()){
    if($row["content"] != null){
        array_push($eventArray, htmlentities($row["datetime"]));//store event datetime
        array_push($eventArray, htmlentities($row["content"]));//store event content
        array_push($eventArray, htmlentities($row["eid"])); //store event id
    }
}
if (count($eventArray) > 0){
    echo json_encode(array(
        "success" => true,
        "message" => $eventArray
    ));
    exit;
}
else {
    echo json_encode(array(
        "success" => false,
        "message" => "No Events"
    ));
    exit;
}
$stmt->close();
?>
