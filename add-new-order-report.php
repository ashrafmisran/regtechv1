<?php

	include 'function.php';
	
	// Create the Report folder
	$year   = date('Y');
	$month	= date('m');
	$day	= date('d');
	$batch 	= '1';
	$div	= '/';
	$folder	= 'documents/amla/';

	if ( !is_dir($folder.$div.$year) )
		mkdir($folder.$div.$year);
	if ( !is_dir($folder.$div.$year.$div.$month) )
		mkdir($folder.$div.$year.$div.$month);
	if ( !is_dir($folder.$div.$year.$div.$month.$div.$day) )
		mkdir($folder.$div.$year.$div.$month.$div.$day);
	if ( !is_dir($folder.$div.$year.$div.$month.$div.$day) )
		mkdir($folder.$div.$year.$div.$month.$div.$day);
	
	$folder = $folder.$div.$year.$div.$month.$div.$day;



	// Move the Order Report to the newly created folder
	$newname = 'Order 48 Report for '.date('Y-m-d');
	move_uploaded_file($_FILES['report']['tmp_name'], $folder.$div.$newname.'.pdf');

	// Move the Order folder to Batch folder
	foreach ($_POST['select-order-id'] as $order_id){
		$source = 'documents/amla/ORD-'.$order_id;
		$destination = $folder.$div.'ORD-'.$order_id;
	    rcopy($source , $destination );
	 }

	//Update data in database


?>