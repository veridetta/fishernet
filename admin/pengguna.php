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
                <h2>Pengguna</h2>
                <a class="tombol-tambah" href="pengguna_tambah.php">Tambah Data <span class="las la-plus"></span></a>
            </div>
            <div class="card-body">
                <div class="isi">

                    <table width="100%" class="table-data table-responsive">
                        <thead>
                            <tr>
                                <td width="5%">No</td>
                                <td width="20%">Foto</td>
                                <td width="20%">Nama</td>
                                <td width="20%">Username</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = $koneksi->query("SELECT * from pengguna");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?php
                                        if ($data['foto'] == !null) {
                                        ?>
                                            <a href="../file-upload/profil/<?= $data['foto'] ?>">
                                                <img src="../file-upload/profil/<?= $data['foto'] ?>" alt="foto" width="100px">
                                            </a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="../file-upload/profil/no_image.png">
                                                <img src="../file-upload/profil/no_image.png" alt="" width="100px">
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </td>

                                    <td><?= $data['nama'] ?></td>
                                    <td><?= $data['username'] ?></td>
                                    <td>
                                        <a href="pengguna_edit.php?id=<?= $data['id'] ?>" class="tombol-edit">Edit</span></a>
                                        <a href="pengguna_hapus.php?id=<?= $data['id'] ?>" class="tombol-hapus">Hapus</span></a>
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

<?php include 'footer.php'; ?>