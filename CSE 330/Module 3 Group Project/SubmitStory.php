<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Submit Story</title>
    <link rel = "stylesheet"
    type = "text/css"
   	href = "StoryStyle.css" />
</head>
<body>




<form enctype="multipart/form-data" action="subStory.php" method="POST">
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
            <input type="text" name="title" placeholder = "Enter title" id="title"/>
            <input type="text" name="link" placeholder = "Enter link" id="link"/>
            <input type="hidden" name='uid' value='<?php echo $_SESSION['user_id'];?>'/>
            <input type='hidden' name='token' value='<?php echo $_SESSION['token']; ?>'/>
            <input type="submit" value="Submit Story" />
        </p>
</form>

</body>
</html>