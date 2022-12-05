<?php
$page = 'prediksi_penjualan';
include 'header.php';
include '../inc/koneksi.php';
include '../inc/function.php';

rst();
?>



<div class="konten">
    <div class="panel">
        <div class="card">
            <div class="card-header">
                <h2>Prediksi Penjualan</h2>
                <!-- <a class="tombol-tambah" href="tes">Tambah Data <span class="las la-plus"></span></a> -->
            </div>
            <div class="card-body">
                <br>
                <!-- Pencarian -->
                <table width="100%" class="pencarian-tanggal">
                    <tr>
                        <form method="POST">
                            <td width="25%">
                                <select name="periode" class="text-input" style="text-align: center;" />
                                <option value="">-- Pilih Periode --</option>
                                <option value='1' style="text-align: left;">1 Bulan</option>
                                <option value='2' style="text-align: left;">2 Bulan</option>
                                </select>
                            </td>
                            <td width="25%">
                                <input type="number" placeholder="Nilai Alpha" class="text-input" min="0.1" max="0.9" step="0.1" name="alpha">
                            </td>
                            <td>
                                <input type="submit" name="submit" class="tombol-tambah" value="Submit" style="border-radius: 10px;">
                            </td>
                    </tr>
                    </form>
                </table>
                <!-- / Pencarian -->
                <br>


            </div>
        </div>
    </div>

</div>
<br>

<?php

if (isset($_POST['submit'])) {
    $periode = $_POST["periode"];
    $alpha = $_POST["alpha"];
include '../test.php';
?>

    <div class="konten">
        <div class="panel">
            <div class="card">
                <div class="card-header">
                    <h2>Proses Perhitungan</h2>
                    <!-- <a class="tombol-tambah" href="tes">Tambah Data <span class="las la-plus"></span></a> -->
                </div>
                <div class="card-body">
                    <div class="isi">
                        <h2>Nilai Alpha : <?= $alpha; ?></h2>
                        <table width="100%" class="table-data table-responsive">
                            <thead>
                                <tr>
                                    <td width="5%">No</td>
                                    <td width="10%">Bulan</td>
                                    <td width="12%">Tahun</td>
                                    <td>Data Aktual</td>
                                    <td>Peramalan</td>
                                    <td>MAD</td>
                                    <td>MSE</td>
                                    <td>MAPE</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                
                                $sql = $koneksi->query("SELECT DATE_FORMAT(penjualan.tanggal, '%m-%Y') as tanggal, sum(penjualan.total_harga) as jumlah FROM penjualan GROUP BY DATE_FORMAT(penjualan.tanggal, '%Y-%m')");
                                // $panjang_data = mysqli_num_rows($sql);
                                // echo ($panjang_data);
                                $panjang_data = $sql->num_rows;
                                $panjang_data += 1;
                                for ($i = 1; $i <= $panjang_data; $i++) {
                                    $data = $sql->fetch_assoc();
                                    // echo $panjang_data;
                                ?>
                                    <?php
                                    if ($no == $panjang_data) {
                                        $hasil_prediksi = $alpha * $da_min_1 + (1 - $alpha) * $f_min_1;
                                    } else {
                                        $pecah = explode("-", $data['tanggal']);
                                        $bln = $pecah[0];
                                        $thn = $pecah[1];
                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td style="text-align:left;"><?= bulan($bln); ?></td>
                                            <td><?= $thn; ?></td>
                                            <td style="text-align: right;"><?= rupiah($data['jumlah']) ?></td>
                                            <td style="text-align: right;">
                                                <!-- Peramalan -->
                                                <?php
                                                if ($no == 1) {
                                                    $da_min_1 =  $data['jumlah'];
                                                    echo "-";
                                                } elseif ($no == 2) {
                                                    $peramalan = $da_min_1;
                                                    echo rupiah(round($peramalan));
                                                    $f_min_1 = $da_min_1;
                                                    $da_min_1 =  $data['jumlah'];
                                                } else {
                                                    $peramalan = $alpha * $da_min_1 + (1 - $alpha) * $f_min_1;
                                                    echo rupiah(round($peramalan));
                                                    $f_min_1 = $peramalan;
                                                    $da_min_1 =  $data['jumlah'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <!-- MAD -->
                                                <?php
                                                if ($no == 1) {
                                                    echo "-";
                                                } else {
                                                    $mad = abs($data['jumlah'] - $peramalan);
                                                    echo round($mad, 3);
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <!-- MSE -->
                                                <?php
                                                if ($no == 1) {

                                                    echo "-";
                                                } else {
                                                    $mse = pow($data['jumlah'] - $peramalan, 2);
                                                    echo round($mse, 3);
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <!-- MAPE -->
                                                <?php
                                                if ($no == 1) {
                                                    echo "-";
                                                } else {
                                                    $mape = (abs($data['jumlah'] - $peramalan)) / $data['jumlah'];
                                                    echo round($mape, 3);
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                    $no++;
                                } ?>
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="konten">
        <div class="panel">
            <div class="card">
                <div class="card-header">
                    <h2>Hasil Prediksi</h2>
                </div>
                <div class="card-body">
                    <div class="isi">
                        <h2>Hasil Peramalan Bulan Januari 2022 : <?= rupiah(round($hasil_prediksi)); ?> </h2>
                        <h2>Akurasi : <?= intval($akurasi*100)?>%</h2>
                    </div>
                    <br>
                </div>
            </div>
        </div>

    </div>
    <br>
<?php
}
?>

<?php include 'footer.php'; ?>