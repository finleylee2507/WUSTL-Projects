<?php
ini_set("session.cookie_httponly", 1);
session_start();
require 'database2.php';
//https://classes.engineering.wustl.edu/cse330/index.php?title=AJAX_and_JSON
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str, true);
//End Citation

$eventTime2 = htmlentities($json_obj['eventTime2']); //Reflected XSS
$content2 = htmlentities($json_obj['content2']); //Reflected XSS
$eid = $mysqli->real_escape_string($json_obj['eid']); //SQL Injection Protection
$uid = $mysqli->real_escape_string(trim($_SESSION['user_id'])); //SQL Injection Protection
$token = $json_obj['token'];

if(!hash_equals($_SESSION['token'], $token)){ //CSRF Protection
	die("Request forgery detected");
}
if (!empty($eventTime2) && !empty($content2)){
    $date2 = date('Y-m-d H:i:s',strtotime($eventTime2));
    $stmt = $mysqli->prepare("update events set content=?, datetime=? where uid=? and eid=?");

    if(!$stmt){
        echo json_encode(array(
        "success" => false,
        "message" => "Failed to edit event"
        ));
        exit;
    }
    $stmt->bind_param('sssi', $content2, $date2, $uid, $eid);
    $stmt->execute();
    //if no rows are affected(event doesn't exist) 

    if($stmt->affected_rows == 0){
      echo json_encode(array(
        "success" => false,
        "message" => "Event doesn't exist"
        ));
        exit;   
    } 

    echo json_encode(array(
        "success" => true,
        "message" => "Event has been edited"
    ));
    exit;
    $stmt->close();
}
else if (empty($eventTime2) && !empty($content2)){
    $stmt = $mysqli->prepare("update events set content=? where uid=? and eid=?");

    if(!$stmt){
        echo json_encode(array(
        "success" => false,
        "message" => "Failed to edit event"
        ));
        exit;
    }
    $stmt->bind_param('ssi', $content2, $uid, $eid);
    $stmt->execute();
    //if no rows are affected(event doesn't exist) 

    if($stmt->affected_rows == 0){
      echo json_encode(array(
        "success" => false,
        "message" => "Event doesn't exist"
        ));
        exit;   
    } 

    echo json_encode(array(
        "success" => true,
        "message" => "Event has been edited"
    ));
    exit;
    $stmt->close();
}
else {
    $date2 = date('Y-m-d H:i:s',strtotime($eventTime2));
    $stmt = $mysqli->prepare("update events set datetime=? where uid=? and eid=?");

    if(!$stmt){
        echo json_encode(array(
        "success" => false,
        "message" => "Failed to edit event"
        ));
        exit;
    }
    $stmt->bind_param('ssi', $date2, $uid, $eid);
    $stmt->execute();
    //if no rows are affected(event doesn't exist) 

    if($stmt->affected_rows == 0){
      echo json_encode(array(
        "success" => false,
        "message" => "Event doesn't exist"
        ));
        exit;   
    } 

    echo json_encode(array(
        "success" => true,
        "message" => "Event has been edited"
    ));
    exit;
    $stmt->close();
}
?>