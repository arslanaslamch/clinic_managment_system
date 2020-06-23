<?php
	include "../include/Class.DB.php";
	error_reporting(0);
	$Session_ID = $_POST['session_id'];
	$session_title = $_POST['session_title'];
	$select_day = $_POST['select_day'];
	$session_time = $_POST['session_time'];
	$Status = "1";
	$AddSession = mysqli_query($ClassDB, "UPDATE `doctors_sessions` SET `session_title`='$session_title',`session_day`='$select_day',`session_time`='$session_time',`session_status`='$Status ' WHERE `session_id`='$Session_ID'");
		
		if($AddSession){
			echo '
								<div class="alert alert-success alert-dismissible" role="alert">
								  <strong>Congratulations!</strong> This Session Has Been Updated Successfully.
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
								</div>
			';
		}else{
			echo '
								<div class="alert alert-danger alert-dismissible" role="alert">
								  <strong>Oops!</strong> This Session Has Not Been Updated. Try Again
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
								</div>
			';
		}
?>