<?php
ini_set("session.cookie_httponly", 1);
session_start();
require 'database2.php';
//https://classes.engineering.wustl.edu/cse330/index.php?title=AJAX_and_JSON
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str, true);
//End Citation

$eventTime = htmlentities($json_obj['eventTime']); //Reflected XSS
$event = htmlentities($json_obj['event']); //Reflected XSS
$otherUser = htmlentities($json_obj['otherUser']);
$token = $json_obj['token'];
$safe_eventTime = $mysqli->real_escape_string($eventTime); //SQL Injection Protection
$safe_event = $mysqli->real_escape_string($event); //SQL Injection Protection
$safe_uid = $mysqli->real_escape_string(trim($_SESSION['user_id'])); //SQL Injection Protection
$date = date('Y-m-d H:i:s',strtotime($safe_eventTime));

if(!hash_equals($_SESSION['token'], $token)){ //CSRF Protection
	die("Request forgery detected");
}

if (empty($otherUser)){
  $stmt = $mysqli->prepare("insert into events (datetime, content, uid) values (?, ?, ?)");
  if(!$stmt){
    echo json_encode(array(
    "success" => false,
		"message" => "Failed to add event"
    ));
    exit;
  }
  $stmt->bind_param('sss', $date, $safe_event, $safe_uid);
  $stmt->execute();

  //if no rows are affected

  if($stmt->affected_rows == 0){
    echo json_encode(array(
      "success" => false,
      "message" => "Failed to add event"
      ));
      exit;   
  } 

  $stmt->close();

  echo json_encode(array(
    "success" => true,
    "message" => "Event has been added"
  ));
  exit;
}
else {
  $stmt = $mysqli->prepare("select id from users");
  if(!$stmt){
      echo json_encode(array(
      "success" => false,
      "message" => "Query Prep Failed"
    ));
      exit;
  }
  $stmt->execute();
  $result = $stmt->get_result();
  $nameExists = false;
  //Check to see if username exists
  while($row = $result->fetch_assoc()){
    if (trim($otherUser) == trim(htmlentities($row['id']))){ ///if username is already in database
          $nameExists = true;
      }
  }
  $stmt->close();
  if (!$nameExists){
      echo json_encode(array(
          "success" => false,
          "message" => "Username Doesn't Exist"
      ));
      exit;
  }
  $stmt1 = $mysqli->prepare("insert into events (datetime, content, uid) values (?, ?, ?), (?, ?, ?)");
  if(!$stmt1){
    echo json_encode(array(
    "success" => false,
		"message" => "Failed to add event"
    ));
    exit;
  }
  $stmt1->bind_param('ssssss', $date, $safe_event, $safe_uid, $date, $safe_event, $otherUser);
  $stmt1->execute();

  //if no rows are affected

  if($stmt1->affected_rows == 0){
    echo json_encode(array(
      "success" => false,
      "message" => "Failed to add event"
      ));
      exit;   
  } 

  $stmt1->close();

  echo json_encode(array(
    "success" => true,
    "message" => "Event has been added"
  ));
  exit;
}
?>