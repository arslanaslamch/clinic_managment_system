<?php
	include "../include/Class.DB.php";
	$patient_mob = $_POST['ptid'];
	$GetPatientName = mysqli_query($ClassDB, "SELECT * FROM `patient` WHERE `patient_mobile_one`='$patient_mob'");
	$chkAvailbility = mysqli_num_rows($GetPatientName);
	if($chkAvailbility == 0){
		echo "<div style='color: red; font-weight: bold;'>No Patient Available With This Number</div>";
	}else{
		$GPN = mysqli_fetch_assoc($GetPatientName);
		$PatientFirst = $GPN['patient_fname'];
		$PatientLast = $GPN['patient_lname'];
		echo "<span style='color: red; font-weight: bold;'>$PatientFirst $PatientLast</span>";
	}
?>