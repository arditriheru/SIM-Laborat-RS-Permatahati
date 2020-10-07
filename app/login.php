<?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>SIMRS | Laboratorium</title>
	<!-- Login page CSS -->
	<link rel="stylesheet" type="text/css" href="../vendors/css/style.css">
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="../vendors/css/bootstrap.css">
	<!-- Add custom CSS here -->
	<link rel="stylesheet" type="text/css" href="../vendors/css/sb-admin.css">
	<link rel="stylesheet" type="text/css" href="../vendors/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/css/sweetalert.css">
</head>
<body>
	<?php
	if (isset($_POST['loginsubmit'])){
		session_start();
		include '../config/connect.php';
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$a = mysqli_query($koneksi,"SELECT *
			FROM psdi_petugas
			WHERE username='$username'
			AND password='$password'");
		while($b = mysqli_fetch_array($a)){
			$id_petugas 	= $b['id_petugas'];
			$nama_login		= $b['nama_petugas'];
		}

		$cek = mysqli_num_rows($a);
		if($cek > 0){
			$_SESSION['id_petugas'] 	= $id_petugas;
			$_SESSION['username'] 		= $username;
			$_SESSION['nama_login'] 	= $nama_login;
			$_SESSION['status'] 		= "Admin";
			echo "<script>
			setTimeout(function() {
				swal({
					title: 'Sukses',
					text: 'Selamat Datang $nama_login',
					type: 'success'
					}, function() {
						window.location = 'dashboard.php';
						});
						}, 10);
						</script>";
					}else{
						echo "<script>
						setTimeout(function() {
							swal({
								title: 'Upss..',
								text: 'Usernama / Password Salah',
								type: 'error'
								}, function() {
									window.location = 'login.php';
									});
									}, 10);
									</script>";
								}
							}
							?>
							<div class="kotak_login">
								<div align="center"><i class="fa fa-user-circle-o fa-3x"></i></div><br>
								<form method="post">
									<!-- <label>Username</label> -->
									<input type="text" name="username" class="form_login" placeholder="Username" required>
									<!-- <label>Password</label> -->
									<input type="password" name="password" class="form_login" placeholder="Password" required>
									<input type="submit" class="tombol_login" name="loginsubmit" value="Submit">
									<br><br>			
								</form>
							</div>
							<?php include "../../system/copyright.php";?>
							<!-- JavaScript -->
							<script type="text/javascript" src="../vendors/js/font-awesome.js"></script>
							<script type="text/javascript" src="../vendors/js/jquery-1.10.2.js"></script>
							<script type="text/javascript" src="../vendors/js/bootstrap.js"></script>
							<script type="text/javascript" src="../vendors/js/sweetalert.min.js"></script>
							<!-- Page Specific Plugins -->
							<script type="text/javascript" src="../vendors/chartjs/Chart.js"></script>
							<script type="text/javascript" src="../vendors/js/morris/chart-data-morris.js"></script>
							<script type="text/javascript" src="../vendors/js/tablesorter/jquery.tablesorter.js"></script>
							<script type="text/javascript" src="../vendors/js/tablesorter/tables.js"></script>
						</body>
						</html>
