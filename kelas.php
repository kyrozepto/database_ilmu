<?php
    include 'head-base.php';
    include 'koneksi.php';
    session_start();

    $inputPage = "Daftar Kelas";
    $kodeMataKuliah = isset($_GET['kode']) ? $_GET['kode'] : null;
    $namaMataKuliah = '';

    if ($kodeMataKuliah == 'SDT081') {
        $namaMataKuliah = 'Struktur Data';
    } elseif ($kodeMataKuliah == 'BDL081') {
        $namaMataKuliah = 'Basis Data Lanjut';
    } // Tambahkan kondisi lain jika diperlukan

    if ($kodeMataKuliah) {
        $query = "SELECT * FROM kelas WHERE kode_matakuliah = '$kodeMataKuliah' ORDER BY jumlah_mahasiswa;";
    } else {
        $query = "SELECT * FROM kelas ORDER BY jumlah_mahasiswa;";
    }

    $sql = mysqli_query($conn, $query);
    $no = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar Kelas - Database Ilmu</title>
    <link rel="stylesheet" href="style/page-base.css">
    <style></style>
</head>

<body>
    <?php include 'body-navbar.php'; ?>

    <div class="container">
        <h2 class="mt-4 text-center"><strong>Kelas <?php echo $namaMataKuliah; ?></strong></h2>
        <figure>
            <blockquote class="blockquote text-center">
                <p>Daftar Kelas untuk perkuliahan Semester Gasal 2023</p>
            </blockquote>
        </figure>

        <div class="table-responsive">
            <table id="mataKuliahTable" class="table table-bordered table-striped mt-5">
                <thead>
                    <tr>
                        <th>Kode Kelas</th>
                        <th>Mata Kuliah</th>
                        <th>Ruangan</th>
                        <th>Jadwal</th>
                        <th>Dosen Pembimbing</th>
                        <th><center>Jumlah Peserta</center></th>
                        <th><center>Edit</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($result = mysqli_fetch_assoc($sql)) {
                    ?>
                        <tr>
                            <td><?php echo $result['kode_kelas']; ?></td>
                            <td><?php echo $result['nama_matakuliah']; ?></td>
                            <td><?php echo $result['ruangan']; ?></td>
                            <td><?php echo $result['jadwal']; ?></td>
                            <td><?php echo $result['dosen']; ?></td>
                            <td><center><?php echo $result['jumlah_mahasiswa']; ?></center></td>
                            <td><center>
                                    <a href="nilai_mahasiswa.php?kode_kelas=<?php echo $result['kode_kelas']; ?>" class="btn btn-success">
                                        <i class="fas fa-edit"></i></a>
                                    <a href="add-peserta.php?kode_kelas=<?php echo $result['kode_kelas']; ?>" class="btn btn-success">
                                        <i class="fa-solid fa-user-plus"></i></a>
                                </center>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mataKuliahTable').DataTable();
        });
    </script>
</body>

</html>
