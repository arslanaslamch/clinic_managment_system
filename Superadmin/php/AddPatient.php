<?php
	include "../include/Class.DB.php";
	$patient_fname = $_POST['patient_fname'];
	$patient_lname = $_POST['patient_lname'];
	$mob_no_one = $_POST['mob_no_one'];
	$mob_no_two = $_POST['mob_no_two'];
	$record_date = date("m/d/Y");
	$gender = $_POST['gender'];
	$date_of_birth = $_POST['date_of_birth'];
	$doctor_name = $_POST['doctor_name'];
	$appointment_time = $_POST['appointment_time'];
	$appointment_date = $_POST['appointment_date'];
	$select_session = $_POST['select_session'];
	$payment_amount = $_POST['payment_amount'];
	$payment_status = $_POST['payment_status'];
	
	$GetPatients = mysqli_query($ClassDB, "SELECT * FROM `patient` ORDER BY `patient_id` DESC");
	$has_patient = mysqli_num_rows($GetPatients);
	if($has_patient > 0){
		$pid = mysqli_fetch_array($GetPatients);
		$lastid = $pid['patient_id'];
		$patient_id = $lastid + 1;
	}else{
		$patient_id = 1000;
	}
	
	$GetExsistingPatientData = mysqli_query($ClassDB, "SELECT * FROM `patient` WHERE `patient_mobile_one`='$mob_no_one'");
	$chkPatient = mysqli_num_rows($GetExsistingPatientData);
	if($chkPatient == 0){
	$AddPaitent = mysqli_query($ClassDB, "INSERT INTO `patient`(`patient_id`, `patient_fname`, `patient_lname`, `patient_mobile_one`, `patient_mobile_two`, `record_date`, `patient_gender`, `patient_dob`, `doctor_name`, `appointment_time`, `appointment_date`, `select_session`, `payment_amount`, `status`) VALUES ('$patient_id', '$patient_fname', '$patient_lname', '$mob_no_one', '$mob_no_two', '$record_date', '$gender', '$date_of_birth', '$doctor_name', '$appointment_time', '$appointment_date', '$select_session', '$payment_amount', '$payment_status')");
	
	if($AddPaitent){
		echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>Congratulations!</strong> This Patient Has Been Added Successfully.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}else{
		echo '
							<div class="alert alert-danger alert-dismissible" role="alert">
							  <strong>Oops!</strong> This Paitent Has Not Been Added. Please Try Again
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}
	}else{
		echo '
							<div class="alert alert-danger alert-dismissible" role="alert">
							  <strong>Oops!</strong> This Paitent Already Exsist.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}
?>