<?php
$page = 'dashboard';
include 'header.php';
include '../inc/function.php';
include '../inc/koneksi.php';
?>

<div class="cards">
    <div class="card-single">
        <div>
            <h1>54</h1>
            <span>Pengguna</span>
        </div>
        <div>
            <span class="las la-users"></span>
        </div>
    </div>

    <div class="card-single">
        <div>
            <h1>30</h1>
            <span>Jenis Ikan</span>
        </div>
        <div>
            <span class="las la-dollar-sign"></span>
        </div>
    </div>

    <div class="card-single">
        <div>
            <h1>124</h1>
            <span>Persediaan Ikan</span>
        </div>
        <div>
            <span class="las la-fish"></span>
        </div>
    </div>
    <br/>
    <div class="card-single col-lg-12">
        <div>
            <h1>Rp.1.500.000,00</h1>
            <span>Penjualan</span>
        </div>
        <div>
            <!-- <span class="lab la-google-wallet"></span> -->
        </div>
    </div>

</div>

<br>
<div class="konten">
    <div class="panel">
        <div class="card">
            <div class="card-header">
                <h2>Grafik Penjualan
                    <?php
                    if (isset($_POST['pilih_grafik'])) {
                        $tahun = $_POST["tahun"];
                        echo $tahun;
                    }
                    ?>

                </h2>
            </div>
            <div class="card-body">
                <div class="isi">
                    <?php
                    $nowYear = date('Y');
                    ?>
                    <form method="POST">
                        <table>
                            <tr>
                                <td>
                                    <select name='tahun' class='text-input' style="width: 200px;">
                                        <option value="">-- Pilih Tahun --</option>
                                        <?php
                                        for ($a = 2020; $a <= $nowYear; $a++) {
                                        ?>
                                            <option value='<?= $a ?>'><?= $a ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="submit" name="pilih_grafik" value="Pilih" class="tombol-tambah">
                                </td>
                            </tr>
                        </table>

                    </form>
                    <br>

                    <?php
                    if (isset($_POST['pilih_grafik'])) {
                    ?>
                        <canvas id="barchart" width="210px" height="55px"></canvas>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include 'footer.php'; ?>