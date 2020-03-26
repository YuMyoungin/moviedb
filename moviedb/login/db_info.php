<?php
	$mysql_hostname = 'localhost';
    $mysql_username = 'root';
    $mysql_password = '';
    $mysql_database = 'moviedb';

    $dbConnect = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);
	
	 mysqli_set_charset($dbConnect, 'utf8');
?>