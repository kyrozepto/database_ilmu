<?php
    include 'koneksi.php';
    include 'head-base.php';

    $id_nilai ='';
    $npm = '';
    $nama_mahasiswa = '';
    $tugas = '';
    $uts = '';
    $uas = '';
    $tugas_akhir = '';

    if(isset($_GET['ubah'])){
        $id_nilai = $_GET['ubah'];

        $query = "SELECT * FROM nilai_mahasiswa WHERE id_nilai = '$id_nilai';";
        $sql = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($sql);

        $npm = $result['npm'];
        $nama_mahasiswa = $result['nama_mahasiswa'];
        $tugas = $result['tugas'];
        $uts = $result['uts'];
        $uas = $result['uas'];
        $tugas_akhir = $result['tugas_akhir'];
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ubah Nilai - Database Ilmu</title>
    <link rel="stylesheet" href="style/page-base.css">
    <style></style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand"><strong>Database Ilmu</strong> - Ubah Nilai</a>
        </div>
    </nav>
    
    <div class="container">

    <form method="POST" action="fungsi-nilaiedit.php">
        <input type="hidden" value="<?php echo $result['id_nilai']; ?>" name="id_nilai">

        <div class="mb-3 row">
            <label for="npm" class="col-sm-2 col-form-label">NPM</label>
            <div class="col-sm-10">
                <input required type="text" name="npm" class="form-control" id="npm" value="<?php echo $npm; ?>" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nama_mahasiswa" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input required type="text" name="nama_mahasiswa" class="form-control" id="nama_mahasiswa" value="<?php echo $nama_mahasiswa; ?>" readonly>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tugas" class="col-sm-2 col-form-label">Nilai Tugas</label>
            <div class="col-sm-10">
                <input required type="text" name="tugas" class="form-control" id="tugas" value="<?php echo $result['tugas']; ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="uts" class="col-sm-2 col-form-label">Nilai UTS</label>
            <div class="col-sm-10">
                <input required type="text" name="uts" class="form-control" id="uts" value="<?php echo $result['uts']; ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="uas" class="col-sm-2 col-form-label">Nilai UAS</label>
            <div class="col-sm-10">
                <input required type="text" name="uas" class="form-control" id="uas" value="<?php echo $result['uas']; ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tugas_akhir" class="col-sm-2 col-form-label">Nilai Praktikum</label>
            <div class="col-sm-10">
                <input required type="text" name="tugas_akhir" class="form-control" id="tugas_akhir" value="<?php echo $result['tugas_akhir']; ?>">
            </div>
        </div>

        <div class="mb-3 row mt-4" style="text-align: right;">
            <div class="col">
                <button type="submit" name="aksi" value="edit" class="btn btn-success">Simpan Perubahan</button>
                <a href="nilai_mahasiswa.php" type="button" class="btn btn-danger">Batal</a>
            </div>
        </div>
    </form>
    </div>
</body>

</html>
