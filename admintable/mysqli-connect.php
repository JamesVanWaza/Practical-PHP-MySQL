<?php
	/*
<<<<<<< HEAD
	This file provides the information for accessing the database sand coonnecting to MySQL. It also sets the language coding to utf-8*/

=======
	This file provides the information for accessing the database sand coonnecting to MySQL. It also sets the language coding to utf-8
*/
>>>>>>> a43a31c40648fae717ad87e00a7474a21635c2bc
	//First we define the constants:
	define('DB_USER', 'admin9997');
	define('DB_PASSWORD', 'WP6cV+~SqUU~w#Nzu9');
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'Practical-PHP-MySQL-Book');
<<<<<<< HEAD
	
=======
<<<<<<< HEAD

=======
>>>>>>> refractor4
	/*
>>>>>>> a43a31c40648fae717ad87e00a7474a21635c2bc
	/*
	Next we assign the database connection to a variable that we will call $dbcon
	*/
	$dbcon = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MYSQL: ' . mysqli_connect_error());
	/*
	Finally, we set the language encoding as utf-8
	*/
	mysqli_set_charset($dbcon, 'utf8');
?>