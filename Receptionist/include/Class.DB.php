<?php
	DEFINE('HOST', 'localhost');
	DEFINE('USR', 'clinicroot');
	DEFINE('PWD', '$V&P@a+J1#LA');
	DEFINE('DB', 'cliniccare');
	$ClassDB = mysqli_connect(HOST, USR, PWD, DB);
	if(!$ClassDB){
		echo "<script>alert('Database Not Connected. Please contact with your web engineer')</script>";
	}
?>