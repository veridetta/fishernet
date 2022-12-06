<?php
$page = 'penjualan';
include 'header.php';
include '../inc/koneksi.php';
include '../inc/function.php';

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

?>

<?php
session_start();

if (isset($_POST['tombolcari'])) {
    $cari = $_POST["cari"];
    $bulan = $_POST["bulan"];
    $tahun = $_POST["tahun"];
    $_SESSION['cari'] = $cari;
    $_SESSION['bulan'] = $bulan;
    $_SESSION['tahun'] = $tahun;
    $_SESSION['status'] = 'true';
} else {
    $cari = $_SESSION['cari'];
    $bulan = $_SESSION['bulan'];
    $tahun = $_SESSION['tahun'];
}

if ($cari == null) {
    $ambildata = $koneksi->query("SELECT penjualan.id, penjualan.tanggal,pengguna.nama, jenis_ikan.nama_ikan, jenis_ikan.harga, penjualan.jumlah_terjual, penjualan.total_harga FROM penjualan
LEFT JOIN jenis_ikan ON jenis_ikan.id = penjualan.id_jenis_ikan JOIN pengguna ON pengguna.id = penjualan.id_pengguna");
} elseif ($cari == !null and $bulan == null and $tahun == null) {
    $ambildata = $koneksi->query("SELECT penjualan.id, penjualan.tanggal,pengguna.nama, jenis_ikan.nama_ikan, jenis_ikan.harga, penjualan.jumlah_terjual, penjualan.total_harga FROM penjualan
    LEFT JOIN jenis_ikan ON jenis_ikan.id = penjualan.id_jenis_ikan JOIN pengguna ON pengguna.id = penjualan.id_pengguna
    WHERE penjualan.id_jenis_ikan = '$cari'");
} elseif ($cari == !null and $bulan == !null and $tahun == !null) {
    $ambildata = $koneksi->query("SELECT penjualan.id, penjualan.tanggal,pengguna.nama, jenis_ikan.nama_ikan, jenis_ikan.harga, penjualan.jumlah_terjual, penjualan.total_harga FROM penjualan
    LEFT JOIN jenis_ikan ON jenis_ikan.id = penjualan.id_jenis_ikan  JOIN pengguna ON pengguna.id = penjualan.id_pengguna
    WHERE penjualan.id_jenis_ikan = '$cari' AND MONTH(penjualan.tanggal) = '$bulan' AND YEAR(penjualan.tanggal) = '$tahun'
    ORDER BY penjualan.tanggal, jenis_ikan.nama_ikan");
}

// Konfigurasi Pagination
$jumlahData = 10;
$totalData = mysqli_num_rows($ambildata);
$jumlahPagination = ceil($totalData / $jumlahData);

if (isset($_GET['halaman'])) {
    $halamanAktif = $_GET['halaman'];
} else {
    $halamanAktif = 1;
}

$dataAwal = ($halamanAktif * $jumlahData) - $jumlahData;

$jumlahLink = 3;
if ($halamanAktif > $jumlahLink) {
    $start_number = $halamanAktif - $jumlahLink;
} else {
    $start_number = 1;
}

if ($halamanAktif < ($jumlahPagination - $jumlahLink)) {
    $end_number = $halamanAktif + $jumlahLink;
} else {
    $end_number = $jumlahPagination;
}
// End

if ($cari == null) {
    // echo 'kondisi 1';
    $ambildata_perhalaman = $koneksi->query("SELECT penjualan.id, penjualan.tanggal,pengguna.nama, s.nama as supplier, jenis_ikan.nama_ikan, jenis_ikan.harga, penjualan.jumlah_terjual, penjualan.total_harga FROM penjualan
    LEFT JOIN jenis_ikan ON jenis_ikan.id = penjualan.id_jenis_ikan  JOIN pengguna ON pengguna.id = penjualan.id_pengguna join pengguna s on s.id=penjualan.id_supplier
    ORDER BY tanggal
    LIMIT $dataAwal, $jumlahData");
} elseif ($cari == !null and $bulan == null and $tahun == null) {
    // echo 'kondisi 2';

    $ambildata_perhalaman = $koneksi->query("SELECT penjualan.id, penjualan.tanggal,pengguna.nama, jenis_ikan.nama_ikan, jenis_ikan.harga, penjualan.jumlah_terjual, penjualan.total_harga FROM penjualan
LEFT JOIN jenis_ikan ON jenis_ikan.id = penjualan.id_jenis_ikan JOIN pengguna ON pengguna.id = penjualan.id_pengguna
WHERE penjualan.id_jenis_ikan = '$cari'
LIMIT $dataAwal, $jumlahData ");
} elseif ($cari == !null and $bulan == !null and $tahun == !null) {
    // echo 'kondisi 3';
    $ambildata_perhalaman = $koneksi->query("SELECT penjualan.id, penjualan.tanggal,pengguna.nama, jenis_ikan.nama_ikan, jenis_ikan.harga, penjualan.jumlah_terjual, penjualan.total_harga FROM penjualan
    LEFT JOIN jenis_ikan ON jenis_ikan.id = penjualan.id_jenis_ikan JOIN pengguna ON pengguna.id = penjualan.id_pengguna
    WHERE penjualan.id_jenis_ikan = '$cari' AND MONTH(penjualan.tanggal) = '$bulan' AND YEAR(penjualan.tanggal) = '$tahun'
    ORDER BY penjualan.tanggal, jenis_ikan.nama_ikan
    LIMIT $dataAwal, $jumlahData");
}



?>

<div class="konten">
    <div class="panel">
        <div class="card">
            <div class="card-header">
                <h2>Penjualan</h2>
                <a class="tombol-tambah" href="penjualan_tambah.php">Tambah Data <span class="las la-plus"></span></a>
            </div>
            <div class="card-body">
                <br>
                <!-- Pencarian -->
                <table width="100%" class="pencarian-tanggal">
                    <tr>
                        <form method="POST" action="penjualan.php">
                            <td width="30%" colspan="2">
                                <select name="cari" class="text-input" style="text-align: center;" />
                                <option value="">-- Pilih Jenis Ikan --</option>
                                <?php
                                $sql = $koneksi->query("SELECT * FROM jenis_ikan");
                                while ($data = $sql->fetch_assoc()) {
                                ?>
                                    <option <?= $data["id"] == $cari ? "selected" : ""; ?> value="<?php echo $data['id']; ?>"> <?php echo $data['nama_ikan']; ?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </td>
                            <td rowspan="2">
                                <input type="submit" name="tombolcari" class="tombol-tambah" value="Cari" style="height: 75px; border-radius: 10px;">
                            </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="bulan" class="text-input" />
                            <option value="">-- Pilih Bulan --</option>
                            <option value='1' <?= $bulan == "1" ? "selected" : ""; ?>>Januari</option>
                            <option value='2' <?= $bulan == "2" ? "selected" : ""; ?>>Februari</option>
                            <option value='3' <?= $bulan == "3" ? "selected" : ""; ?>>Maret</option>
                            <option value='4' <?= $bulan == "4" ? "selected" : ""; ?>>April</option>
                            <option value='5' <?= $bulan == "5" ? "selected" : ""; ?>>Mei</option>
                            <option value='6' <?= $bulan == "6" ? "selected" : ""; ?>>Juni</option>
                            <option value='7' <?= $bulan == "7" ? "selected" : ""; ?>>Juli</option>
                            <option value='8' <?= $bulan == "8" ? "selected" : ""; ?>>Agustus</option>
                            <option value='9' <?= $bulan == "9" ? "selected" : ""; ?>>September</option>
                            <option value='10' <?= $bulan == "10" ? "selected" : ""; ?>>Oktober</option>
                            <option value='11' <?= $bulan == "11" ? "selected" : ""; ?>>November</option>
                            <option value='12' <?= $bulan == "12" ? "selected" : ""; ?>>Desember</option>
                            </select>
                        </td>
                        <td>
                            <?php
                            $nowYear = date('Y');
                            ?>
                            <select name='tahun' class='text-input'>
                                <option value="">-- Pilih Tahun --</option>
                                <?php
                                for ($a = 2020; $a <= 2021; $a++) {
                                ?>
                                    <option value='<?= $a ?>' <?= $a == $tahun ? "selected" : ""; ?>><?= $a ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    </form>
                </table>
                <!-- / Pencarian -->

                <div>
                    <div class="isi">
                        <div class="pagination">

                            <?php if ($halamanAktif > 1) : ?>
                                <a href="?halaman=<?php echo $halamanAktif - 1 ?>">
                                    &laquo;
                                </a>
                            <?php endif; ?>

                            <?php for ($i = $start_number; $i <= $end_number; $i++) : ?>
                                <?php if ($halamanAktif == $i) : ?>
                                    <a href="?halaman=<?php echo $i; ?>" style='color:red'>
                                        <?php echo $i; ?>
                                    </a>
                                <?php else : ?>
                                    <a href="?halaman=<?php echo $i; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php if (($halamanAktif < $jumlahPagination) and ($halamanAktif >= 1)) : ?>
                                <a href="?halaman=<?php echo $halamanAktif + 1 ?>">
                                    &raquo;
                                </a>
                            <?php endif; ?>

                        </div>

                        <table width="100%" class="table-data table-responsive">
                            <thead>
                                <tr>
                                    <td width="5%">No</td>
                                    <td width="10%">Tanggal</td>
                                    <td width="10%">Jenis Ikan</td>
                                    <td width="12%">Harga</td>
                                    <td width="11%">Jumlah Terjual</td>
                                    <td width="15%">Total Penjualan</td>
                                    <td width="12%">Supplier</td>
                                    <td width="12%">Pembeli</td>
                                    <td width="20%">Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1 + $dataAwal;
                                while ($data = $ambildata_perhalaman->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $data['tanggal'] ?></td>
                                        <td><?= $data['nama_ikan'] ?></td>
                                        <td style="text-align: right;"><?= rupiah($data['harga']) ?></td>
                                        <td><?= $data['jumlah_terjual'] . " / KG" ?></td>
                                        <td style="text-align: right;"><?= rupiah($data['total_harga']) ?></td>
                                        <td style="text-align: center;"><?= $data['supplier']?></td>
                                        <td style="text-align: center;"><?= $data['nama']?></td>
                                        <td align="center">
                                            <a href="penjualan_edit.php?id=<?= $data['id'] ?>" class="tombol-edit">Edit</span></a>
                                            <a href="penjualan_hapus.php?id=<?= $data['id'] ?>" class="tombol-hapus">Hapus</span></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>