<?php
	include "../include/Class.DB.php";
	$paitent_mob = $_POST['paitent_mob'];
	$GetExsistingPatientData = mysqli_query($ClassDB, "SELECT * FROM `patient` WHERE `patient_mobile_one`='$paitent_mob'");
	$chk = mysqli_num_rows($GetExsistingPatientData);
	$GEP = mysqli_fetch_array($GetExsistingPatientData);
	$patient_id = $GEP['patient_id'];
	$paid_amount = $_POST['paid_amount'];
	$patient_name = $GEP['patient_fname'].' '.$GEP['patient_lname'];
	$doctor_id = $_POST['doctor_id'];
	$paitent_tests = $_POST['paitent_tests'];
	$record_date = date("m/d/Y");
	$GetPID = mysqli_query($ClassDB, "SELECT * FROM `paitent_tests` ORDER BY `id` DESC");
	$has_id = mysqli_num_rows($GetPID);
	if($has_id > 0){
		$pid = mysqli_fetch_array($GetPID);
		$lastid = $pid['invoice_id'];
		$Te_ID = $lastid + 1;
	}else{
		$Te_ID = 100;
	}
	error_reporting(0);
	foreach($paitent_tests as $testP){
		$CalculateAmount = mysqli_query($ClassDB, "SELECT * FROM `tests` WHERE `Test_ID`='$testP'");
		$CA = mysqli_fetch_assoc($CalculateAmount);
		$amountSum += $CA['Test_Amount'];
		
		$patientTEST .= $testP.', ';
	}
	if($chk == 0){
		echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>Oops!</strong> This Patient Not Exsist.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}else{
	$Add_Tests = mysqli_query($ClassDB, "INSERT INTO `paitent_tests`(`invoice_id`, `test_names`, `paitent_name`, `status`, `price`, `request_date`, `reffered_by`, `paid_amount`) VALUES ('$Te_ID', '$patientTEST', '$patient_id', 'Booked', '$amountSum', '$record_date', '$doctor_id', '$paid_amount')");
	
	if($Add_Tests){
		echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>Congratulations!</strong> This Tests Has Been Added Successfully.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}else{
		echo '
							<div class="alert alert-danger alert-dismissible" role="alert">
							  <strong>Oops!</strong> This Tests Has Not Been Added. Try Again
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}
	}
?>