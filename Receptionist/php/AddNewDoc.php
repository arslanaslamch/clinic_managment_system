<?php
	include "../include/Class.DB.php";
	error_reporting(0);
	
	$GetDoc = mysqli_query($ClassDB, "SELECT * FROM `doctors` ORDER BY `id` DESC");
	$has_doc = mysqli_num_rows($GetDoc);
	if($has_doc > 0){
		$pid = mysqli_fetch_array($GetDoc);
		$lastid = $pid['Doctor_id'];
		$Doc_ID = $lastid + 1;
	}else{
		$Doc_ID = 100;
	}
	
	$doctor_first_name = $_POST['doctor_first_name'];
	$doctor_second_name = $_POST['doctor_second_name'];
	$speciality = $_POST['speciality'];
	$doc_joining_date = $_POST['doc_joining_date'];
	$weekdays = $_POST['weekdays'];
	foreach($weekdays as $weekday){
			$weeks .= $weekday.',';
	}
	$sessions_monthly = $_POST['sessions_monthly'];
	$session_selected = $_POST['session_selected'];
	foreach($session_selected as $sessions_main){
			$sessions .= $sessions_main.',';
	}
	$AddDoctor = mysqli_query($ClassDB, "INSERT INTO `doctors`(`Doctor_id`, `Doctor_fname`, `Doctor_lname`, `Doctor_speciality`, `Doctor_joiningdate`, `Doctor_weekdays`, `Doctor_sessions`, `session_selected`) VALUES ('$Doc_ID', '$doctor_first_name', '$doctor_second_name', '$speciality', '$doc_joining_date', '$weeks', '$sessions_monthly', '$sessions')");
	
	if($AddDoctor){
		echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>Congratulations!</strong> This Doctor Has Been Added Successfully.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}else{
		echo '
							<div class="alert alert-danger alert-dismissible" role="alert">
							  <strong>Oops!</strong> This Doctor Has Not Been Added. Try Again
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}
?>