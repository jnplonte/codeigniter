<?php
	header('Content-Type: application/json');
	$data = array('status' => false, 'error' => 'Super Error Switch to Development Environment to view Error');

	echo json_encode($data);
?>