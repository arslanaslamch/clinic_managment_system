<?php
	include "../include/Class.DB.php";
	error_reporting(0);
	$Session_ID = mt_rand(000000, 999999);
	$session_title = $_POST['session_title'];
	$select_day = $_POST['select_day'];
	$session_time = $_POST['session_time'];
	$Status = "1";
	$chkSession = mysqli_query($ClassDB, "SELECT * FROM `doctors_sessions` WHERE `session_day`='$select_day' AND `session_time`='$session_time'");
	$chk = mysqli_num_rows($chkSession);
	if($chk == 0){
		$AddSession = mysqli_query($ClassDB, "INSERT INTO `doctors_sessions`(`session_id`, `session_title`, `session_day`, `session_time`, `session_status`) VALUES ('$Session_ID', '$session_title', '$select_day', '$session_time', '$Status')");
		
		if($AddSession){
			echo '
								<div class="alert alert-success alert-dismissible" role="alert">
								  <strong>Congratulations!</strong> This Session Has Been Added Successfully.
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
								</div>
			';
		}else{
			echo '
								<div class="alert alert-danger alert-dismissible" role="alert">
								  <strong>Oops!</strong> This Session Has Not Been Added. Try Again
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
								</div>
			';
		}
	}else{
		echo '
								<div class="alert alert-danger alert-dismissible" role="alert">
								  <strong>Oops!</strong> This Session Already Exsist. Try New One
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
								</div>
			';
	}
?>