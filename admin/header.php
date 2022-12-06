<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fishernet</title>

    <!-- <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/1.3.0/css/line-awesome.min.css"> -->

    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/style-adminpanel.css">
    <script src="../assets/js/Chart.js"></script>
</head>

<body style="width: 100vw;">
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar" >
        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft"></span><span>Fishernet</span></h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="index.php" <?php if ($page == 'dashboard') echo 'class="active"' ?>><span class="las la-igloo"></span><span>Dashboard</span></a>
                </li>
                <!-- <li>
                    <a href=""><span class="las la-clipboard-list"></span><span>Master Data</span></a>
                </li> -->
                <li>
                    <a href="jenis_ikan.php" <?php if ($page == 'jenis_ikan') echo 'class="active"' ?>><span class="las la-fish"></span><span>Jenis Ikan</span></a>
                </li>
                <li>
                    <a href="penjualan.php" <?php if ($page == 'penjualan') echo 'class="active"' ?>><span class="las la-receipt"></span><span>Penjualan</span></a>
                </li>
                <li>
                    <a href="prediksi_penjualan.php" <?php if ($page == 'prediksi_penjualan') echo 'class="active"' ?>><span class="las la-chart-line"></span><span>Prediksi Penjualan</span></a>
                </li>
                <li>
                    <a href="prediksi_ikan_disediakan.php" <?php if ($page == 'prediksi_ikan_disediakan') echo 'class="active"' ?>><span class="las la-chart-line"></span><span>Prediksi Ikan yang Disediakan</span></a>
                </li>
                <li>
                    <a href="pengguna.php" <?php if ($page == 'pengguna') echo 'class="active"' ?>><span class="las la-user-circle"></span><span>Pengguna</span></a>
                </li>
                <li>
                    <a href="logout.php"><span class="las la-door-open"></span><span>Logout</span></a>
                </li>

            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars">

                    </span>
                </label>
                <?php
                // if ($page == 'dashboard') {
                //     echo 'Dashboard';
                // } elseif ($page == 'jenis_ikan') {
                //     echo 'Jenis Ikan';
                // } elseif ($page == 'penjualan') {
                //     echo 'Penjualan';
                // }
                ?>
            </h2>

            <div class="user-wrapper">
                <?php
                session_start();
                if ($_SESSION['foto'] == !null) {
                ?>
                    <a href="../file-upload/profil/<?= $_SESSION['foto'] ?>">
                        <img src="../file-upload/profil/<?= $_SESSION['foto'] ?>" alt="foto" width="50px">
                    </a>
                <?php

                } else {
                    echo '<img src="../assets/img/img2.jpg" width="40px" height="40px" alt="">';
                }
                ?>

                <div>
                    <h4><?php

                        echo ucfirst($_SESSION['nama']); ?></h4>
                    <small>Admin</small>
                </div>
            </div>
        </header>
        <main>