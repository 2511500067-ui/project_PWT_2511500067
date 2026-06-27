<?php
include "config/koneksi.php"
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Kamar</h1>
            </div>
        </div>
    </div>
</div>

    <?php
    $Id = $_GET['Id'];
    $edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kamar WHERE Id_kamar='$Id'"));

    if(isset($_POST['tambah'])){
        $Nomor_kamar = $_POST['Nomor_kamar'];
        $Status_kamar = $_POST['Status_kamar'];

        $insert = mysqli_query($koneksi, "UPDATE kamar SET Nomor_kamar='$Nomor_kamar', Status_kamar='$Status_kamar' WHERE Id_kamar='$Id'");
        if ($insert) {
            echo '<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Berhasil Di Simpan</h4></div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=kamar">';
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
                            <label for="Id_kamar">Id Kamar:</label>
                            <input type="text" name="Id_kamar" value="<?= $edit['Id_kamar']; ?>" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="Nomor_kamar">Nomor Kamar:</label>
                            <select type="text" name="Nomor_kamar" id="Nomor_kamar" value="<?= $edit['Nomor_kamar']; ?>" placeholder="Masukkan Nomor Kamar" class="form-control">
                                <option value="">Pilih Nomor Kamar</option>
                                <option value="101" <?= ($edit['Nomor_kamar'] == '101') ? 'selected' : '' ?>>101</option>
                                <option value="102" <?= ($edit['Nomor_kamar'] == '102') ? 'selected' : '' ?>>102</option>
                                <option value="103" <?= ($edit['Nomor_kamar'] == '103') ? 'selected' : '' ?>>103</option>
                                <!-- Tambahkan opsi nomor kamar lainnya sesuai kebutuhan -->    
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Id_tipe">Id Tipe:</label>
                            <select class="form-control" disabled>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM tipe_kamar");
                                while ($data = mysqli_fetch_array($query)) {
                                    $selected = ($data['Id_tipe'] == $edit['Id_tipe']) ? 'selected' : '';
                                    echo "<option value='" . $data['Id_tipe'] . "' $selected>" . $data['Id_tipe'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Status_kamar">Status Kamar:</label>
                            <select class="form-control" name="Status_kamar" id="Status_kamar">
                                <option value="">-- Pilih Status --</option>
                                <option value="Available" <?= ($edit['Status_kamar'] == 'Available') ? 'selected' : '' ?>>Available</option>
                                <option value="Occupied" <?= ($edit['Status_kamar'] == 'Occupied') ? 'selected' : '' ?>>Occupied</option>
                                <option value="Reserved" <?= ($edit['Status_kamar'] == 'Reserved') ? 'selected' : '' ?>>Reserved</option>
                                <option value="Cleaning" <?= ($edit['Status_kamar'] == 'Cleaning') ? 'selected' : '' ?>>Cleaning</option>
                                <option value="Maintenance" <?= ($edit['Status_kamar'] == 'Maintenance') ? 'selected' : '' ?>>Maintenance</option>
                            </select>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="tambah" class="btn btn-primary" value="Simpan">
                            <a href="index.php?page=kamar" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>