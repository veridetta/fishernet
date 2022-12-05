<?php
session_start();
// date_default_timezone_set('Asia/Singapore');



require 'inc/koneksi.php';

if (isset($_GET['pesan'])) {
	if ($_GET['pesan'] == "gagal") {
		echo "<script>alert('pastikan username dan password benar!')</script>";
	} elseif ($_GET['pesan'] == "berhasil") {
		if($_SESSION['role']==1){
		echo "<script>
        alert('Sukses!')
        window.location.href='admin/index.php';
        </script>";
		// header("Location: admin/index.php");
		}
		else{
			echo "<script>
        alert('Sukses!')
        window.location.href='user/jenis_ikan.php';
        </script>";
		}
	}
}


if (isset($_POST['btn-login'])) {
	$uname = mysqli_real_escape_string($koneksi, $_POST['username']);
	$upass = mysqli_real_escape_string($koneksi, $_POST['password']);

	// menyeleksi data user dengan username dan password yang sesuai
	$login = mysqli_query($koneksi, "SELECT * from pengguna where username='$uname' and password='$upass';");


	// menghitung jumlah data yang ditemukan
	$cek = mysqli_num_rows($login);

	// cek apakah username dan password di temukan pada database
	if ($cek > 0) {

		$data = mysqli_fetch_assoc($login);
		$_SESSION["login"] = true;
		$_SESSION["username"] = $data["username"];
		$_SESSION["nama"] = $data["nama"];
		$_SESSION["role"] = $data["role"];
		$_SESSION["foto"] = $data["foto"];
		$_SESSION["id"] = $data["id"];
		// echo "<script>alert('Anda Berhasil Login!')</script>";
		// header("Location: admin/index.php");
		header("Location: login.php?pesan=berhasil");
	} else {
		header("location:login.php?pesan=gagal"); // Jika Username dan Password Tidak Teridentifikasi
	}
}
?>


<!DOCTYPE html>
<html>

<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="login/fontawesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="login/style.css">
</head>

<body>
	<div class="container">
		<div class="header">
			<h1>Fishernet</h1>
		</div>
		<div class="main">
			<form method="POST">
				<span>
					<i class="fa fa-user"></i>
					<input type="text" placeholder="Username" name="username">
				</span><br>
				<span>
					<i class="fa fa-lock"></i>
					<input type="password" placeholder="password" name="password">
				</span><br>
				<input type="submit" value="LOGIN" class="login" name="btn-login">

			</form>
		</div>
	</div>
</body>

</html>