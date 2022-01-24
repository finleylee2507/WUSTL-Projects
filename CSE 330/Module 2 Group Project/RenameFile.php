<?php
session_start();
//changes directory to the location of the files
chdir('/home/andrew.wu/user_files/'.$_SESSION['userID']);
$oldName = $_POST['oldName'];
$newName = $_POST['newName'];
$full_path = sprintf("/home/andrew.wu/user_files/%s/%s", $_SESSION['userID'],$oldName);

//filter input
if( !preg_match('/^[\w_\.\-]+$/', $oldName) ){
	echo "Invalid filename";
	exit;
}
if( !preg_match('/^[\w_\.\-]+$/', $newName) ){
	echo "Invalid filename";
	exit;
}
//checks if file exists
if (!file_exists($full_path)){
	echo "File doesn't exist.";
	header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Home.php");
	exit;
}
//renames file
rename($oldName, $newName);
echo $oldName." renamed to: ".$newName;
header("refresh:3; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Home.php");
exit;
?>