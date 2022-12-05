<?php
$page = 'prediksi_ikan_disediakan';
include 'header.php';
include '../inc/koneksi.php';
include '../inc/function.php';
?>



<div class="konten">
    <div class="panel">
        <div class="card">
            <div class="card-header">
                <h2>Prediksi Ikan yang Disediakan

                    <?php
                    // $list = shell_exec("python C:/xampp/htdocs/fishernet/admin/py.py $page");
                    // echo "<pre>$list</pre>";
                    ?>

                </h2>
                <!-- <a class="tombol-tambah" href="tes">Tambah Data <span class="las la-plus"></span></a> -->
            </div>
            <div class="card-body">
                <br>
                <!-- Pencarian -->
                <table width="100%" class="pencarian-tanggal">
                    <tr>
                        <form method="POST">
                            <td width="25%">
                                <select name="jenis_ikan" class="text-input" style="text-align: center;" />
                                <option value="">-- Pilih Jenis Ikan --</option>
                                <?php
                                $sql = $koneksi->query("SELECT * FROM jenis_ikan");
                                while ($dataa = $sql->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $dataa['id']; ?>"> <?php echo $dataa['nama_ikan']; ?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </td>
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
    $jenis_ikan = $_POST["jenis_ikan"];
    $periode = $_POST["periode"];
    $alpha = $_POST["alpha"];
include '../tests.php';
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
                        <h2>Jenis ikan : <?php echo $jenis_ikan; ?></h2>
                        <table width="100%" class="table-data table-responsive">
                            <thead>
                                <tr>
                                    <td width="5%">No</td>
                                    <td width="10%">Bulan</td>
                                    <td width="12%">Tahun</td>
                                    <td>Data Aktual (Perkg)</td>
                                    <td>Peramalan (Perkg)</td>
                                    <td>MAD</td>
                                    <td>MSE</td>
                                    <td>MAPE</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = $koneksi->query("SELECT DATE_FORMAT(penjualan.tanggal, '%m-%Y') as tanggal, jenis_ikan.nama_ikan as nama_ikan, sum(penjualan.jumlah_terjual) as jumlah FROM penjualan
                            JOIN jenis_ikan ON penjualan.id_jenis_ikan = jenis_ikan.id
                            WHERE jenis_ikan.id = '$jenis_ikan'
                            GROUP BY DATE_FORMAT(penjualan.tanggal, '%Y-%m'), jenis_ikan.nama_ikan");
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
                                            <td><?= $data['jumlah'] ?></td>
                                            <td>
                                                <!-- Peramalan -->
                                                <?php
                                                if ($no == 1) {
                                                    $da_min_1 =  $data['jumlah'];
                                                    $f_min_1=0.2;
                                                    echo "-";
                                                } elseif ($no == 2) {
                                                    $peramalan = $da_min_1;
                                                    echo $peramalan;
                                                    $f_min_1 = $da_min_1;
                                                    $da_min_1 =  $data['jumlah'];
                                                } else {
                                                    $peramalan = $alpha * $da_min_1 + (1 - $alpha) * $f_min_1;
                                                    echo $peramalan;
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
                                                    echo $mad;
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
                                                    echo $mse;
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
                                                    echo $mape;
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
                        <h2>Hasil Peramalan Bulan Januari 2022 : <?= $hasil_prediksi; ?> per kg</h2>
                        <h2>Akurasi : <?= intval($akurasi*100)?>%</h2>
                    </div>
                    <br>
                </div>
            </div>
        </div>

    </div>
    <br><br>
    <div class="konten">
        <div class="panel">
            <div class="card">
                <div class="card-header">
                    <h2>Pemberian Laporan Melalui WhatsApp</h2>
                </div>
                <div class="card-body">
                    <div class="isi">
                      <table>
                        <tr>
                        <form method="POST">
                            <td width="25%">
                                <input type="hidden" value="<?=$jenis_ikan?>"  name="jenis_ikan">
                            </td>
                            <td width="25%">
                                <input type="hidden" placeholder="Nilai Alpha" value="<?=$alpha?>" class="text-input" min="0.1" max="0.9" step="0.1" name="alpha">
                            </td>
                            <td width="25%">
                                <input  type="hidden" value="<?=$periode?>"name="periode">
                            </td>
                            <td>
                                <input type="submit" name="submits" class="tombol-tambah" value="Submit" style="border-radius: 10px;">
                            </td>
                    </form>
                    </tr>
                    </table>
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