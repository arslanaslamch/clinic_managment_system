<?php
	include "../include/Class.DB.php";
	$patient_mob = $_POST['did'];
	$GetPatientName = mysqli_query($ClassDB, "SELECT * FROM `doctors` WHERE `Doctor_id`='$patient_mob'");
	$chkAvailbility = mysqli_num_rows($GetPatientName);
	if($chkAvailbility == 0){
		echo "<div style='color: red; font-weight: bold;'>No Patient Available With This Number</div>";
	}else{
		$GPN = mysqli_fetch_assoc($GetPatientName);
		$PatientFirst = $GPN['Doctor_fname'];
		$PatientLast = $GPN['Doctor_lname'];
		echo "<span style='color: red; font-weight: bold;'>$PatientFirst $PatientLast</span>";
	}
?>