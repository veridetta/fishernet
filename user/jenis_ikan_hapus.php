<?php
include '../inc/koneksi.php';
$hasil = $koneksi->query("DELETE FROM jenis_ikan WHERE id='$_GET[id]'");
if (!$hasil)
    die('Ada masalah Query ' . $db->error);
else {

?>
    <script type="text/javascript">
        alert("Data Berhasil Dihapus");
        window.location.href = "jenis_ikan.php";
    </script>
<?php

}
?>