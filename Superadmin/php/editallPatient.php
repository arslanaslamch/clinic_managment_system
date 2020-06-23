<?php
	include "../include/Class.DB.php";
	$patient_id = $_POST['patient_id'];
	$patient_fname = $_POST['patient_fname'];
	$patient_lname = $_POST['patient_lname'];
	$mob_no_one = $_POST['mob_no_one'];
	$mob_no_two = $_POST['mob_no_two'];
	$gender = $_POST['gender'];
	$date_of_birth = $_POST['date_of_birth'];
	$appointment_time = $_POST['appointment_time'];
	$appointment_date = $_POST['appointment_date'];
	$payment_amount = $_POST['payment_amount'];
	$payment_status = $_POST['payment_status'];
	$doctor_name = $_POST['doctor_name'];
	$select_session = $_POST['select_session'];
	
	$AddPaitent = mysqli_query($ClassDB, "UPDATE `patient` SET `patient_fname`='$patient_fname',`patient_lname`='$patient_lname',`patient_mobile_one`='$mob_no_one',`patient_mobile_two`='$mob_no_two', `patient_gender`='$gender',`patient_dob`='$date_of_birth'  WHERE `patient_id`='$patient_id'");
	
	if($AddPaitent){
		echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>Congratulations!</strong> This Patient Has Been Updated Successfully.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}else{
		echo '
							<div class="alert alert-danger alert-dismissible" role="alert">
							  <strong>Oops!</strong> This Paitent Has Not Been Updated. Please Try Again
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}
?>