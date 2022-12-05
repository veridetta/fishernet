<?php
session_start();
// date_default_timezone_set('Asia/Singapore');



require 'inc/koneksi.php';

if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
        echo "<script>alert('pastikan username dan password benar!')</script>";
    } elseif ($_GET['pesan'] == "berhasil") {
        echo "<script>
        alert('Sukses!')
        window.location.href='admin/index.php';
        </script>";
        // header("Location: admin/index.php");
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
        // $_SESSION["login"] = true;
        // $_SESSION["level_akses"] = $data["level_akses"];
        // $_SESSION["username"] = $data["username"];
        // $_SESSION["id"] = $data["id"];
        // echo "<script>alert('Anda Berhasil Login!')</script>";
        // header("Location: admin/index.php");
        header("Location: login.php?pesan=berhasil");
    } else {
        header("location:login.php?pesan=gagal"); // Jika Username dan Password Tidak Teridentifikasi
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="login/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="login/css/style.css">
</head>

<body style="background: url('../fishernet/assets/img/bg-login.jpg'); background-size:cover; background-repeat: repeat-y;">

    <div class="main" style="background: url('../fishernet/assets/img/bg-login.jpg'); background-repeat: repeat-y; background-size:cover">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure>
                            <h2 style="margin-top: 40px; color:#42c5f5">
                                Fishernet
                            </h2>
                            <!-- <img src="no_image.png" alt="sign up image" width="50%" style="padding-right: 20px;"> -->
                        </figure>
                        <!-- <a href="registrasi.php" class="signup-image-link" style="margin-right: 30px;">Buat Akun Peserta?</a> -->
                    </div>

                    <div class="signin-form">

                        <h2 class="form-title" style="font-size: 29px; color:#42c5f5">Login Administrator</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="username" placeholder="Username Anda" />
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password Anda" />
                            </div>
                            <div class="form-group form-button">
                                <!-- <a href="index.php" name="btn-login" id="signin" class="form-submit" style="background: #737373; text-decoration: none;">Home</a> -->
                                <input type="submit" name="btn-login" id="signin" class="form-submit" value="Log in" / style="background: #42c5f5;">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <!-- <script src="admin/assets/style/login/vendor/jquery/jquery.min.js"></script>
    <script src="admin/assets/style/login/js/main.js"></script> -->
</body>


</html>