<?php
	session_start();
	include 'connect.php';

	$table = $_GET['t'];
	$array = $_GET['id'];

	$sql = 'DELETE FROM '.$table.' WHERE (order_id) IN ('.$array.')';
	$run = $conn->query($sql);
	
	if ($run != FALSE) {
		echo 'Deleted';
	}else{
		echo "Failed";
	}


?>