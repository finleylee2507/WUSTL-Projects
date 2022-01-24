<?php
session_start();
$sid = $_POST['sid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Story</title>
    <link rel = "stylesheet"
    type = "text/css"
   	href = "StoryStyle.css" />
</head>
<body>
<form enctype="multipart/form-data" action="edStory.php" method="POST">
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
            <input type="text" name="title" placeholder = "New title" id="title"/>
            <input type="text" name="link" placeholder = "New link" id="link"/>
            <input type="hidden" name='id' value='<?php echo $sid;?>'/>
            <input type='hidden' name='token' value='<?php echo $_SESSION['token']; ?>'/>
            <input type="submit" value="Edit Story" />
        </p>
</form>

</body>
</html>