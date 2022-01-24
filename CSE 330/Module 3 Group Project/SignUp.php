<?php
require 'database.php';

$user = $_POST['username'];
if( !preg_match('/^[\w_\-]+$/', $user) ){ ///check validity of username 
    echo "Invalid username";
    header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.html");
    exit;
}
$pass = $_POST['password'];
if( !preg_match('/^[\w_\-]+$/', $pass) ){ ///check validity of password
    echo "Invalid password";
    header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.html");
    exit;
}

//https://classes.engineering.wustl.edu/cse330/index.php?title=PHP_and_MySQL
$stmt = $mysqli->prepare("select id from users");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();
$result = $stmt->get_result();
//Check to see if username is available
while($row = $result->fetch_assoc()){
	if ($user == $row['id']){ ///if username is already in database
        echo "Username already exists";
        header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.php");
        exit;
    }
    else{
        $hash_pass = password_hash($pass, PASSWORD_BCRYPT); ///create a password hash
        $stmt = $mysqli->prepare("insert into users (id, hashed_pass) values (?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('ss', $user, $hash_pass);
        $stmt->execute();
        $stmt->close();
//End of Citation
        echo "Succesfully Registered! Please Login on the Homepage.";
        header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.php");
        exit;
    }
}
?>