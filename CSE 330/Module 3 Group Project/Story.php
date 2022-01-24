<?php
    date_default_timezone_set('America/Chicago');
    require 'database.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News Story</title>
    <link rel = "stylesheet"
    type = "text/css"
   	href = "StoryStyle.css" />
</head>
<body>
<form action="http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.php">
    <button type="submit">Back</button>
</form>
<?php
    //Check which story the user clicked on and display correct materials
    if(isset($_POST['var'])){
        $sid=$_POST['var']; ///variable set to story id passed by the form 
    }
    $stmt = $mysqli->prepare("select name, link, id from stories where id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('s', $sid);
    $stmt->execute();
    $stmt->bind_result($name, $link, $id);
    while($stmt->fetch()){
        echo "
        <a href=$link>
        <header>$name</header>
        </a>
        ";
        $sid = $id;
    }
    $stmt->close();
    ?>
    <?php
    //Comment box
    $php_self = htmlentities($_SERVER['PHP_SELF']); ///self submitting form
    if (isset($_SESSION['user_id'])){
        $temp = $_SESSION['token'];
        $uid = $_SESSION['user_id']; 
        ///a form embedded in text field 
        echo "<form align='center' method='POST' action='$php_self'>
        <input type='hidden' name='uid' value='$uid'>
        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <input type='hidden' name='sid' value='$sid'>
        <input type='hidden' name='var' value='$sid'> 
        <input type='hidden' name='token' value='$temp'/>
        <textarea name='message'></textarea><br>
        <button type='submit' name='commentSubmit'>Comment</button>
        </form>";
        if (isset($_POST['commentSubmit'])){
            if(!hash_equals($_SESSION['token'], $_POST['token'])){ ///safety measure to prevent CSRF
                die("Request forgery detected");
            }
            $uid = $_POST['uid'];
            $date = $_POST['date'];
            $message = $_POST['message'];
            $sid = $_POST['sid'];
            ///query comments data base and insertion 
            $stmt = $mysqli->prepare("insert into comments (uid, date, message, sid) values (?, ?, ?, ?)");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $stmt->bind_param('sssi', $uid, $date, $message, $sid);
            $stmt->execute();
            $stmt->close();
        }
    }
    //Display comment section
    $stmt = $mysqli->prepare("select uid, date, message, cid from comments where sid=? order by date");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('i', $sid);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()){
        echo "<div class='comment-box'><p>";
                echo htmlspecialchars($row['uid'])."  "; ///display user id
                echo htmlspecialchars($row['date'])."<br>"; ///display the date it's posted
                echo nl2br(htmlspecialchars($row['message'])); ///display the comment 
                $uid=$row['uid']; ///update the uid to what we fetch from table 
                //Add a delete comment button
                if (isset($_SESSION['user_id']) and $_SESSION['user_id'] == $uid){
                    $cid1 = $row['cid'];
                    $temp = $_SESSION['token']; 
                    ///self-submitting form for deletion 
                    echo "<form align='center' method='POST' action='$php_self'>
                    <input type='hidden' name='cid' value='$cid1'>
                    <input type='hidden' name='var' value='$sid'>
                    <input type='hidden' name='token' value='$temp'/>
                    <button type='submit' name='deleteComment'>Delete</button>
                    </form>";
                    if (isset($_POST['deleteComment'])){
                        if(!hash_equals($_SESSION['token'], $_POST['token'])){///CSRF protection 
                            die("Request forgery detected");
                        }
                        $cid = $_POST['cid'];
                        $stmt2 = $mysqli->prepare("delete from news.comments where cid=?");
                        if(!$stmt2){
                            printf("Query Prep Failed: %s\n", $mysqli->error);
                            exit;
                        }
                        $stmt2->bind_param('i', $cid);
                        $stmt2->execute();
                        $stmt2->close();
                        header("Refresh: 0; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.php");
                    }
                }
                //Add an edit comment button
                if (isset($_SESSION['user_id']) and $_SESSION['user_id'] == $uid){
                    $cid1 = $row['cid']; ///setting cid1 to 'cid' in the table 
                    $temp = $_SESSION['token'];
                    ///self-submitting form embedded in the edit button 
                    echo "<form align='center' method='POST' action='$php_self'>
                    <input type='hidden' name='cid' value='$cid1'>
                    <input type='hidden' name='var' value='$sid'>
                    <input type='hidden' name='token' value='$temp'/>
                    <button type='submit' name='editComment'>Edit</button>
                    </form><br>";
                    if (isset($_POST['editComment'])){
                        if(!hash_equals($_SESSION['token'], $_POST['token'])){///CSRF protection 
                            die("Request forgery detected");
                        }
                        $cid = $_POST['cid'];
                        echo "<form align='center' method='POST' action='EditComment.php'>
                        <input type='hidden' name='cid' value='$cid1'>
                        <input type='hidden' name='var' value='$sid'>
                        <input type='hidden' name='token' value='$temp'/>
                        <textarea name='message'></textarea><br>
                        <button type='submit' name='submitComment'>Submit</button>
                        </form><br>";
                    }
                }
            echo "<p></div>";
    }
    $stmt->close();
?>
</body>
</html>