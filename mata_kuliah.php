<?php
    include 'head-base.php';
    include 'koneksi.php';
    session_start();

    $inputPage = "Daftar Mata Kuliah";
    $query = "SELECT * FROM mata_kuliah ORDER BY kode_matakuliah;";

    $sql = mysqli_query($conn, $query);
    $no = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar Mata Kuliah - Database Ilmu</title>
    <link rel="stylesheet" href="style/page-base.css">
    <style></style>
</head>

<body>
    <?php include 'body-navbar.php'; ?>
    
    <div class="container">
        <h2 class="mt-4 text-center"><strong>Mata Kuliah</strong></h2>
        <figure>
            <blockquote class="blockquote text-center">
                <p>Daftar Mata Kuliah Semester Gasal 2023</p>
            </blockquote>
        </figure>

        <div class="table-responsive">
            <table id="mataKuliahTable" class="table table-bordered table-striped mt-5">
                <thead>
                    <tr>
                        <th>Kode Mata Kuliah</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Program Studi</th>
                        <th><center>Kelas</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($result = mysqli_fetch_assoc($sql)) {
                    ?>
                        <tr>
                            <td><?php echo $result['kode_matakuliah']; ?></td>
                            <td><?php echo $result['nama_matakuliah']; ?></td>
                            <td><?php echo $result['sks']; ?></td>
                            <td><?php echo $result['semester']; ?></td>
                            <td><?php echo $result['jurusan']; ?></td>
                            <td><center>
                                <a href="kelas.php?kode=<?php echo $result['kode_matakuliah']; ?>" class="btn btn-sm btn-success">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
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

<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<!-- Custom Script -->
    <script>
        $(document).ready(function() {
            $('#mataKuliahTable').DataTable();
        });
    </script>
</body>
</html>
