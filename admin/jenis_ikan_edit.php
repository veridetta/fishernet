<?php
$page = 'jenis_ikan';
include 'header.php';
include '../inc/koneksi.php';
include '../inc/function.php';

$id = $_GET["id"];
$hasil = $koneksi->query("SELECT * from jenis_ikan where id='$id'");
if (!$hasil)
    die('Ada masalah query = ' . $db->error);
$d = $hasil->fetch_assoc();
?>

<div class="konten">
    <div class="panel">
        <div class="card">
            <div class="card-header">
                <h2>Jenis Ikan / <span style="text-decoration: underline;">Edit</span></h2>
                <!-- <a class="tombol-tambah" href="tes">Tambah Data <span class="las la-plus"></span></a> -->
            </div>
            <div class="card-body">
                <div class="isi">
                    <form method="POST" enctype='multipart/form-data'>
                        <table width=100% style="border-spacing: 10px;">
                            <?php edit('text', 'jenis_ikan', $d["nama_ikan"], 3) ?>
                            <?php edit('number', 'harga', $d["harga"], 3) ?>
                            <?php edit('text_area', 'deskripsi', $d["deskripsi"], 3) ?>
                            <?php edit('file', 'foto', $d["foto"], 0) ?>
                            <input type="text" value="<?= $d["foto"]; ?>" name="foto2" style="display: none;">
                        </table>
                        <hr>
                        <div style="padding-bottom: 10px;"></div>
                        <a href="<?= $page ?>.php" class="tombol-kembali">Kembali</a>
                        <button type="submit" name="ubah" class="tombol-edit" style="font-size: 15px;">Ubah</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<?php
if (isset($_POST['ubah'])) {
    //upload foto
    $jenis_ikan = $_POST["jenis_ikan"];
    $deskripsi = $_POST["deskripsi"];
    $harga = $_POST["harga"];
    $directory = "../file-upload/";

    if ($_FILES['foto']['name'] == null) {
        $file_name = $_POST['foto2'];
    } else {
        $file_name = $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $directory . $file_name);
    }

    $sql = $koneksi->query("update jenis_ikan set nama_ikan = '$jenis_ikan', deskripsi = '$deskripsi', harga = '$harga', foto = '$file_name' where id = '$id'");
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