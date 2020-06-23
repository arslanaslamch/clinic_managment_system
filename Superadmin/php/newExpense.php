<?php
	include "../include/Class.DB.php";
	$entry_date = date("m/d/Y");
	$entry_type = $_POST['expense_type'];
	$inovice_number = $_POST['inovice_number'];
	$comment = mysqli_real_escape_string($ClassDB, $_POST['comment']);
	$amount = $_POST['amount'];
	
	$AddExpense = mysqli_query($ClassDB, "INSERT INTO `expenses`(`expense_record_date`, `expense_type`, `inovice_number`, `comment`, `amount`) VALUES ('$entry_date', '$entry_type', '$inovice_number', '$comment', '$amount')");
	
	if($AddExpense){
		echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>Congratulations!</strong> This Expense Has Been Added Successfully.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}else{
		echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>Oops!</strong> This Expense Has Not Been Added. Please Try Again
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}
?>