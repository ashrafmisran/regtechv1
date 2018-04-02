	<?php 

	session_start();
	include 'connect.php';

		


	// Create folder for order named $batch_folder in the process date folder, if it is a new order 

		$id = $_POST['order-id'];
		$order_folder = 'documents/amla/'.$id;
		mkdir($order_folder);

	// Upload email and attachment files

		$init = $id.' ';

		// Rename the attachment to standard name {EmailReceived, Attachment1,2,3, EmailReplied}, then upload
			// fins-email

				$target_file = $order_folder.'/'.$init.'1 - Received Email.msg';
				$fileType = $imageFileType = $_FILES['fins-email']['type'];
				$uploadOk = true;

				// Check if file already exists
				if (file_exists($target_file)) {
				    // echo "Sorry, file already exists. ";
				    $uploadOk = false;
				}

				// Check file type. Make sure it is a valid email file
				if($fileType != "application/octet-stream" ) {
				    $uploadOk = false;
				}

				// If all are ok, upload
				if ($uploadOk) {
					if (move_uploaded_file($_FILES["fins-email"]["tmp_name"], $target_file)) {
						$email_receipt = $target_file;
					}
				}

			// attachment

				$attachments = $_FILES['attachment'];
				$no_of_attachment = count($attachments['name']);

				$attached_files = array();

				for ($i=0; $i < $no_of_attachment; $i++) { 
					
					$j = $i+1; // Numbering
					$fileType = pathinfo($attachments['name'][$i], PATHINFO_EXTENSION); // File extension
					$target_file = $order_folder.'/'.$init.'2 - Attachment '   .$j.   '.'; // New file name and location
					
					$uploadOk = true;

					// Check if file already exists
					if (file_exists($target_file)) {
					    $uploadOk = false;
					}

					// Check file type. Make sure it is a valid email file
					if($fileType != "xls" && $fileType && "xlsx" && $fileType && "doc" && $fileType != "docx" && $fileType != "pdf" ) {
					    $uploadOk = false;
					}

					// If all are ok, upload
					if ($uploadOk) {
						if (move_uploaded_file($attachments["tmp_name"][$i], $target_file)) {
							array_push($attached_files, $target_file);
						}
					}

				}

	// Save the name of the uploaded files in database

		$email = $_FILES['fins-email']['name'];

		// Prepare all the required value
		preg_match('/\((.*)\)/', $email, $source);
		preg_match('/dated\s([0-9]{1,2}\s\b.*\b\s[0-9]{4})/', $email, $order_date);
		preg_match('/([0-9]*)\sindividual/', $email, $no_of_indvdl);
		preg_match('/([0-9]*)\scompa/', $email, $no_of_comp);
		$id 					= substr($_POST['order-id'],4);
		$email_received_date 	= substr($_POST['email-received-date'],6,4) .'-'. substr($_POST['email-received-date'],3,2) .'-'. substr($_POST['email-received-date'],0,2);
		$order_date 			= date("Y-m-d", strtotime( $order_date[1] ));
		$reply_to				= $_POST['reply-to'];
		$reply_cc				= $_POST['cc-to'];
		$remark 				= $_POST['remark'];


		// Initialize the SQL Query
		$sql = "INSERT INTO order_48 (order_id,order_date,orderer,received_email,receive_date,no_of_indvdl,no_of_comp,reply_to,reply_cc,remark) 
							  VALUES ('$id','$order_date','$source[1]','$email','$email_received_date','$no_of_indvdl[1]','$no_of_comp[1]','$reply_to','$reply_cc','$remark')";

		$run = $conn->query($sql);

		if ($run!=FALSE) {
			$_SESSION['type'] = "Success";
			header('Location: index.php?p=order-48-report');
		}else{
			$_SESSION['noti'] = "Failed storing data into database. Reason: ".$conn->error;
		}

?>