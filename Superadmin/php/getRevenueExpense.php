			<?php
					$startDate = $_POST["dateFrom"];
						$endDate = $_POST["dateTo"];			
			if((!empty($startDate)) AND (!empty($endDate))){ ?>
			<div class="row col-md-6">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
				<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Expense Type</th>
                  <th>Expense Amount</th>
                  
                </tr>
                </thead>
                <tbody>
					<?php
						include "../include/Class.DB.php";
						$startDate = $_POST["dateFrom"];
						$endDate = $_POST["dateTo"];
						
							$GetExpense = mysqli_query($ClassDB, "SELECT * FROM `expenses` WHERE `expense_record_date` BETWEEN '$startDate' AND '$endDate'");
							$GetRevenue = mysqli_query($ClassDB, "SELECT DISTINCT(`doctor_name`) FROM `patient` WHERE (`appointment_date` BETWEEN '$startDate' AND '$endDate') AND (`status`='Paid')");
							$GetTestRevenue = mysqli_query($ClassDB, "SELECT DISTINCT(`reffered_by`) FROM `paitent_tests` WHERE (`request_date` BETWEEN '$startDate' AND '$endDate') AND (`status`='Paid')");
						
						while($GX = mysqli_fetch_assoc($GetExpense)){
					?>
						<tr>
							<td><?php echo $GX['expense_type']; ?></td>
							<td class="sumExpense"><?php echo $GX['amount']; ?></td>
						</tr>
					<?php } ?>
				</tbody>
				</table>
				<br /><br />
				
		</div>
		<div class="row col-md-6">
				<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Doctor Name</th>
                  <th>Revenue Amount</th>
                  
                </tr>
                </thead>
                <tbody>
					<?php
						while($GR = mysqli_fetch_assoc($GetRevenue)){
					?>
						<style>
							tr.doc1<?php echo $GR['doctor_name']; ?>:first-child{
								display: block !important;
							}
						</style>
						<tr class="ars-doc doc1<?php echo $GR['doctor_name']; ?>">
							<td><?php $DoctorN = $GR['doctor_name']; $getDoc = mysqli_query($ClassDB, "SELECT * FROM `doctors` WHERE `Doctor_id`='$DoctorN'"); 
							$getDocN = mysqli_fetch_assoc($getDoc); echo $getDocN['Doctor_fname'].' '.$getDocN['Doctor_lname']; ?></td>
							<td class="sumDoctorRevenue">
								<?php 
									$GetSumAmount = mysqli_query($ClassDB, "SELECT SUM(payment_amount) AS count FROM `patient` WHERE `status`='Paid' AND `doctor_name`='$DoctorN'");
									$GSA = mysqli_fetch_assoc($GetSumAmount);
									echo $GSA['count'];
								?>
							</td>
						</tr>
					<?php } ?>
					<?php
					    while($GTR = mysqli_fetch_assoc($GetTestRevenue)){
					?>
					    <tr>
					        <td>
					            <?php $DoctorName = $GTR['reffered_by']; $getDoc = mysqli_query($ClassDB, "SELECT * FROM `doctors` WHERE `Doctor_id`='$DoctorName'"); 
							    $getDocName = mysqli_fetch_assoc($getDoc); echo $getDocName['Doctor_fname'].' '.$getDocName['Doctor_lname']; ?> <small style="color: red;"> (TEST REVENUE)</small>
					        </td>
					        <td class="sumDoctorRevenue">
					            <?php 
									$GetTestAmount = mysqli_query($ClassDB, "SELECT SUM(paid_amount) AS count FROM `paitent_tests` WHERE `status`='Paid' AND `reffered_by`='$DoctorName'");
									$GTA = mysqli_fetch_assoc($GetTestAmount);
									$GetTestAmount2 = mysqli_query($ClassDB, "SELECT SUM(paid_part_two) AS tcount FROM `paitent_tests` WHERE `status`='Paid' AND `reffered_by`='$DoctorName'");
									$GTA2 = mysqli_fetch_assoc($GetTestAmount2);
									echo $GTA['count'] + $GTA2['tcount'];
								?>
					        </td>
					    </tr>
					
					<?php } ?>
				</tbody>
						
				</table>
				
		</div>
						<script>
								var sum = 0;
								$('.sumExpense').each(function()
								{
									sum += parseFloat($(this).text());
								});
								document.getElementById('arslanExp').innerHTML = sum;
						</script>
						<script>
								var sum = 0;
								$('.sumDoctorRevenue').each(function()
								{
									sum += parseFloat($(this).text());
								});
								document.getElementById('arslanDoc').innerHTML = sum;
						</script>
						
		<div style="clear: both"></div>
		<div class="ars-wrapper" style="margin-top: 50px;">
			<div class="col-md-6 footer-amount-result" style="text-align: center;">
				<span style="font-size: 30px;margin-right: 25px;font-weight: bold;"><span id="arslanExp">2000</span> <sup>EGP</sup> </span><span style="font-size: 29px; font-weight: bold;">اجمالي المصروفات</span>
			</div>
			<div class="col-md-6 footer-amount-result" style="text-align: center;">
				<span style="font-size: 30px;margin-right: 25px;font-weight: bold;"><span id="arslanDoc">2000 </span><sup>EGP</sup> </span><span style="font-size: 29px; font-weight: bold;">اجمالي دخل العيادة</span>
			</div>
		</div>
		<div style="height: 100px;"></div>
				<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
				<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
				<script>
				  //$(function () {
					//$('#example1').DataTable()
					//$('#example2').DataTable()
					
				  //})
				</script>
						<?php }else{ ?>
					<p style="color:red">Select End Date to load reports</p>
						<?php } ?>