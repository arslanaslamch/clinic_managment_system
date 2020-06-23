<?php
	include "../include/Class.DB.php";
	$GetTest = mysqli_query($ClassDB, "SELECT * FROM `tests` ORDER BY `id` DESC");
	$has_test = mysqli_num_rows($GetTest);
	if($has_test > 0){
		$pid = mysqli_fetch_array($GetTest);
		$lastid = $pid['Test_ID'];
		$Test_ID = $lastid + 1;
	}else{
		$Test_ID = 100;
	}
	$test_name = mysqli_real_escape_string($ClassDB, $_POST['test_name']);
	$comment = mysqli_real_escape_string($ClassDB, $_POST['comment']);
	$amount = $_POST['amount'];
	
	$AddTest = mysqli_query($ClassDB, "INSERT INTO `tests`(`Test_ID`, `Test_Name`, `Test_Comment`, `Test_Amount`) VALUES ('$Test_ID', '$test_name', '$comment', '$amount')");
	
	if($AddTest){
		echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>Congratulations!</strong> This Test Has Been Added Successfully.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}else{
		echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>Oops!</strong> This Test Has Not Been Added. Please Try Again
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}
?>