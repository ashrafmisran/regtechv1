<?php

	function load_data($conn,$query){
		$sql = $query;
		$run = $conn->query($sql);
		return $run;
	}

?>