<?php
	$to = 'm.ashraf@bimbsec.com.my';
	$subject = 'test';
	$message = 'Ini test sahja';
	$headers = 'From: ashrafmisran@gmail.com\n';

	mail($to, $subject, $message, $headers);
?>