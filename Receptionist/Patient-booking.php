<?php include "header.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <style>
  .secBox{
  display:block;
  }
button.dt-button, div.dt-button, a.dt-button {
    width: 92px;
    border: 0px solid #999;
    background-color: #08c;
	color: white;
    background-image: -webkit-linear-gradient(to bottom, #00c0ef 0%, #08c 100%);
    background-image: -moz-linear-gradient(to bottom, #00c0ef 0%, #08c 100%);
    background-image: -ms-linear-gradient(to bottom, #00c0ef 0%, #08c 100%);
    background-image: -o-linear-gradient(to bottom, #00c0ef 0%, #08c 100%);
    background-image: linear-gradient(to bottom, #00c0ef 0%, #08c 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr='white', EndColorStr='#e9e9e9');
}
button.dt-button:hover, div.dt-button:hover, a.dt-button:hover{
		
		background-image: -webkit-linear-gradient(to bottom, #00c0ef 0%, #08c 100%);
		background-image: -moz-linear-gradient(to bottom, #00c0ef 0%, #08c 100%);
		background-image: -ms-linear-gradient(to bottom, #00c0ef 0%, #08c 100%);
		background-image: -o-linear-gradient(to bottom, #00c0ef 0%, #08c 100%);
		background-image: linear-gradient(to bottom, #00c0ef 0%, #08c 100%);
}
  </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Patient Booking
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Patients</a></li>
        <li class="active">Patient Booking</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	<div class="form-group">
			<?php
				if(isset($_GET['paid'])){
					$Paid = $_GET['paid'];
					$UpdatePaid = mysqli_query($ClassDB, "UPDATE `patient` SET `status`='Paid' WHERE `id`='$Paid'");
					if($UpdatePaid){
						echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>Congratulations!</strong> Payment Status Updated To Paid Successfully.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
						';
					}else{
						echo '
							<div class="alert alert-danger alert-dismissible" role="alert">
							  <strong>Ooops!</strong> Status Is Not Updated. Please Try Again.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
						';
					}
				}
			?>
		
	</div>
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Patient Booking</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
		
        <!-- /.box-header -->
		<div class="box-body" style="overflow-x: scroll">
             <table id="example1" class="table table-bordered table-striped" width="1400">
                <thead>
                <tr>
                  <th>Patient ID</th>
                  <th>Patient Name</th>
                  <th>Doctor Name</th>
                  <th>Session</th>
                  <th>Specialty</th>
                  <th>Appointment Date</th>
                  <th>Appointment Time</th>
                  <th>Status</th>
                  <th>Payment</th>
                  <th>Status Change</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php
					$GetDoctors = mysqli_query($ClassDB, "SELECT * FROM `patient`");
					while($GP = mysqli_fetch_assoc($GetDoctors)){
				?>
                <tr>
                  <td><?php echo $GP['patient_id']; ?></td>
                  <td><?php echo $GP['patient_fname']; ?> <?php echo $GP['patient_lname']; ?></td>
                  <td><?php $Doc = $GP['doctor_name']; $GetDoc = mysqli_query($ClassDB, "SELECT * FROM `doctors` WHERE `Doctor_id`='$Doc'"); $GD = mysqli_fetch_assoc($GetDoc); echo $GD['Doctor_fname'].' '.$GD['Doctor_lname']; ?></td>
                  <td><?php $Session = $GP['select_session']; $GetSession = mysqli_query($ClassDB, "SELECT * FROM `doctors_sessions` WHERE `session_id`='$Session'"); $GS = mysqli_fetch_assoc($GetSession); echo $GS['session_day'].' - '.$GS['session_time']; ?></td>
                  <td><?php echo $GD['Doctor_speciality']; ?></td>
                  <td><?php echo $GP['appointment_date']; ?></td>
                  <td><?php echo $GP['appointment_time']; ?></td>
                  <td><div class="badge badge-success"><?php echo $GP['status']; ?></div></td>
                  <td><?php echo $GP['payment_amount']; ?></td>
                  
                  <td>
						<div class="btn-group">
						  <button type="button" class="btn btn-success">Status</button>
						  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu" role="menu">
							<li><a <?php if($GP['status'] == 'Paid'){ echo "style='display: none;'"; } ?> href="?paid=<?php echo $GP['id']; ?>">Paid</a></li>
						  </ul>
						</div>
				  </td>
				  <td>
						<a <?php if($GP['status'] == 'Paid'){ echo "style='display: none;'"; } ?> href="edit-patient.php?edit=<?php echo $GP['id']; ?>"><button class="btn btn-primary">Edit Patient<i class="fa fa-pencil"></i></button></a>
						<button <?php if($GP['status'] == 'Booked'){ echo "style='display: none;'"; } ?> class="btn btn-primary">Not Editable</button>
				  </td>
                </tr>
				<?php } ?>
				</tbody>
			</table>
				
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include "footer.php"; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
<!-- ./wrapper -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
  });
  $(document).ready(function() {
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        ]
    } );
} );
</script>
</body>
</html>
