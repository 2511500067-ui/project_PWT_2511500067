<?php
include "config/koneksi.php"
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Kamar</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $Id = $_GET['Id'];
        $query = mysqli_query($koneksi, "DELETE FROM kamar WHERE Id_kamar='$Id'");
        if ($query) {
            echo '
            <div class="alert alert-warning alert-dismissible">
                Berhasil Di Hapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=kamar">';
        }
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_kamar" class="btn btn-primary btn-sm">Tambah Kamar</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Id Kamar</th>
                            <th style="text-align: center;">Nomor Kamar</th>
                            <th style="text-align: center;">Id Tipe</th>
                            <th style="text-align: center;">Status kamar</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM kamar");
                    while ($result = mysqli_fetch_array($query)) {
                        $no++;
                    ?>
                        <tbody>
                            <tr style="text-align: center;">
                                <td><?= $no; ?></td>
                                <td><?= $result['Id_kamar']; ?></td>
                                <td><?= $result['Nomor_kamar']; ?></td>
                                <td><?= $result['Id_tipe']; ?></td>
                                <td><?= $result['Status_kamar']; ?></td>
                                <td>
                                    <a href="index.php?page=kamar&action=hapus&Id=<?= $result['Id_kamar']; ?>" title ="">
                                            <span class=" badge badge-danger">Hapus</span></a>
                                    <a href="index.php?page=edit_kamar&Id=<?= $result['Id_kamar']; ?>" title="">
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