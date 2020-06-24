<?php 
include '../include/Class.DB.php';
$DRID = $_POST['drid'];
?>
<option value="">Select Session </option>
							<?php
								$GetSession = mysqli_query($ClassDB, "SELECT * FROM `doctors` WHERE `Doctor_id`='$DRID'");
								$GS = mysqli_fetch_assoc($GetSession);
								$SIDS = $GS['session_selected'];
								$Sessions = explode(',',$SIDS, -1);
								foreach($Sessions as $ses){
									$GetSe = mysqli_query($ClassDB, "SELECT * FROM `doctors_sessions` WHERE `session_id` = '$ses'");
									$sessionfetch = mysqli_fetch_array($GetSe);
							?>
								<option value="<?php echo $sessionfetch['session_id']; ?>"> <?php echo $sessionfetch['session_day']; ?> - <?php echo $sessionfetch['session_time']; ?> </option>
							<?php
								}
							?>