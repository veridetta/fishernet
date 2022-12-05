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
    $id_pengguna = $_SESSION['id'];
    $jumlah_terjual = $_POST['jumlah_terjual'];
	$sql = $koneksi->query("SELECT * FROM jenis_ikan WHERE id='$id_jenis_ikan'");
	$harga=$sql->fetch_assoc()['harga'];
	$total = $jumlah_terjual*$harga; 
    $sql = $koneksi->query("insert into penjualan (tanggal, id_jenis_ikan, id_pengguna,jumlah_terjual,total_harga) values('$tanggal','$id_jenis_ikan','$id_pengguna','$jumlah_terjual','$total')");
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
?>
<div class="konten">
    <div class="panel">
        <div class="card">
            <div class="card-header">
                <h2>Checkout</h2>
                <!-- <a class="tombol-tambah" href="tes">Tambah Data <span class="las la-plus"></span></a> -->
            </div>
            <div class="card-body">
                <div class="isi">
                    <form method="POST" enctype='multipart/form-data'>
                        <table width=100% style="border-spacing: 10px;">
                            <?php tambah('date', 'tanggal') ?>
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
                                    <input type="" value='<?=$_SESSION['nama']?>' class="text-input"  disabled>
                                </td>
                            </tr>
                            <!-- tes -->
                            <tr>
								<td style="vertical-align: top; width: 25%">
									<h4>Jumlah Pembelian</h4>
								</td>
								<td style="vertical-align: top;">:</td>
								<td>
										<input type="number" placeholder="jumlah pembelian" class="text-input" name="jumlah_terjual">
								</td>
							</tr>
                        </table>
                        <input type="submit" name="simpan" value="Simpan" class="tombol-tambah">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
