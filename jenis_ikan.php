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


    <form method="POST">
        <table width="100%">
            <tr>
                <td width="33%"></td>
                <td align="center" width="33%">
                    <input type="text" name="jenis_ikan" class="text-input" style="text-align:center;">

                </td>
                <td>
                    <input type="submit" style="height:calc(1.5em + 0.75rem + 2px);" value="Cari" class="tombol-tambah" name="cari">
                </td>
            </tr>
        </table>
    </form>

    <section class="container2" style="background: #dddddd;">
        <br>


        <?php
        $no = 1;
        if (isset($_POST['cari'])) {
            if ($_POST['jenis_ikan'] == !null) {
                $jenis_ikan = $_POST['jenis_ikan'];
                $sql = $koneksi->query("SELECT * from jenis_ikan WHERE nama_ikan = '$jenis_ikan'");
            } else {
                $sql = $koneksi->query("SELECT * from jenis_ikan");
            }
        } else {
            $sql = $koneksi->query("SELECT * from jenis_ikan");
        }



        while ($data = $sql->fetch_assoc()) {
        ?>
            <div class="card2">
                <div class="card2-image" style="background-image: url(./file-upload/<?= $data['foto'] ?>);"></div>
                <h2><?= $data['nama_ikan'] ?></h2>

                <?php
                $string = strip_tags($data["deskripsi"]);
                if (strlen($string) > 150) :
                    $stringCut = substr($string, 0, 150);
                    $endPoint = strrpos($stringCut, ' ');
                    $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    $string .= '...<span class="text-blue">Selengkapnya</span>';
                endif;
                ?>
                <p align="justify"><?= $string ?></p>
                <a href="detail_jenis_ikan.php?id=<?php echo $data['id'] ?>">Detail</a>
            </div>
        <?php
        }
        ?>
    </section>




</body>

</html>