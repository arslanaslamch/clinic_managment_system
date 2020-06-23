<?php
	include 'Superadmin/include/Class.DB.php';
	$username = mysqli_real_escape_string($ClassDB, $_POST['username']);
	$password = mysqli_real_escape_string($ClassDB, md5($_POST['password']));
	$chkUsername = mysqli_query($ClassDB, "SELECT * FROM `users` WHERE `user_name`='$username'");
	$chk = mysqli_fetch_assoc($chkUsername);
	$usr = $chk['user_name'];
	$pass = $chk['user_password'];
	$role = $chk['role'];
	$chkUsr = mysqli_num_rows($chkUsername);
	if($chkUsr == '0'){
		echo "<div class='alert alert-danger'><strong>Username invalid.!</strong>Username invalid or wrong.</div>";
	}else{
		if($pass == $password){
			session_start();
			$_SESSION['username'] = $usr;
			$_SESSION['password'] = $pass;
			$_SESSION['role'] = $role;
			if($role == 'superadmin'){
				echo "<script>location.href='Superadmin/'";
			}elseif($role == 'manager'){
				echo "<script>location.href='Manager/'";
			}else{
				echo "<script>location.href='Receptionist/'";
			}
		}else{
			echo "<div class='alert alert-danger'><strong>Password invalid.!</strong>Password invalid or wrong.</div>";
		}
	}
	

?>