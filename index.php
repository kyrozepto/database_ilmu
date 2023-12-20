<?php
    include 'head-base.php';
    include 'query-mahasiswa.php';
    include 'koneksi.php';
    session_start();

    $inputPage = "Informasi Mahasiswa";

    function getFilterOptions() {
        $queryKota = "SELECT nama_kota FROM filter_kota";
        $resultKota = mysqli_query($GLOBALS['conn'], $queryKota);

        $queryAngkatan = "SELECT DISTINCT SUBSTRING(npm, 1, 2) AS angkatan FROM mahasiswa";
        $resultAngkatan = mysqli_query($GLOBALS['conn'], $queryAngkatan);

        $options = [];

        while ($rowKota = mysqli_fetch_assoc($resultKota)) {
            $options['kota'][] = $rowKota['nama_kota'];
        }

        while ($rowAngkatan = mysqli_fetch_assoc($resultAngkatan)) {
            $options['angkatan'][] = $rowAngkatan['angkatan'];
        }
        return $options;
    }

    $filters = array(
        'gender' => isset($_GET['gender']) ? $_GET['gender'] : '',
        'alamat' => isset($_GET['alamat']) ? $_GET['alamat'] : '',
        'jurusan' => isset($_GET['jurusan']) ? $_GET['jurusan'] : '',
        'angkatan' => isset($_GET['angkatan']) ? $_GET['angkatan'] : ''
    );

    $query = buildQuery($filters);
    $sql = executeQuery($query);

    $no = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Informasi Mahasiswa - Database Ilmu</title>
    <link rel="stylesheet" href="style/page-base.css">
    <style></style>
</head>

<body>
    <?php include 'body-navbar.php'; ?>

    <div class="container">
        <h2 class="mt-4 text-center"><strong>Informasi Mahasiswa</strong></h2>
        <figure>
            <blockquote class="blockquote text-center">
                <p>Data Mahasiswa Aktif 2023</p>
            </blockquote>
        </figure>
        <div class="d-flex justify-content-end mb-2"> <!-- Use Bootstrap's flex utilities to align to the right -->
            <a href="nilai_mahasiswa.php" type="button" class="btn btn-outline-primary">
                Lihat Nilai Mahasiswa <i class="fas fa-arrow-right"></i>
            </a>
        </div>
            
        <div class="d-flex justify-content-end mb-2"> <!-- Use Bootstrap's flex utilities to align to the right -->
            <a href="add-mahasiswa.php" type="button" class="btn btn-outline-success ms-2">
                Tambah Data
            </a>
            <button type="button" class="btn btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#filterModal"
                <?php echo (!empty($filters['gender']) || !empty($filters['kota']) || !empty($filters['jurusan']) || !empty($filters['angkatan'])) ? 'data-filter-active="true"' : ''; ?>>
                Filter <i class="fas fa-filter"></i>
            </button>
        </div>

        <?php include 'filter-mahasiswa.php'; ?>

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
                        <th><center>Foto Profil</center></th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th><center>Tanggal Lahir</center></th>
                        <th>Alamat</th>
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
                            <td><center><img src="img/<?php echo $result['foto_mahasiswa']; ?>" style="width: 40px"></center></td>
                            <td><?php echo $result['nama_mahasiswa']; ?></td>
                            <td><?php echo $result['gender']; ?></td>
                            <td><center><?php echo $result['tanggal_lahir']; ?></center></td>
                            <td><?php echo $result['alamat']; ?></td>
                            <td>
                                <center>
                                    <a href="add-mahasiswa.php?ubah=<?php echo $result['id_mahasiswa']; ?>" type="button" class="btn btn-success">
                                        <i class="fa-solid fa-file-pen"></i></a>
                                    <a href="proses.php?hapus=<?php echo $result['id_mahasiswa']; ?>" type="button" class="btn btn-danger" onClick="return confirm('Apakah anda ingin menghapus data yang dipilih?')">
                                        <i class="fa-solid fa-user-minus"></i></a>
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
            document.getElementById('jurusanFilter').value = '';
            document.getElementById('genderFilter').value = '';
            document.getElementById('kotaFilter').value = '';
            document.getElementById('angkatanFilter').value = '';
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
                    "search": "Cari NPM/Nama:",
                },
                "columnDefs": [{ "searchable": false, "targets": [0, 4, 5, 6, 7] }]
            });
        });
    </script>

</body>

</html>
