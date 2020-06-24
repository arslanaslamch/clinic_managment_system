
<?php
	include "../include/Class.DB.php";
	$fromDate = $_POST['fromDate'];
	$dateTo = $_POST['dateTo'];
	$DoctorN = $_POST['doctor_name'];
?>
	<section class="invoice" id="printdivcontent">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <img src="images/cliniclogo.png" style="width: 31%;" />
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>From Date: </strong><?php echo $fromDate; ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>To Date: </strong><?php echo $dateTo; ?><br>
          </address>
        </div>
		<div class="col-sm-4 invoice-col">
          <address>
            <strong>Doctor Name: </strong><?php $getDoc = mysqli_query($ClassDB, "SELECT * FROM `doctors` WHERE `Doctor_id`='$DoctorN'"); 
												$getDocN = mysqli_fetch_assoc($getDoc); echo $getDocN['Doctor_fname'].' '.$getDocN['Doctor_lname']; ?><br>
            <strong>Specility: </strong> <?php echo $getDocN['Doctor_speciality'] ?><br>
          </address>
        </div>
        <!-- /.col -->
       
        <!-- /.col -->
      </div>
      <!-- /.row -->
		<br />
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table">
            <thead>
            <tr>
              <th>Patient Full Name</th>
              <th>Appointment Date</th>
              <th>Appointment Time</th>
              <th>Status</th>
              <th>Payment</th>
            </tr>
            </thead>
            <tbody>
			<?php
				$GetSummaryDetails = mysqli_query($ClassDB, "SELECT * FROM `patient` WHERE (`doctor_name`='$DoctorN') AND (`appointment_date` BETWEEN '$fromDate' AND '$dateTo') AND (`status`='Paid')");
				while($GSD = mysqli_fetch_assoc($GetSummaryDetails)){
			?>
            <tr>
              <td><?php echo $GSD['patient_fname'].' '.$GSD['patient_lname']; ?></td>
              <td><?php echo $GSD['appointment_date']; ?></td>
              <td><?php echo $GSD['appointment_time']; ?></td>
              <td><div class="badge badge-success"><?php echo $GSD['status']; ?></div></td>
              <td><?php echo $GSD['payment_amount']; ?></td>
            </tr>
				<?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-6">

          <div class="table-responsive">
            <table class="table">
              <tbody>
              <tr>
                <th>Total Patients:</th>
                <td><?php $getRec = mysqli_num_rows($GetSummaryDetails); echo $getRec; ?></td>
              </tr>
			  <tr>
                <th>Total Revenue:</th>
                <td><?php 
						$getSum = mysqli_query($ClassDB, "SELECT SUM(payment_amount) AS count FROM `patient` WHERE (`doctor_name`='$DoctorN') AND (`appointment_date` BETWEEN '$fromDate' AND '$dateTo') AND (`status`='Paid')");
						$gSum = mysqli_fetch_array($getSum);
						echo $gSum['count'];
					?></td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
		<br />
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
			<button class="btn btn-primary" id="btnPrint" onclick="printDiv()"><i class="fa fa-print"></i> Print</button>
        </div>
      </div>
    </section>
	<script type="text/javascript">
		function printDiv(){
        var printContents = document.getElementById("printdivcontent").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
}
	</script>