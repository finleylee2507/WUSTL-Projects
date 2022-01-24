<?php
//https://classes.engineering.wustl.edu/cse330/index.php?title=PHP_and_MySQL
$mysqli = new mysqli('localhost', 'php_user', 'password', 'news');

if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
//End of citation
?>