<?php 
ini_set("session.cookie_httponly", 1);
session_start();
require 'database2.php';
header("Content-Type: application/json");
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str, true);

$user = $mysqli->real_escape_string($_SESSION['user_id']);
$yearVar = $mysqli->real_escape_string($json_obj['yearVar']);
$monthVar = $mysqli->real_escape_string($json_obj['monthVar']) + 1 + "";
$dayVar =  $mysqli->real_escape_string($json_obj['dayVar']);

$stmt = $mysqli->prepare("select content, cast(datetime as time) from events where uid=? and year(datetime)=? and month(datetime)=? and day(datetime)=?");

if(!$stmt){
    echo json_encode(array(
		"success" => false,
		"message" => "No Events"
	   ));
    exit;
}

$stmt->bind_param('ssss', $user, $yearVar, $monthVar, $dayVar);
$stmt->execute();
$result = $stmt->get_result();
$eventArray = array();
while($row = $result->fetch_assoc()){
    if($row["content"] != null){
        array_push($eventArray, htmlentities($row["content"]));
        array_push($eventArray, htmlentities($row["cast(datetime as time)"]));
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
