<?php
$user = $_POST['username'];
//checks if username is a valid format
if( !preg_match('/^[\w_\-]+$/', $user) ){
    echo "Invalid username";
    header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/FileSharingHome.html");
    exit;
}

//add user to users.txt

//checks if user already exists
$file = fopen("/home/andrew.wu/users.txt", "r");
while(!feof($file)) {
    $line = fgets($file);
    if (trim($line) == trim($user)){
        echo "User already exists";
        header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/FileSharingHome.html");
        exit;
    }
}
fclose($file);
$old_users = file_get_contents('/home/andrew.wu/users.txt');

if ($file = fopen('/home/andrew.wu/users.txt', 'a')){
    fwrite($file, "\n".$user);
    fclose($file);

    //add that user's own folder
    chdir('/home/andrew.wu/user_files');
    mkdir($user);

    echo "User succesfully created.";
    header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/FileSharingHome.html");
    exit;
}
else{
    echo "Error, failed to add user to list.";
}
?>