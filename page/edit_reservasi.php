<?php
include "config/koneksi.php"
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Reservasi</h1>
            </div>
        </div>
    </div>
</div>

<?php
$Id = $_GET['Id'];
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM reservasi WHERE Id_reservasi='$Id'"));

if (isset($_POST['tambah'])) {
    $Id_tamu = $_POST['Id_tamu'];
    $Check_in = $_POST['Check_in'];
    $Check_out = $_POST['Check_out'];
    $Status = $_POST['Status'];

    $insert = mysqli_query($koneksi, "UPDATE reservasi SET Check_in='$Check_in', Check_out='$Check_out', Status='$Status' WHERE Id_reservasi='$Id'");
    if ($insert) {
        echo '<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Berhasil Di Simpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=reservasi">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                <h5><i class="icon fas fa-info"></i> Info</h5>
                <h4>Gagal Di Simpan</h4>
            </div>';
    }
}

?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="card-body p-2">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="Id_tamu">Id Tamu:</label>
                            <select class="form-control" disabled>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM tamu");
                                while ($data = mysqli_fetch_array($query)) {
                                    $selected = ($data['Id_tamu'] == $edit['Id_tamu']) ? 'selected' : '';
                                    echo "<option value='" . $data['Id_tamu'] . "' $selected>" . $data['Nama_tamu'] . "</option>";
                                }
                                ?>
                            </select>

                            <input type="hidden" name="Id_tamu" value="<?php echo $edit['Id_tamu']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="Check_in">Check In:</label>
                            <input type="time" name="Check_in" id="Check_in" value="<?= $edit['Check_in']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Check_out">Check Out:</label>
                            <input type="time" name="Check_out" id="Check_out" value="<?= $edit['Check_out']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Status">Status:</label>
                            <select class="form-control" name="Status" id="Status">
                                <option value="">-- Pilih Status --</option>
                                <option value="Pending" <?= ($edit['Status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
                                <option value="Confirmed" <?= ($edit['Status'] == 'Confirmed') ? 'selected' : '' ?>>Confirmed</option>
                                <option value="Checked_in" <?= ($edit['Status'] == 'Checked_in') ? 'selected' : '' ?>>Checked In</option>
                                <option value="Checked_out" <?= ($edit['Status'] == 'Checked_out') ? 'selected' : '' ?>>Checked Out</option>
                                <option value="Cancelled" <?= ($edit['Status'] == 'Cancelled') ? 'selected' : '' ?>>Cancelled</option>
                            </select>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="tambah" class="btn btn-primary" value="Simpan">
                            <a href="index.php?page=reservasi" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>