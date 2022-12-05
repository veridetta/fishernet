<?php
$page = 'pengguna';
include 'header.php';
include '../inc/koneksi.php';
include '../inc/function.php';

$id = $_GET["id"];
$hasil = $koneksi->query("SELECT * from pengguna where id='$id'");
if (!$hasil)
    die('Ada masalah query = ' . $koneksi->error);
$d = $hasil->fetch_assoc();
?>

<div class="konten">
    <div class="panel">
        <div class="card">
            <div class="card-header">
                <h2>Pengguna / <span style="text-decoration: underline;">Edit</span></h2>
                <!-- <a class="tombol-tambah" href="tes">Tambah Data <span class="las la-plus"></span></a> -->
            </div>
            <div class="card-body">
                <div class="isi">
                    <form method="POST" enctype='multipart/form-data'>
                        <table width=100% style="border-spacing: 10px;">
                            <?php edit('text', 'nama', $d["nama"], 3) ?>
                            <?php edit('text', 'username', $d["username"], 3) ?>
                            <?php edit('password', 'password', $d["password"], 3) ?>
                            <?php edit('file', 'foto', "/profil/" . $d["foto"], 0) ?>
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
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $directory = "../file-upload/profil/";

    if ($_FILES['foto']['name'] == null) {
        $file_name = $_POST['foto2'];
    } else {
        $file_name = $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $directory . $file_name);
    }

    $sql = $koneksi->query("update pengguna set nama = '$nama', username = '$username', password = '$password', foto = '$file_name' where id = '$id'");
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