<?php

	function load_data($conn,$query){
		$sql = $query;
		$run = $conn->query($sql);
		return $run;
	}


	function deleteDir($dirPath) {
	    if (! is_dir($dirPath)) {
	        throw new InvalidArgumentException("$dirPath must be a directory");
	    }
	    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
	        $dirPath .= '/';
	    }
	    $files = glob($dirPath . '*', GLOB_MARK);
	    foreach ($files as $file) {
            unlink($file);
	    }
	    rmdir($dirPath);
	}
?>