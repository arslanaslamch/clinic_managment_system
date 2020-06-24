<?php
	include "../include/Class.DB.php";
	$paitent_mob = $_POST['paitent_mob'];
	$doctor_name = $_POST['doctor_name'];
	$appointment_time = $_POST['appointment_time'];
	$appointment_date = $_POST['appointment_date'];
	$select_session = $_POST['select_session'];
	$payment_amount = $_POST['payment_amount'];
	$payment_status = $_POST['payment_status'];
	$GetExsistingPatientData = mysqli_query($ClassDB, "SELECT * FROM `patient` WHERE `patient_mobile_one`='$paitent_mob'");
	$GEP = mysqli_fetch_array($GetExsistingPatientData);
	$patient_id = $GEP['patient_id'];
	$patient_fname = $GEP['patient_fname'];
	$patient_lname = $GEP['patient_lname'];
	$mob_no_one = $GEP['patient_mobile_one'];
	$mob_no_two = $GEP['patient_mobile_two'];
	$record_date = date("d/m/Y");
	$gender = $GEP['patient_gender'];
	$date_of_birth = $GEP['patient_dob'];
	$PatientCheck = mysqli_num_rows($GetExsistingPatientData);
	if($PatientCheck == 0){
		echo '
							<div class="alert alert-danger alert-dismissible" role="alert">
							  <strong>Oops!</strong> This Patient Data is Not Available. Please Register As New Patient..!
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}else{
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
	}
	
?>