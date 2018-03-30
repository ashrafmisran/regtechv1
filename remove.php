<?php
	session_start();
	include 'connect.php';
	include 'function.php';

	$table = $_GET['t'];
	$array = $_GET['id'];
	$array = explode(',', $array);

	$list = "0";
	foreach ($array as $id) {
		$list .= ',"'.$id.'"';
	}

	

	$sql = 'DELETE FROM '.$table.' WHERE (order_id) IN ('.$list.')';
	$run = $conn->query($sql);
	
	if ($run != FALSE) {
		
		$list = explode(',', $list);
		foreach ($list as $id) {
			if($id == '0'){
				continue;
			}
			$id = str_replace('"', '', $id);
			deleteDir('documents/amla/ORD-'.$id);
		}
		echo '<p><span class="badge badge-success">Deleted</span></p>';

	}else{
		echo '<p><span class="badge badge-danger">Failed. Please try again.</span></p>';
	}


?>