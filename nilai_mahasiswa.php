<?php
    include 'head-base.php';
    include 'query-nilai.php';
    session_start();

    $inputPage = "Nilai Mahasiswa";
    $kodeMataKuliah = isset($_GET['kode_kelas']) ? $_GET['kode_kelas'] : '';

    $filters = array(
        'tugas' => isset($_GET['tugas']) ? $_GET['tugas'] : '',
        'uts' => isset($_GET['uts']) ? $_GET['uts'] : '',
        'uas' => isset($_GET['uas']) ? $_GET['uas'] : '',
        'tugas_akhir' => isset($_GET['tugas_akhir']) ? $_GET['tugas_akhir'] : '',
        'ipk' => isset($_GET['ipk']) ? $_GET['ipk'] : '',
        'predikat' => isset($_GET['predikat']) ? $_GET['predikat'] : '',
        'above_average' => isset($_GET['above_average']) ? $_GET['above_average'] : '',
        'below_average' => isset($_GET['below_average']) ? $_GET['below_average'] : '',
    );

    $query = buildQuery($filters, $kodeMataKuliah);
    $sql = executeQuery($query);

    $no = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Nilai Mahasiswa - Database Ilmu</title>
    <link rel="stylesheet" href="style/page-base.css">
    <style></style>
</head>

<body>
    <?php include 'body-navbar.php'; ?>

    <div class="container">
        <h2 class="mt-4 text-center"><strong>Nilai Mahasiswa</strong></h2>
        <figure>
            <blockquote class="blockquote text-center">
                <p>Data Nilai Mahasiswa <?php echo $kodeMataKuliah; ?></p>
            </blockquote>
        </figure>

        <div class="d-flex justify-content-end mb-2">
            <a href="index.php" class="btn btn-outline-primary mb-0">
                <i class="fas fa-arrow-left"></i> Kembali ke Informasi Mahasiswa
            </a>
        </div>

        <div class="d-flex justify-content-end mb-2">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterModal"
                <?php echo (!empty($filters['tugas']) || !empty($filters['uts']) || !empty($filters['uas']) || !empty($filters['tugas_akhir']) || !empty($fitlers['ipk']) || !empty($filters['predikat']) || !empty($filters['above_average']) || !empty($filters['below_average'])) ? 'data-filter-active="true"' : ''; ?>>
                Filter <i class="fas fa-filter"></i>
            </button>
        </div>

        <?php include 'filter-nilai.php'; ?>
        
        <?php
        if (isset($_SESSION['eksekusi'])) :
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>
                <?php
                echo $_SESSION['eksekusi'];
                ?>
            </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        session_destroy();
        endif;
        ?>

        <div class="table-responsive">
            <table id="dt" class="table align-middle cell-border hover">
                <thead>
                    <tr>
                        <th><center>No.</center></th>
                        <th><center>NPM</center></th>
                        <th>Nama</th>
                        <th>Tugas</th>
                        <th>UTS</th>
                        <th>UAS</th>
                        <th>Praktikum</th>
                        <th>Nilai Akhir</th>
                        <th>Predikat</th>
                        <th><center>Edit</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($result = mysqli_fetch_assoc($sql)) {
                    ?>
                        <tr>
                            <td><center><?php echo ++$no; ?>.</center></td>
                            <td><center><?php echo $result['npm']; ?></center></td>
                            <td><?php echo $result['nama_mahasiswa']; ?></td>
                            <td><?php echo $result['tugas']; ?></td>
                            <td><?php echo $result['uts']; ?></td>
                            <td><?php echo $result['uas']; ?></td>
                            <td><?php echo $result['tugas_akhir']; ?></td>
                            <td><?php echo $result['ipk']; ?></td>
                            <td><?php echo $result['predikat']; ?></td>
                            <td><center>
                                    <a href="edit-nilai.php?ubah=<?php echo $result['id_nilai']; ?>" type="button" class="btn btn-success">
                                        <i class="fas fa-edit"></i>
                                    </a>
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
    
    <script>
        function resetFilter() {
            document.getElementById('tugasFilter').value = '';
            document.getElementById('utsFilter').value = '';
            document.getElementById('uasFilter').value = '';
            document.getElementById('tugasAkhirFilter').value = '';
            document.getElementById('ipkFilter').value = '';
            document.getElementById('predikatFilter').value = '';
            document.getElementById('aboveAverageFilter').checked = false;
            document.getElementById('belowAverageFilter').checked = false;
        }
    </script>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="datatables/datatables.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#dt').DataTable({
                "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]],
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ mahasiswa",
                    "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                    "search": "Cari NPM/Nama:"
                },
                "columnDefs": [{ "searchable": false, "targets": [0, 3, 4, 5, 6, 7, 8] }]
            });
        });
    </script>
</body>

</html>
