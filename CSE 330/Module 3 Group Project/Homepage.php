<?php
    session_start();
    require 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel = "stylesheet"
    type = "text/css"
   	href = "FrontStyle.css" />
</head>
<body>
    <header>News&trade;</header>
    <?php
    //Check to see if a user is logged in or not
    if(isset($_SESSION['user_id'])){
        echo '<p id = "logged">Logged in as: '.$_SESSION['user_id'].'</p>';
        echo  ///button for story submission
        '<form id="substory" action="http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/SubmitStory.php">
            <input type="submit" value="Submit a Story" />
        </form>';
        echo ///button for logout 
        '<form id="logout" action="LogoutUser.php" method = "post">
        <p>
        <input type="submit" value="Logout">
        </p>
        </form>';
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
    else{ 
        echo ///button for login +register 
        '<form id="login" action="http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/LoginPage.html">
            <input type="submit" value="Login" />
        </form>  
        <form id="register" action="http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/SignUpPage.html">
            <input type="submit" value="Register" />
        </form>';
    }
    //Display stories, https://classes.engineering.wustl.edu/cse330/index.php?title=PHP_and_MySQL
    $stmt = $mysqli->prepare("select name, id,uid from stories");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->bind_result($name, $sid, $uid);
    //End citation
    echo "<ul>\n";
    while($stmt->fetch()){ ///displaying stories and embed form within 
        ?>  
        <form align = 'center' id= 'picture' action="Story.php" method = "post">
        <input type='hidden' name='var' value='<?php echo "$sid";?>'/>
        <label class='notalink'>
            <input type='submit' value="Submit" class="invisibutton">
            <div class="text-block">
            <p><?php echo $name; ?></p>
            </div></label>
        </form> 
         <?php
        //Delete story
         if (isset($_SESSION['user_id']) and $_SESSION['user_id'] == $uid){
            $temp = $_SESSION['token'];
            echo "<form align = 'center' method='POST' action='deleteStory.php'>
            <input type='hidden' name='uid' value='$uid'>
            <input type='hidden' name='sid' value='$sid'>
            <input type='hidden' name='name' value='$name'>
            <input type='hidden' name='token' value='$temp'/>
            <button type='submit' name='deleteStory'>Delete</button>
            </form>";
         }
         //Edit story
         if (isset($_SESSION['user_id']) and $_SESSION['user_id'] == $uid){
            $temp = $_SESSION['token'];
            echo "<form align = 'center' method='POST' action='EditStory.php'>
            <input type='hidden' name='sid' value='$sid'>
            <input type='hidden' name='name' value='$name'>
            <input type='hidden' name='token' value='$temp'/>
            <button type='submit' name='editStory'>Edit</button>
            </form>";
         }
         ?>
    <?php
    }
    echo "</ul>\n";
    $stmt->close();
    ?>
</form>
</body>
</html>