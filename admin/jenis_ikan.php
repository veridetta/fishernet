<?php
$page = 'jenis_ikan';
include 'header.php';
include '../inc/koneksi.php';
include '../inc/function.php';
?>

<div class="konten">
    <div class="panel">
        <div class="card">
            <div class="card-header">
                <h2>Jenis Ikan</h2>
                <a class="tombol-tambah" href="jenis_ikan_tambah.php">Tambah Data <span class="las la-plus"></span></a>
            </div>
            <div class="card-body">
                <div class="isi">


                    <table width="100%" class="table-data table-responsive">
                        <thead>
                            <tr>
                                <td width="5%">No</td>
                                <td width="10%">Jenis Ikan</td>
                                <td width="12%">Harga</td>
                                <td width="40%">Deskripsi</td>
                                <td width="15%">Foto</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = $koneksi->query("SELECT * from jenis_ikan");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['nama_ikan'] ?></td>
                                    <td><?= rupiah($data['harga']) ?></td>
                                    <td style="text-align: justify;"><?= $data['deskripsi'] ?></td>
                                    <td>
                                        <a href="../file-upload/<?= $data['foto'] ?>">
                                            <img src="../file-upload/<?= $data['foto'] ?>" alt="" width="100px">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="jenis_ikan_edit.php?id=<?= $data['id'] ?>" class="tombol-edit">Edit</span></a>
                                        <a href="jenis_ikan_hapus.php?id=<?= $data['id'] ?>" class="tombol-hapus">Hapus</span></a>
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