<?php include "header.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Existing Patient File
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Patients</a></li>
        <li class="active">Existing Patient File</li>
      </ol>
    </section>
	<br />
	<div class="form-group" style="padding-left: 14px;">
		<a href="#"><button type="button" class="btn btn-block btn-warning" style="width: 150px; display: inline;">Existing Patient File</button></a> &nbsp;&nbsp;&nbsp; <a href="Add-new-patient.php"><button type="button" class="btn btn-block btn-primary" style="width: 150px; display: inline;">Add New Paitent File</button></a>
	</div>
    <!-- Main content -->
    <section class="content">
			<script>
				$(document).ready(function(){
					$("#AddDoctor").submit(function(e){
							e.preventDefault();
								$.ajax({
									url: "php/ExsistingPatient.php",
									method: "post",
									data: $("#AddDoctor").serialize(),
									dataType: "html",
									success: function(strMessage){
										$("#message").html(strMessage);
										$("#AddDoctor")[0].reset();
							}
						});
					});
				});
			</script>
			
			<script>
				$(document).ready(function(){
					$("#getsessionsjs").submit(function(e){
							e.preventDefault();
								$.ajax({
									url: "php/getsessions.php",
									method: "post",
									data: $("#getsessionsjs").serialize(),
								dataType: "html",
									success: function(Mes){
									$("#sessionnames").html(Mes);
										
							}
						});
					});
				});
			</script>
			<script>
				$(document).ready(function(){
					$("#getpatientjs").submit(function(e){
							e.preventDefault();
								$.ajax({
									url: "php/getPatientNameData.php",
									method: "post",
									data: $("#getpatientjs").serialize(),
								dataType: "html",
									success: function(Mes){
									$("#PatientNameGet").html(Mes);
										
							}
						});
					});
				});
			</script>
			<div class="form-group"><div id="message"></div></div>
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title" id="baber">Existing Patient File</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
		<form id="AddDoctor">
			<div class="box-body">
				  <div class="form-group">
					<div class="col-md-6 form-group">
					  <label> Exsisting Patient Mobile Number 1 </label>
					  <input type="text" required name="paitent_mob" id="GetPatientPhone" class="form-control" placeholder="(e.g 032288700)" />
					</div>
					<div class="col-md-6 form-group">
					  <label> Patient Name </label>
					  <div class="form-control" id="PatientNameGet"></div>
					</div>
				  </div>
				  <br />
				  <div class="form-group">
					<div class="col-md-6 form-group">
					  <label> Doctor Name </label>
					  <select class="form-control select2" required id="drname" name="doctor_name" data-placeholder="Select Doctor" style="width: 100%;">
					  <option value=""> Select Doctor  </option>
							<?php
								$GetDoctor = mysqli_query($ClassDB, "SELECT * FROM `doctors`");
								while($GD = mysqli_fetch_assoc($GetDoctor)){
							?>
								<option value="<?php echo $GD['Doctor_id']; ?>"> <?php echo $GD['Doctor_fname']; ?> <?php echo $GD['Doctor_lname']; ?> </option>
							<?php
								}
							?>
					  </select>
					</div>
					<div class="col-md-6 form-group">
					  <label> Select Session </label>
					  <select class="form-control select2" name="select_session" required id="sessionnames" data-placeholder="Select Session" style="width: 100%;">
					  <option value="">Select Session </option>
							
					  </select>
					</div>
				  </div>
				  <br />
				  <div class="form-group">
					<div class="col-md-6 form-group">
					  <label> Appointment Time </label>
						<div class="input-group">
							<input type="text" required name="appointment_time" class="form-control timepicker">

							<div class="input-group-addon">
							  <i class="fa fa-clock-o"></i>
							</div>
						</div>
					</div>
					<div class="col-md-6 form-group">
					  <label> Select Appointment Date </label>
					    <div class="input-group date">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						  <input type="text" name="appointment_date" required class="form-control pull-right" id="datepicker">
						</div>
					</div>
				  </div>
				  <br />
				  <div class="form-group">
					<div class="col-md-6 form-group">
						<label> Payment Amount </label>
						<input type="number" name="payment_amount" required class="form-control" placeholder="(e.g 200)">
					</div>
					<div class="col-md-6 form-group">
					  <label> Status </label>
					  <select class="form-control select2" name="payment_status" required data-placeholder="Select Week Days" style="width: 100%;">
							<option value="Booked"> Booked </option>
							<option value="Paid"> Paid </option>
							<option value="No Show"> No Show </option>
							<option value="Follow Up"> Follow Up </option>
					  </select>
					</div>
				  </div>
					
				  <br />
				  <div class="form-group">
						<hr style="margin-right: 15px; margin-left: 15px;" />
						<button type="submit" class="btn btn-block btn-success pull-right" style="width: 20%; margin-right: 30px;">Confirm Appointment</button>
				  </div>
			</div>
		</form>
		
			<form id="getsessionsjs">
				<input type="hidden" name="drid" id="fetchid" value="">
				<input type="submit" id="subdr" value="getsession" style="display:none;">
			</form>
			<form id="getpatientjs">
				<input type="hidden" name="ptid" id="fetchnamearslan" value="">
				<input type="submit" id="bArs" value="getsession" style="display:none;">
			</form>
			<script>
			$(document).ready(function(){
				$("#drname").change(function(){
					var selecteddr = $(this).children("option:selected").val();
				   $('#fetchid').val(selecteddr);
				   $('#subdr').click();
				   
				});
			});
			</script>
			<script>
			$(document).ready(function(){
				$("#GetPatientPhone").on('input', function(){
					var patientph = $("#GetPatientPhone").val();
				   $('#fetchnamearslan').val(patientph);
				   $('#bArs').click();
				   
				});
			});
			</script>
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
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
