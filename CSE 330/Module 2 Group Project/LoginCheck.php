<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LoginCheck</title>
</head>
<body>
<?php
    $user = $_POST['username'];
    //checks if username is a valid format
    if( !preg_match('/^[\w_\-]+$/', $user) ){
        echo "Invalid username";
        header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/FileSharingHome.html");
        exit;
    }
    //checks if the username matches one of the users in users.txt and redirects to that user's homepage
    $file = fopen("/home/andrew.wu/users.txt", "r");
    while(!feof($file)) {
        $line = fgets($file);
        if (trim($line) == trim($user)){
            echo $line. "<br>";
            $_SESSION['userID'] = $user;
            $_SESSION['loggedin'] = true;
            header("Location: Home.php");
            exit();
        }
    }
    fclose($file);
    echo "Username not found.";
    header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/FileSharingHome.html");
    exit
?>
</body>
</html>