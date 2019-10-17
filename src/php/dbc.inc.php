<?php 

DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_USER', 'test2');
DEFINE ('DB_PASS', 'password');
DEFINE ('DB_NAME', 'database');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) OR die('Could not connect to SQL Server '. mysqli_connect_error());


 ?>