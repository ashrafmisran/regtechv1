<?php 

	session_start();
	include 'connect.php';

	// Get value from process date to create a folder
	$day = 25;
	$month = 03;
	$year = 2018;

	// Create folder if not exist
	echo $folder = 'documents/amla/2018/03/25';
	$hasFolder = file_exists($folder);

	if (!$hasFolder) {
		echo "No folder";
		mkdir($folder);
		echo('Created');
	}

	// Upload email and attachment files


	// Save the name of the uploaded files in variable


	// Store all the info in database



?>