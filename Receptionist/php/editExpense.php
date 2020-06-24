<?php
	include "../include/Class.DB.php";
	$entry_date = date("d/m/Y");
	$entry_type = $_POST['expense_type'];
	$expense_id = $_POST['expense_id'];
	$inovice_number = $_POST['inovice_number'];
	$comment = mysqli_real_escape_string($ClassDB, $_POST['comment']);
	$amount = $_POST['amount'];
	
	$AddExpense = mysqli_query($ClassDB, "UPDATE `expenses` SET `expense_record_date`='$entry_date',`expense_type`='$entry_type',`inovice_number`='$inovice_number',`comment`='$comment',`amount`='$amount' WHERE `id`='$expense_id'");
	
	if($AddExpense){
		echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>Congratulations!</strong> This Expense Has Been Updated Successfully.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}else{
		echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>Oops!</strong> This Expense Has Not Been Updated. Please Try Again
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
		';
	}
?>