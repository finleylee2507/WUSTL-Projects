<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link rel = "stylesheet"
    type = "text/css"
   	href = "HomeStyle.css" />
</head>
<body>
<p>File Directory - Click on a file to download it.</p>
<?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $dir = '/home/andrew.wu/user_files/'.$_SESSION['userID'];
        //lists all files in the user's directory
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                while (($file = readdir($dh)) !== false){
                    if ($file == '.' or $file == '..') continue;
                    echo "<a href='Download.php?file=".$file."'>".$file."</a>\n"."<br>";
                }
            }
        }
    }
?>
<!--Adds an upload file button and sumbit button-->
<form enctype="multipart/form-data" action="uploader.php" method="POST">
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
            <label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
            <input type="submit" value="Upload File" />
        </p>
</form>
<!--Adds a way to choose which file to open-->    
<form action="OpenFile.php" method = "post">
    <p>
        <label for="openfile_input">Enter name of file to open (include extension):</label>
        <input type = "text" name="fileID" placeholder = "Enter name" id="openFile" />
        <input type="submit" value="Open" />
    </p>
</form>

<!-- form to delete a file -->
<form action="DeleteFile.php" method = "post">
    <p>
        <label for="deletefile_input">Enter name of file to delete (include extension):</label>
        <input type = "text" name="fileID" placeholder = "Enter name" id="deleteFile" />
        <input type="submit" value="Delete" />
    </p>
</form>

<!-- form to rename a file -->
<form action="RenameFile.php" method = "post">
    <p>
        <label for="rename_input">Enter name of file to rename (use same extension):</label>
        <input type = "text" name="oldName" placeholder = "Old name" id="oldFile" />
        <input type = "text" name="newName" placeholder = "New name" id="newFile" />
        <input type="submit" value="Rename" />
    </p>
</form>

<!-- form to logout user -->
<form action="Logout.php" method = "post">
    <p>
        <input type="submit" value="Logout">
    </p>
</form>
</body>
</html>