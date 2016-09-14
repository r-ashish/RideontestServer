<?php

	$connection = new mysqli("localhost","u701292243_root","mysqlpass","u701292243_ridon");
	if ($connection->connect_errno) {
    	echo "Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error;
	}

	$base_url='http://cmsiitd.esy.es/api/v1/';
?>