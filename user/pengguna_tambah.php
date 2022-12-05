<?php
$page = 'pengguna';
include 'header.php';
include '../inc/koneksi.php';
include '../inc/function.php';
?>

<div class="konten">
    <div class="panel">
        <div class="card">
            <div class="card-header">
                <h2>Pengguna / <span style="text-decoration: underline;">Tambah</span></h2>
                <!-- <a class="tombol-tambah" href="tes">Tambah Data <span class="las la-plus"></span></a> -->
            </div>
            <div class="card-body">
                <div class="isi">
                    <form method="POST" enctype='multipart/form-data'>
                        <table width=100% style="border-spacing: 10px;">
                            <?php tambah('text', 'nama') ?>
                            <?php tambah('text', 'username') ?>
                            <?php tambah('password', 'password') ?>
                            <?php tambah('file', 'foto') ?>
                        </table>
                        <input type="submit" name="simpan" value="Simpan" class="tombol-tambah">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<?php
if (isset($_POST['simpan'])) {
    //upload foto
    $directory = "../file-upload/";
    $file_name = $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], $directory . $file_name);

    $jenis_ikan = $_POST['jenis_ikan'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $sql = $koneksi->query("insert into jenis_ikan (nama_ikan, harga, deskripsi, foto) values('$jenis_ikan','$harga','$deskripsi','$file_name')");
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