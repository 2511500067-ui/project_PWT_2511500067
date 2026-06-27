<?php
include "config/koneksi.php"
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Tipe Kamar</h1>
            </div>
        </div>
    </div>
</div>

<?php
$Id = $_GET['Id'];
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tipe_kamar WHERE Id_tipe='$Id'"));

if (isset($_POST['tambah'])) {
    $Nama_tipe = $_POST['Nama_tipe'];
    $Harga = $_POST['Harga'];
    $Kapasitas = $_POST['Kapasitas'];

    $insert = mysqli_query($koneksi, "UPDATE tipe_kamar SET Nama_tipe='$Nama_tipe', Harga='$Harga', Kapasitas='$Kapasitas' WHERE Id_tipe='$Id'");
    if ($insert) {
        echo '<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Berhasil Di Simpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=tipe_kamar">';
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
                            <label for="Id_tipe">Id Tipe:</label>
                            <input type="text" class="form-control" value="<?php echo $edit['Id_tipe']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="Nama_tipe">Nama Tipe:</label>
                            <select name="Nama_tipe" id="Nama_tipe" class="form-control">
                                <option value="">Pilih Tipe Kamar</option>
                                <option value="Single" <?= ($edit['Nama_tipe'] == 'Single') ? 'selected' : '' ?>>Single</option>
                                <option value="Double" <?= ($edit['Nama_tipe'] == 'Double') ? 'selected' : '' ?>>Double</option>
                                <option value="Triple" <?= ($edit['Nama_tipe'] == 'Triple') ? 'selected' : '' ?>>Triple</option>
                                <option value="Family" <?= ($edit['Nama_tipe'] == 'Family') ? 'selected' : '' ?>>Family</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Harga">Harga:</label>
                            <select name="Harga" id="Harga" class="form-control">
                                <option value="">Pilih Harga</option>
                                <option value="100000" <?= ($edit['Harga'] == '100000') ? 'selected' : '' ?>>S 100.000</option>
                                <option value="200000" <?= ($edit['Harga'] == '200000') ? 'selected' : '' ?>>D 200.000</option>
                                <option value="300000" <?= ($edit['Harga'] == '300000') ? 'selected' : '' ?>>T 300.000</option>
                                <option value="400000" <?= ($edit['Harga'] == '400000') ? 'selected' : '' ?>>F 400.000</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Kapasitas">Kapasitas:</label>
                            <select name="Kapasitas" id="Kapasitas" class="form-control">
                                <option value="">Pilih Kapasitas</option>
                                <option value="1" <?= ($edit['Kapasitas'] == '1') ? 'selected' : '' ?>>1</option>
                                <option value="2" <?= ($edit['Kapasitas'] == '2') ? 'selected' : '' ?>>2</option>
                                <option value="3" <?= ($edit['Kapasitas'] == '3') ? 'selected' : '' ?>>3</option>
                                <option value="4" <?= ($edit['Kapasitas'] == '4') ? 'selected' : '' ?>>4</option>
                            </select>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="tambah" class="btn btn-primary" value="Simpan">
                            <a href="index.php?page=tipe_kamar" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>