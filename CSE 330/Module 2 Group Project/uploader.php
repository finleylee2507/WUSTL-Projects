<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

<?php
session_start();
//Citation: https://classes.engineering.wustl.edu/cse330/index.php?title=PHP
// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}

// Get the username and make sure it is valid
if( !preg_match('/^[\w_\-]+$/', $_SESSION['userID']) ){
	echo "Invalid username";
	exit;
}
//End Citation

// Moving the file to the correct directory
$full_path = sprintf("/home/andrew.wu/user_files/%s/%s", $_SESSION['userID'], $filename);

if (file_exists($full_path)){
	echo "Sorry, file already exists.";
	header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Home.php");
	exit;
}
else{
	if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
		echo "Upload Success!";
		header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Home.php");
		exit;
	}
	else
	{
		echo "Upload Failed.";
		header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Home.php");
		exit;
	}
}
?>
</body>
</html>