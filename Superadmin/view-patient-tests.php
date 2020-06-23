<?php include "header.php"; ?>
<?php
	if(isset($_GET['view'])){
		$viewID = $_GET['view'];
		$getViewData = mysqli_query($ClassDB, "SELECT * FROM `paitent_tests` WHERE `id`='$viewID'");
		$GVD = mysqli_fetch_assoc($getViewData);
		
	}
?>
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
        All Patient
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Patients</a></li>
        <li class="active">All Patient</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	<div class="form-group">
			
	</div>
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">All Patients</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
		
        <!-- /.box-header -->
		<div class="box-body">
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
            <strong>Status: </strong><b style="color: green; text-transform: uppercase;"><i><?php echo $GVD['status']; ?></i></b><br>
            <strong>Invoice ID: </strong><?php echo $GVD['invoice_id']; ?><br>
            <strong>Invoice Date: </strong><?php echo date("M d, Y"); ?><br>
            <strong>Clinic Care Inc.</strong><br>
			<strong>Contact No: </strong>01 01 0970 291<br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <address>
            
          </address>
        </div>
		<div class="col-sm-4 invoice-col">
          <address>
            <strong>Patient Name: </strong><?php $paitent_id = $GVD['paitent_name']; $GetPData = mysqli_query($ClassDB, "SELECT * FROM `patient` WHERE `patient_id`='$paitent_id'"); $GPD = mysqli_fetch_assoc($GetPData); echo $GPD['patient_fname'].' '.$GPD['patient_lname']; ?><br>
            <strong>Test Request Date: </strong> <?php echo $GVD['request_date']; ?><br>
            <strong>Doctor Name <small>(Referred By)</small>: </strong> <?php $DocName = $GVD['reffered_by']; $DRGET = mysqli_query($ClassDB, "SELECT * FROM `doctors` WHERE `Doctor_ID`='$DocName'"); $getDoctorName = mysqli_fetch_assoc($DRGET); echo $getDoctorName['Doctor_fname'].' '.$getDoctorName['Doctor_lname']; ?><br>
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
              <th>Test ID</th>
              <th>Test Name</th>
              <th>Test Price</th>
            </tr>
            </thead>
            <tbody>
				<?php 
					$TestIDs = $GVD['test_names']; 
					$test_ids = explode(', ',$TestIDs, -1);
					foreach($test_ids as $xx){
						$GetTestName = mysqli_query($ClassDB, "SELECT * FROM `tests` WHERE `Test_ID`='$xx'");
						$TN = mysqli_fetch_assoc($GetTestName);
						echo '<tr><td>'.$TN['Test_ID'].'</td>';
						echo '<td>'.$TN['Test_Name'].'</td>';
						echo '<td class="total">'.$TN['Test_Amount'].'</td></tr>';
					}
				  ?>
            
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
                <th>Paid Amount:</th>
                <td><?php echo $GVD['paid_amount'] + $GVD['paid_part_two']; ?> <sup>egp</sup></td>
              </tr>
              <?php if($GVD['paid_amount'] != $GVD['price']){ ?>
              <tr>
                <th>Due Amount:</th>
                <td><?php echo $GVD['price'] - ($GVD['paid_amount'] + $GVD['paid_part_two']); ?> <sup>egp</sup></td>
              </tr>
              <?php } ?>
			  <tr>
                <th>Discount:</th>
                <td>0%</td>
              </tr>
			  <tr>
                <th>Grand Total:</th>
                <td><?php echo $GVD['price']; ?> <sup>egp</sup></td>
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
