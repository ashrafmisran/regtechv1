	<?php 

	session_start();
	include 'connect.php';



	// 1 - Get value from process date to create a folder

		$processDate = $_POST['process-date'];

		$day = substr($processDate,0,2);
		$month = substr($processDate,3,2);
		$year = substr($processDate,6,4);

	// 2 - Create folder if not exist

		// Create Year folder if not exists
		$folder_y = 'documents/amla/'.$year;
		$hasFolder_y = file_exists($folder_y);

		// Create Month folder if not exists
		$folder_m = 'documents/amla/'.$year.'/'.$month;
		$hasFolder_m = file_exists($folder_m);

		// Create Day folder if not exists
		$folder = 'documents/amla/'.$year.'/'.$month.'/'.$day;
		$hasFolder = file_exists($folder);

		if (!$hasFolder) {
			if (!$hasFolder_y) {
				mkdir($folder_y);
			}
			if (!$hasFolder_m) {
				mkdir($folder_m);
			}
			mkdir($folder);
		}
		// End of function = $folder is now made available

	// 3 - Create folder for order named $batch_folder in the process date folder, if it is a new order 

		$type = $_POST['new-or-edit'];
		
		if ($type == 'edit') {
			$id = $_POST['order-id'];
			$batch_folder = $folder.'/'.$id;
		}else{
			$id = $_POST['order-id'];
			mkdir($folder.'/'.$id);
			$batch_folder = $folder.'/'.$id;
		}

	// 4 - Upload email and attachment files

		$init = $id.' ';

		// Rename the attachment to standard name {EmailReceived, Attachment1,2,3, EmailReplied}, then upload
			// fins-email
				$target_file = $batch_folder.'/'.$init.'1 - Received Email.msg';
				$fileType = $imageFileType = $_FILES['fins-email']['type'];
				$uploadOk = true;

				// Check if file already exists
				if (file_exists($target_file)) {
				    // echo "Sorry, file already exists. ";
				    $uploadOk = false;
				}

				// Check file type. Make sure it is a valid email file
				if($fileType != "application/octet-stream" ) {
				    // echo "Sorry, only MSG files are allowed. ";
				    $uploadOk = false;
				}

				// If all are ok, upload
				if ($uploadOk) {
					if (move_uploaded_file($_FILES["fins-email"]["tmp_name"], $target_file)) {
						// echo "Uploaded. Check it <a href=\"$target_file\">here</a>.";
						$email_receipt = $target_file;
					}else{
						// echo "Failed uploading";
					}
				}else{
					// echo "File not ok to be uploaded";
				}

			// attachment

				$attachments = $_FILES['attachment'];
				$no_of_attachment = count($attachments['name']);

				$attached_files = array();

				for ($i=0; $i < $no_of_attachment; $i++) { 
					
					$j = $i+1; // Numbering
					$fileType = pathinfo($attachments['name'][$i], PATHINFO_EXTENSION); // File extension
					$target_file = $batch_folder.'/'.$init.'2 - Attachment '   .$j.   '.'   .$fileType; // New file name and location
					
					$uploadOk = true;

					// Check if file already exists
					if (file_exists($target_file)) {
					    // echo "Sorry, file already exists. ";
					    $uploadOk = false;
					}

					// Check file type. Make sure it is a valid email file
					if($fileType != "xls" && $fileType && "xlsx" && $fileType && "doc" && $fileType != "docx" && $fileType != "pdf" ) {
					    // echo "Sorry, only PDF, XLS, XLSX, DOC, and DOCX file accepted files are allowed. ";
					    $uploadOk = false;
					}

					// If all are ok, upload
					if ($uploadOk) {
						if (move_uploaded_file($attachments["tmp_name"][$i], $target_file)) {
							// echo "Uploaded. Check it <a href=\"$target_file\">here</a>. ";
							array_push($attached_files, $target_file);
						}else{
							// echo "Failed uploading. ";
						}
					}else{
						// echo "File not ok to be uploaded. ";
					}

				}

				$attached_files = serialize($attached_files);

			// reply
				$target_file = $batch_folder.'/'.$init.'3 - Replied Email.msg'; // New filename
				$fileType = pathinfo($_FILES['reply']['name'], PATHINFO_EXTENSION); // File extension
				$uploadOk = true;

				// Check if file already exists
				if (file_exists($target_file)) {
				    // echo "Sorry, file already exists. ";
				    $uploadOk = false;
				}

				// Check file type. Make sure it is a valid email file
				if($fileType != "msg" ) {
				    // echo "Sorry, only MSG files are allowed. ";
				    $uploadOk = false;
				}

				// If all are ok, upload
				if ($uploadOk) {
					if (move_uploaded_file($_FILES["reply"]["tmp_name"], $target_file)) {
						// echo "Uploaded. Check it <a href=\"$target_file\">here</a>.";
						$email_replied = $target_file;
					}else{
						// echo "Failed uploading";
					}
				}else{
					// echo "File not ok to be uploaded";
				}
			

	// 5 - Save the name of the uploaded files in variable

		$id = substr($_POST['order-id'],5);
		$order_date = substr($_POST['order-date'],6,4) .'-'. substr($_POST['order-date'],3,2) .'-'. substr($_POST['order-date'],0,2);
		$email_received_date = substr($_POST['email-received-date'],6,4) .'-'. substr($_POST['email-received-date'],3,2) .'-'. substr($_POST['email-received-date'],0,2);

		$process_date = substr($_POST['process-date'],6,4) .'-'. substr($_POST['process-date'],3,2) .'-'. substr($_POST['process-date'],0,2);
		$matched = $_POST['matched'];
		$remark = $_POST['remark'];

		$sql = "INSERT INTO order_48 (order_id,order_date,receive_date,process_date,matched,remark) 
							  VALUES ('$id','$order_date','$email_received_date','$process_date','$matched','$remark')";

		$run = $conn->query($sql);

		if ($run!=FALSE) {
			$_SESSION['type'] = "Success";
			header('Location: index.php?p=order-48-report');
		}else{
			$_SESSION['noti'] = "Failed storing data into database. Reason: ".$conn->error;
		}


	// 6 - Store all the info in database



?>