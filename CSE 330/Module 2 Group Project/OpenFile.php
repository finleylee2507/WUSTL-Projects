<?php
session_start();

//Citation: https://classes.engineering.wustl.edu/cse330/index.php?title=PHP

//Check if file's name is a valid format
$file = $_POST['fileID'];
$full_path = sprintf("/home/andrew.wu/user_files/%s/%s", $_SESSION['userID'],$file);
if( !preg_match('/^[\w_\.\-]+$/', $file) ){
	echo "Invalid filename";
	exit;
}
if (!file_exists($full_path)){
	echo "File doesn't exist.";
	header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Home.php");
	exit;
}

//Get path of file and MIME type
$full_path = sprintf("/home/andrew.wu/user_files/%s/%s", $_SESSION['userID'], $file);
$finfo = new finfo(FILEINFO_MIME_TYPE); 
$mime = $finfo->file($full_path);

//Set header to MIME type of the file and display the file.
header("Content-Type: ".$mime);
readfile($full_path);
//End Citation
?>
