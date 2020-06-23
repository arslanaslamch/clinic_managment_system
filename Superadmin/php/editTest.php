<?php
	include "../include/Class.DB.php";
	$test_id = $_POST['test_id'];
	$test_name = mysqli_real_escape_string($ClassDB, $_POST['test_name']);
	$comment = mysqli_real_escape_string($ClassDB, $_POST['comment']);
	$amount = $_POST['amount'];
	
	$AddTest = mysqli_query($ClassDB, "UPDATE `tests` SET `Test_Name`='$test_name',`Test_Comment`='$comment',`Test_Amount`='$amount' WHERE `Test_ID`='$test_id'");
	
	if($AddTest){
		echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>Congratulations!</strong> This Test Has Been Updated Successfully.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}else{
		echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>Oops!</strong> This Test Has Not Been Updated. Please Try Again
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}
?>