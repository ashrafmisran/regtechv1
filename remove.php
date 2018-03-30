<?php
	session_start();
	include 'connect.php';
	include 'function.php';

	$table = $_GET['t'];
	$array = $_GET['id'];

	

	$sql = 'DELETE FROM '.$table.' WHERE (order_id) IN ('.$array.')';
	$run = $conn->query($sql);
	
	if ($run != FALSE) {
		
		$list = explode(',', $array);
		foreach ($list as $id) {
			deleteDir('documents/amla/FINS-'.$id);
		}
		echo '<p><span class="badge badge-success">Deleted</span></p>';

	}else{
		echo '<p><span class="badge badge-danger">Failed. Please try again.</span></p>';
	}


?>