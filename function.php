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


	// Function to remove folders and files 
    function rrmdir($dir) {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file)
                if ($file != "." && $file != "..") rrmdir("$dir/$file");
            rmdir($dir);
        }
        else if (file_exists($dir)) unlink($dir);
    }

    // Function to Copy folders and files       
    function rcopy($src, $dst) {
        if (is_dir ( $src )) {
        	if (!is_dir($dst))
        		mkdir ( $dst );	
        	$files = scandir ( $src );

        	// Remove if the directory only have . and ..
            if (count($files) == 2){
            	rmdir($src);
            }else{
            	
	            foreach ( $files as $file )
	                if ($file != "." && $file != "..")
	                    rcopy ( "$src/$file", "$dst/$file" );
	        }
        } elseif (file_exists ( $src )) {
            copy ( $src, $dst );
            unlink($src);
        }
    }

?>