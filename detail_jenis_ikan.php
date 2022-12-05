<?php
include 'inc/koneksi.php';
include 'inc/function.php';


$id = $_GET['id'];

$hasil = $koneksi->query("SELECT * from jenis_ikan where id='$id'");
if (!$hasil)
    die('Ada masalah query = ' . $db->error);
$d = $hasil->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/c26cd2166c.js"></script>
    <!-- <link rel="stylesheet" href="assets/css/style-adminpanel.css"> -->
    <link rel="stylesheet" href="assets/css/style-landingpage.css">
</head>

<body>
    <div id="nav" style="z-index: 100;">
        <ul>
            <div id="logo" style="z-index: 100;">LOGO</div>
            <li><a href="login.php" style="z-index: 100;">Login</a></li>
            <li><a href="#">Prediksi Penjualan</a></li>
            <li><a href="#">Prediksi Persediaan Ikan</a></li>
            <li><a href="jenis_ikan.php">Jenis Ikan</a></li>
            <li><a href="index.php">Beranda</a></li>
        </ul>
    </div>

    <div class="hero" style="background-image: linear-gradient(to right, rgba(66, 197, 245, .6), rgba(66, 197, 245,.6)),url(./assets/img/fisherman.jpg); z-index: -100; min-height:20vh; height:215px;">
        <div class="judul">
            <p style="padding-bottom: 0px; margin-top:50px;">Jenis Ikan</p>
        </div>
    </div>


    <section class="container2" style="background: #dddddd;min-height:550px;">
        <br>
        <table width="50%" style="margin-top: 20px;">
            <tr>
                <td rowspan="2" width="35%" valign="top" ">
                    <img src=" ./file-upload/<?= $d['foto'] ?>" alt="" width="300px">
                </td>
                <td height="10%">
                    <h2 style="margin-left: 10px;"><?= $d['nama_ikan'] ?></h2>
                    <br>
                    <h2 style="margin-left: 10px;">Harga Per KG : <?= rupiah($d['harga']) ?></h2>
                </td>
            </tr>
            <tr>
                <td valign=" top">
                    <p align="justify" style="margin-left: 10px;"><?= $d['deskripsi'] ?></p>
                </td>
            </tr>
        </table>

    </section>


</body>

</html>