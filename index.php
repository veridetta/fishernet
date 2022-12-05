<?php
include 'inc/koneksi.php';

// $query = "SELECT * FROM jenis_ikan";
// $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/c26cd2166c.js"></script>
    <link rel="stylesheet" href="assets/css/style-landingpage.css">
</head>

<body>
    <div id="nav" style="z-index: 100;">
        <ul>
            <div id="logo" style="z-index: 100;">LOGO</div>
            <li><a href="login.php" style="z-index: 100;">Login</a></li>
        </ul>
    </div>

    <div class="hero" style="background-image: linear-gradient(to right, rgba(66, 197, 245, .6), rgba(66, 197, 245,.6)),url(./assets/img/fisherman.jpg); z-index: -100;">
        <div class="judul">
            <p>Selamat Datang di Fishernet</p>
            <h6>Fishernet merupakan aplikasi yang berfokus pada Prediksi Penjualan dan Persediaan  dengan menggunakan metode Single Exponential Smoothing dan Long Short Term Memory</h6>
        </div>
    </div>
    <div id="pera">
        <div id="pera1">
            <p style="font-weight: bold;">Single Exponential Smoothing </p>
            <p>Metode single exponential smoothing merupakan metode yang digunakan pada peramalan jangka pendek yang biasanya hanya 1 bulan ke depan yang mengasumsikan bahwa data berfluktuasi di sekitar nilai mean yang tetap tanpa trend atau pola pertumbuhan konsisten</p>
        </div>
        <div id="pera2">
            <p style="font-weight: bold;">Long Short Term Memory</p>
            <p>merupakan algoritma Deep Learning yang populer dan cocok digunakan untuk membuat prediksi dan klasifikasi yang berhubungan dengan waktu.</p>
        </div>
    </div>

    <div id="feature">
        <h1>Features</h1>
        <div id="finside" style="background: #dddddd;">
            <div id="f1">
                <div id="icon">
                    <i class="fas fa-hat-wizard"></i>
                </div>
                <h2>Prediksi Ikan Yang Harus Disediakan</h2>
                <p>Terdapat fitur prediksi ikan yang harus disediakan oleh sebuah perusahaan sehingga dapat mempermudah dalam pengambilan keputusan.</p>
            </div>
            <div id="f1">
                <div id="icon">
                    <i class="fas fa-palette"></i>
                </div>
                <h2>Prediksi Penjualan</h2>
                <p>Bisa dijadikan sebagai tolak ukur dalam manejemen persedian mengikuti dengan trend pasar yang ada.</p>
            </div>

        </div>
    </div>

    <!-- <div id="video">
        <img src="./img/video.mp4" alt="">
    </div> -->





</body>

</html>