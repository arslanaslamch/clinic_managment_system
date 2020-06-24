<?php include "header.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <style>
  .box-body{
      overflow-x: scroll;
  }
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
.dt-button:hover{
		
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
        All Tests
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tests</a></li>
        <li class="active">All Tests</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	<div class="form-group">
			<?php
				if(isset($_GET['paid'])){
					$Paid = $_GET['paid'];
					$UpdatePaid = mysqli_query($ClassDB, "UPDATE `paitent_tests` SET `status`='Paid' WHERE `id`='$Paid'");
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
			
			<?php
			    if(isset($_GET['success'])){
			        $getSuccess = $_GET['success'];
			        if($getSuccess == 'yes'){
			            echo '
							<div class="alert alert-success alert-dismissible" role="alert">
							  <strong>WellDone !</strong> Amount Of The Patient Tests is Updated
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
						';
			        }else{
			           echo '
							<div class="alert alert-danger alert-dismissible" role="alert">
							  <strong>Ooops !</strong> Amount Of The Patient Tests is Not Updated
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
          <h3 class="box-title">All Test</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
		
        <!-- /.box-header -->
		<div class="box-body">
             <table id="example1" class="table table-bordered table-striped" style="width: 1700px;">
                <thead>
                <tr>
                  <th>Report ID</th>
                  <th>Test Names</th>
                  <th>Paitent Name</th>
                  <th>Paitent Mobile #</th>
                  <th>Test Request Date</th>
                  <th>Paid Amount</th>
                  <th>Payment Paid 2<sup>nd</sup></th>
                  <th>2<sup>nd</sup> Paid Date</th>
                  <th>Due Amount</th>
                  <th>Total Amount <small>(EGP)</small></th>
                  <th>Actions</th>
                  <th>Status</th>
                  <th>Change Status</th>
                </tr>
                </thead>
                <tbody>
				<?php
					$ViewTests = mysqli_query($ClassDB, "SELECT * FROM `paitent_tests`");
					while($GD = mysqli_fetch_assoc($ViewTests)){
				?>
                <tr>
                  <td><?php echo $GD['invoice_id']; ?></td>
                  <td>
				  
				  <?php 
					$TestIDs = $GD['test_names']; 
					$test_ids = explode(', ',$TestIDs, -1);
					foreach($test_ids as $xx){
						$GetTestName = mysqli_query($ClassDB, "SELECT * FROM `tests` WHERE `Test_ID`='$xx'");
						$TN = mysqli_fetch_assoc($GetTestName);
						echo '<span class="secBox">'.$TN['Test_Name'].'</span>';
					}
				  ?>
				  
				  </td>
                  <td><?php $paitent_id = $GD['paitent_name']; $GetPData = mysqli_query($ClassDB, "SELECT * FROM `patient` WHERE `patient_id`='$paitent_id'"); $GPD = mysqli_fetch_assoc($GetPData); echo $GPD['patient_fname'].' '.$GPD['patient_lname']; ?></td>
                  <td><?php echo $GPD['patient_mobile_one']; ?></td>
                   <td><?php echo $GD['request_date']; ?></td>
                  
                  <td><?php if(empty($GD['paid_amount'])){ echo "<div class='badge badge-danger'>Waiting For Payment</div>"; }elseif($GD['paid_part_two'] == $GD['price']){ echo "<div class='badge badge-danger'>Amount Paid Completely</div>"; }else{ echo $GD['paid_amount']; } ?></td>
                 
                  <td><?php if(empty($GD['paid_part_two'])){ echo "<div class='badge badge-danger'>Waiting For Payment</div>"; }elseif($GD['paid_amount'] == $GD['price']){ echo "<div class='badge badge-danger'>Amount Paid Completely</div>"; }else{ echo $GD['paid_part_two']; } ?></td>
                  
                  <td><?php echo $GD['paid_part_two_time']; ?></td>
                  <td><?php echo $GD['price'] - ($GD['paid_amount'] + $GD['paid_part_two']); ?></td>
                  <td><?php echo $GD['price']; ?></td>
                  
                  <td><a href="view-patient-tests.php?view=<?php echo $GD['id']; ?>"><i class="fa fa-print"></i></a>&nbsp;&nbsp;
                     
                     <?php if(($GD['paid_amount'] + $GD['paid_part_two']) == $GD['price']){}else{ ?> <a href="due_amount_pay.php?pay=<?php echo $GD['id']; ?>"><i class="fa fa-money"></i></a>
                     <?php } ?>
                  </td>
				  <td><div class="badge badge-primary"><?php echo $GD['status']; ?></div></td>
				  <td>
					<div class="btn-group">
						  <button type="button" class="btn btn-success">Status</button>
						  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu" role="menu">
							<li><a <?php if($GD['status'] == 'Paid'){ echo "style='display: none;'"; } ?> href="?paid=<?php echo $GD['id']; ?>">Paid</a></li>
						  </ul>
						</div>
					</div>
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
</div>
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
            'excelHtml5'
        ]
    } );
} );
</script>
</body>
</html>
