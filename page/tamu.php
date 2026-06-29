
<?php
include "config/koneksi.php";
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Tamu</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd = $_GET['kd'];
        $query = mysqli_query($koneksi, "DELETE FROM tamu WHERE Id_tamu='$kd'");
        if ($query) {
            echo '
            <div class="alert alert-warning alert-dismissible">
                Berhasil Di Hapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=tamu">';
        }
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_tamu" class="btn btn-primary btn-sm">Tambah Tamu</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Id Tamu</th>
                            <th style="text-align: center;">Nama Tamu</th>
                            <th style="text-align: center;">Nomor Telepon</th>
                            <th style="text-align: center;">Email</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM tamu");
                    while ($result = mysqli_fetch_array($query)) {
                        $no++;
                    ?>
                        <tbody>
                            <tr style="text-align: center;">
                                <td><?= $no; ?></td>
                                <td><?= $result['Id_tamu']; ?></td>
                                <td><?= $result['Nama_tamu']; ?></td>
                                <td><?= $result['No_hp']; ?></td>
                                <td><?= $result['Email']; ?></td>
                                <td>
                                    <a href="index.php?page=tamu&action=hapus&kd=<?= $result['Id_tamu']; ?>">
                                        <span class="badge badge-danger">Hapus</span>
                                    </a>
                                    <a href="index.php?page=edit_tamu&kd=<?= $result['Id_tamu']; ?>" title="">
                                        <span class="badge badge-warning">Edit</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>