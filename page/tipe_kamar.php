<?php
include "config/koneksi.php"
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Tipe Kamar</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $Id = $_GET['Id'];
        $query = mysqli_query($koneksi, "DELETE FROM tipe_kamar WHERE Id_tipe='$Id'");
        if ($query) {
            echo '
            <div class="alert alert-warning alert-dismissible">
                Berhasil Di Hapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=tipe_kamar">';
        }
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_tipe_kamar" class="btn btn-primary btn-sm">Tambah Tipe Kamar</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Id Tipe</th>
                            <th style="text-align: center;">Nama Tipe</th>
                            <th style="text-align: center;">Harga</th>
                            <th style="text-align: center;">Kapasitas</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM tipe_kamar");
                    while ($result = mysqli_fetch_array($query)) {
                        $no++;
                    ?>
                        <tbody>
                            <tr style="text-align: center;">
                                <td><?= $no; ?></td>
                                <td><?= $result['Id_tipe']; ?></td>
                                <td><?= $result['Nama_tipe']; ?></td>
                                <td><?= $result['Harga']; ?></td>
                                <td><?= $result['Kapasitas']; ?></td>
                                <td>
                                    <a href="index.php?page=tipe_kamar&action=hapus&Id=<?= $result['Id_tipe']; ?>" title ="">
                                            <span class=" badge badge-danger">Hapus</span></a>
                                    <a href="index.php?page=edit_tipe_kamar&Id=<?= $result['Id_tipe']; ?>" title="">
                                        <span class="badge badge-warning">Edit</span></a>
                                </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>