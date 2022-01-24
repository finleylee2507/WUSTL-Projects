<?php
session_start();
session_destroy();
echo "Logging out...";
header("refresh:2; url = http://ec2-18-218-144-7.us-east-2.compute.amazonaws.com/~andrew.wu/Homepage.php");
exit
?>