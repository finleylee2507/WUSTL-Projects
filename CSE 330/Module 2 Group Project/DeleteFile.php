<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
 <?php

///Citation: https://stackoverflow.com/questions/4952194/deleting-a-server-file

session_start();

///make sure that fileID is valid
$file = $_POST['fileID'];
if( !preg_match('/^[\w_\.\-]+$/', $file) ){
	echo "Invalid filename";
	exit;
}

///get the path of the file and delete
$full_path = sprintf("/home/andrew.wu/user_files/%s/%s", $_SESSION['userID'],$file);

if (file_exists($full_path)){
    if(unlink($full_path)){
       echo "File deleted";
       header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Home.php");
	exit;
    }
}else{
     echo "File does not exist";
     header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Home.php");
	exit;
}
///End citation
?>
</body>
</html>