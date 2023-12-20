<?php
    include 'koneksi.php';
    include 'head-base.php';

    $kodeMataKuliah = isset($_GET['kode_kelas']) ? $_GET['kode_kelas'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tambah Peserta - Database Ilmu</title>
    <link rel="stylesheet" href="style/page-base.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#"><strong>Database Ilmu</strong> - Tambah Peserta Kelas</a>
        </div>
    </nav>
    <div class="container form-container">
        <form id="addPesertaForm" method="POST" action="query-peserta.php">
            <div class="mb-3 row">
                <label for="npm" class="col-sm-2 col-form-label">NPM</label>
                <div class="col-sm-10">
                    <input required type="text" name="npm" class="form-control" id="npm" placeholder=' Contoh: 22081010180' oninvalid="this.setCustomValidity('Mohon isi NPM mahasiswa.')" oninput="this.setCustomValidity('')">
                </div>
            </div>
            <div class="mb-4 row">
                <label for="kode_kelas" class="col-sm-2 col-form-label">Kode Kelas</label>
                <div class="col-sm-10">
                    <input required type="text" name="kode_kelas" class="form-control" id="kode_kelas" value="<?php echo $kodeMataKuliah; ?>" readonly>
                </div>
            </div>
            <div class="btn-container text-end">
                <button type="submit" name="aksi" value="add" class="btn btn-success">Tambah Peserta</button>
                <a href="kelas.php" type="button" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</body>

</html>
