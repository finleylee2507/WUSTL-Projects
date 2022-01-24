<?php
ini_set("session.cookie_httponly", 1);
session_start();
require 'database2.php';
//https://classes.engineering.wustl.edu/cse330/index.php?title=AJAX_and_JSON
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str, true);
//End Citation

$user = $mysqli->real_escape_string(trim($_SESSION['user_id']));
$sharedUser = $mysqli->real_escape_string(trim($json_obj['user_id'])); //SQL Injection Protection
$eid = $mysqli->real_escape_string($json_obj['eid']); //SQL Injection Protection
$token = $json_obj['token'];

if(!hash_equals((string)$_SESSION['token'],(string)$token)){ //CSRF Protection
	die("Request forgery detected");
}

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
//Check to see if username is available
while($row = $result->fetch_assoc()){
	if (trim($eid) == trim(htmlentities($row['id']))){ ///if username is already in database
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
else {
    ///first query to extract 
    $stmt1 = $mysqli->prepare("select content, datetime from events where eid=? and uid=?");

    if(!$stmt1){
        echo json_encode(array(
        "success" => false,
        "message" => "Failed to share event"
        )); 
        exit;
    }
    $stmt1->bind_param('ss',$eid, $user);
    $stmt1->execute();
    //if no rows are affected(event doesn't exist) 
    $result = $stmt1->get_result();
    $resultArray = array();

    ///store results into an array 
    while($row = $result->fetch_assoc()){
        if($row["content"] != null){
            array_push($resultArray, htmlentities($row["content"]));
            array_push($resultArray, htmlentities($row["datetime"]));
        }
    }

    $event=$resultArray[0];
    $dateTime=$resultArray[1];
    $stmt1->close();

    ///second query to insert
    $stmt2 = $mysqli->prepare("insert into events (datetime, content, uid) values (?, ?, ?)");

    if(!$stmt2){
        echo json_encode(array(
        "success" => false,
        "message" => "Failed to share event"
        )); 
        exit;
    }
    $stmt2->bind_param('sss',$dateTime,$event,$sharedUser);
    $stmt2->execute();



    if($stmt2->affected_rows == 0){
    echo json_encode(array(
        "success" => false,
        "message" => "Event doesn't exist"
        ));
        exit;   
    } 

    $stmt2->close();
    echo json_encode(array(
        "success" => true,
        "message" => "Event has been shared"
    ));
    exit;
}

?>