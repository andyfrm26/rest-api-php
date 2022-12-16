<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'root');
define('DB', 'rest_api');

$mysqli = mysqli_connect(HOST, USER, PASS, DB) or die('Database Error');

?>