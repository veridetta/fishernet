<?php
$page = 'penjualan';
include 'header.php';
include '../inc/koneksi.php';
include '../inc/function.php';
?>

<?php
if (isset($_POST['simpan'])) {
    //upload foto

    $tanggal = $_POST['tanggal'];
    $id_jenis_ikan = $_POST['id_jenis_ikan'];
    $id_pengguna = $_POST['id_pengguna'];
    $jumlah_terjual = $_POST['jumlah_terjual'];
	$sql = $koneksi->query("SELECT * FROM jenis_ikan WHERE id='$id_jenis_ikan'");
	$harga=$sql->fetch_assoc()['harga'];
	$total = $jumlah_terjual*$harga; 
    $sql = $koneksi->query("UPDATE penjualan set tanggal='$tanggal' ,id_jenis_ikan='$id_jenis_ikan', id_pengguna='$id_pengguna',jumlah_terjual='$jumlah_terjual',total_harga='$total'");
    if (!$sql) {
        die('ada masalah query') . mysqli_connect_error();
    } else {
?>
        <script type="text/javascript">
            alert("Data Berhasil Disimpan");
            window.location.href = "<?= $page ?>.php";
        </script>
<?php
    }
}
$id = $_GET["id"];
$hasil = $koneksi->query("SELECT * from penjualan where id='$id'");
if (!$hasil)
    die('Ada masalah query = ' . $db->error);
$d = $hasil->fetch_assoc();
?>
<div class="konten">
    <div class="panel">
        <div class="card">
            <div class="card-header">
                <h2>Penjualan / <span style="text-decoration: underline;">Tambah</span></h2>
                <!-- <a class="tombol-tambah" href="tes">Tambah Data <span class="las la-plus"></span></a> -->
            </div>
            <div class="card-body">
                <div class="isi">
                    <form method="POST" enctype='multipart/form-data'>
                        <table width=100% style="border-spacing: 10px;">
                            <?php edit('date', 'tanggal',$d['tanggal'],3); ?>
                            <!-- tes -->
                            <tr>
                                <td>
                                    <h4>Jenis Ikan</h4>
                                </td>
                                <td>:</td>
                                <td>
                                    <select name="id_jenis_ikan" class="text-input" />
                                    <option value="">-- Pilih Jenis Ikan --</option>
                                    <?php
                                    $sql = $koneksi->query("SELECT * FROM jenis_ikan");
                                    while ($data = $sql->fetch_assoc()) {
                                        echo "<option value='$data[id]'>$data[nama_ikan]</option>";
                                    }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>Nama Pembeli</h4>
                                </td>
                                <td>:</td>
                                <td>
                                    <select name="id_pengguna" class="text-input" />
                                    <option value="">-- Pilih Pembeli --</option>
                                    <?php
                                    $sql = $koneksi->query("SELECT * FROM pengguna WHERE role=2");
                                    while ($data = $sql->fetch_assoc()) {
                                        echo "<option value='$data[id]'>$data[nama]</option>";
                                    }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <!-- tes -->
                            <?php edit('number', 'jumlah_terjual',$d['jumlah_terjual'],3) ?>
                        </table>
                        <input type="submit" name="simpan" value="Simpan" class="tombol-tambah">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
