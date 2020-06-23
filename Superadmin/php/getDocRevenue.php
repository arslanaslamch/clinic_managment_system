
				<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Patient ID</th>
                  <th>Patient Name</th>
                  <th>Patient Mobile</th>
                  <th>Doctor Name</th>
                  <th>Session</th>
                  <th>Appointment Date</th>
                  <th>Status</th>
                  <th>Payment</th>
                </tr>
                </thead>
                <tbody>
				<?php
				include '../include/Class.DB.php';
				$DrName = $_POST['drnamefltr'];
				$SName = $_POST['selectsessionfltr'];
				$Date = $_POST['appointmentdatefltr'];
				if((!empty($DrName)) AND (!empty($SName)) AND (!empty($Date)) ){
					$GetDoctors = mysqli_query($ClassDB, "SELECT * FROM `patient` WHERE `doctor_name`='$DrName' AND  `select_session`='$SName' AND `appointment_date`='$Date'");
				}elseif((!empty($DrName)) AND (!empty($SName)) AND (empty($Date)) ){
					$GetDoctors = mysqli_query($ClassDB, "SELECT * FROM `patient` WHERE `doctor_name`='$DrName' AND  `select_session`='$SName'");
				}elseif((!empty($DrName)) AND (empty($SName)) AND (empty($Date)) ){
					$GetDoctors = mysqli_query($ClassDB, "SELECT * FROM `patient` WHERE `doctor_name`='$DrName'");
				}elseif((!empty($DrName)) AND (empty($SName)) AND (!empty($Date)) ){
					$GetDoctors = mysqli_query($ClassDB, "SELECT * FROM `patient` WHERE `doctor_name`='$DrName' AND `appointment_date`='$Date'");
				}else{
					echo 'Select Filter';
				}
					
					while($GP = mysqli_fetch_assoc($GetDoctors)){
				?>
					<tr>
					  <td><?php echo $GP['patient_id']; ?></td>
					  <td><?php echo $GP['patient_fname']; ?> <?php echo $GP['patient_lname']; ?></td>
					  <td><?php echo $GP['patient_mobile_one']; ?></td>
					  <td><?php $Doc = $GP['doctor_name']; $GetDoc = mysqli_query($ClassDB, "SELECT * FROM `doctors` WHERE `Doctor_id`='$Doc'"); $GD = mysqli_fetch_assoc($GetDoc); echo $GD['Doctor_fname'].' '.$GD['Doctor_lname']; ?></td>
					  <td><?php $Session = $GP['select_session']; $GetSession = mysqli_query($ClassDB, "SELECT * FROM `doctors_sessions` WHERE `session_id`='$Session'"); $GS = mysqli_fetch_assoc($GetSession); echo $GS['session_day'].' - '.$GS['session_time']; ?></td>
					  <td><?php echo $GP['appointment_date']; ?></td>
					  <td><div class="badge badge-success"><?php echo $GP['status']; ?></div></td>
					  <td class="amount"><?php echo $GP['payment_amount']; ?></td>
					</tr>
					<?php 
						$getSum = mysqli_query($ClassDB, "SELECT SUM(payment_amount) AS count FROM `patient` WHERE `status`='Paid' AND `doctor_name`='$DrName'");
						$gSum = mysqli_fetch_array($getSum);
					?>
				<?php } ?>
				</tbody>
				</table>
				<br /><br />
				<div class="row">
				<div class="col-lg-3 col-xs-12">
				 
				</div>
				<div class="col-lg-6 col-xs-12">
						<div class="col-md-4">
						<span>
							<h3 style="font-weight: bold;">
								<span id="showSum"><?php echo $gSum['count']; ?></span>
								<sup style="font-size: 15px">EGP</sup>
							</h3>
						</span>
						</div>
						<div class="col-md-8">
							<span style="font-size: 37px; font-weight: bold;">اجمالي دخل العيادة</span>
						</div>
				
				</div>
				<div class="col-lg-3 col-xs-12">
				 
				</div>
				<!-- ./col -->
				
				<!-- ./col -->
			  </div>
				<div style="height: 100px;"></div>
				<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
				<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
				<script>
				  $(function () {
					$('#example1').DataTable()
					$('#example2').DataTable({
					  'paging'      : true,
					  'lengthChange': false,
					  'searching'   : false,
					  'ordering'    : true,
					  'info'        : true,
					  'autoWidth'   : false
					})
				  })
				</script>