<?php
    include 'head-base.php';
    include 'grafik-dashboard.php';

    $inputPage="Dashboard";

    function postAnnouncement($teksNotifikasi) {
        include 'koneksi.php'; 

        $escapedNotifikasi = mysqli_real_escape_string($conn, $teksNotifikasi);
        $query = "INSERT INTO notifikasi (umum, timestamp) VALUES ('$escapedNotifikasi', NOW())";

        if (mysqli_query($conn, $query)) {
            ;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["umum"])) {
        $teksNotifikasi = $_POST["umum"];
        postAnnouncement($teksNotifikasi);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard - Database Ilmu</title>
    <link rel="stylesheet" href="style/page-base.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* h4 {
            color: #28a745; 
        } */
        .custom-green-bg {
            background-color: #28a745; /* Warna hijau Bootstrap */
            color: #fff; /* Warna teks putih untuk kontras */
        }
        canvas {
            max-width: 100%;
            height: auto;
        }
        
        #chartContainer {
            max-width: 800px;
            margin: auto;
        }

        .quick-links .list-group-item.green-bg {
            background-color: #28a745;
            color: #fff;
        }

        .quick-links .list-group-item.green-bg:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <?php include 'body-navbar.php'; ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Pengumuman Terbaru</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <!-- Formulir pengumuman -->
                            <!-- Daftar pengumuman -->
                            <?php
                            include 'koneksi.php'; // Sesuaikan dengan file koneksi Anda

                            $query = "SELECT * FROM notifikasi ORDER BY timestamp DESC LIMIT 2";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<li class='list-group-item'>(" . $row['timestamp'] . ") - " . $row['umum'] . "</li>";
                            }
                            mysqli_close($conn);
                            ?>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <li class="list-group-item text-end">
                                    <input type="text" name="umum" placeholder="Teks pengumuman" required>
                                    <button type="submit">Post</button>
                                </li>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Kelas Saya</h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="nilai_mahasiswa.php?kode_kelas=SDTA081" class="list-group-item">Struktur Data A081</li>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="row mb-4 mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Menu Informasi</h4>
                    </div>
                    <div class="card-body d-flex justify-content">
                        <a href="index.php" class="list-group-item list-group-item-action green-bg">
                            <center><i class="fas fa-graduation-cap"></i> Daftar Mahasiswa Aktif</center>
                        </a>
                        <a href="mata_kuliah.php" class="list-group-item list-group-item-action">
                            <center><i class="fas fa-book"></i> Daftar Mata Kuliah</center>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Menu Perkuliahan</h4>
                    </div>
                    <div class="card-body d-flex justify-content">
                        <a href="kelas.php" class="list-group-item list-group-item-action">
                            <center><i class="fa-solid fa-chalkboard"></i> Ruang Kelas</center>
                        </a>
                        <a href="nilai_mahasiswa.php" class="list-group-item list-group-item-action">
                            <center><i class="fa-solid fa-scroll"></i> Input Nilai Perkuliahan</center>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card">
            <div class="card-header">
                <h4>Statistik Mahasiswa</h4>
                <div class="card-body text-center">
                    <p>Total mahasiswa aktif: <?= $dataMahasiswa['totalMahasiswa']; ?></p>
                    <!-- <p>Pria: <?= $dataMale['totalMale']; ?></p>
                    <p>Wanita: <?= $dataFemale['totalFemale']; ?></p> -->

                    <div id="chartContainer" class="row mt-4">
                        <div class="col-md-6">
                            <canvas id="genderPieChart" width="400px" height="500px"></canvas>
                        </div>
                        <div class="col-md-6">
                            <canvas id="majorPieChart" width="400px" height="500px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>       

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var totalMahasiswa = <?= $dataMahasiswa['totalMahasiswa']; ?>;
            var percentMale = <?= $dataMale['totalMale'] / $dataMahasiswa['totalMahasiswa'] * 100; ?>;
            var percentFemale = <?= $dataFemale['totalFemale'] / $dataMahasiswa['totalMahasiswa'] * 100; ?>;
            
            var genderCtx = document.getElementById('genderPieChart').getContext('2d');
            var genderData = {
                labels: ['Pria ' + percentMale.toFixed(2) + '%', 'Wanita ' + percentFemale.toFixed(2) + '%'],
                datasets: [{
                    data: [<?= $dataMale['totalMale']; ?>, <?= $dataFemale['totalFemale']; ?>],
                    backgroundColor: ['rgba(255, 205, 86, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                    borderColor: ['rgba(255, 205, 86, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            };

            var genderPieChart = new Chart(genderCtx, {
                type: 'pie',
                data: genderData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'right',
                    },
                },
            });

            var majorCtx = document.getElementById('majorPieChart').getContext('2d');
            var majorData = {
                labels: [
                    'Informatika ' + (<?= $dataInformatika['totalInformatika'] / $dataMahasiswa['totalMahasiswa'] * 100; ?>).toFixed(2) + '%',
                    'Sistem Informasi ' + (<?= $dataSistemInformasi['totalSistemInformasi'] / $dataMahasiswa['totalMahasiswa'] * 100; ?>).toFixed(2) + '%',
                    'Sains Data ' + (<?= $dataSainsData['totalSainsData'] / $dataMahasiswa['totalMahasiswa'] * 100; ?>).toFixed(2) + '%',
                    'Bisnis Digital ' + (<?= $dataBisnisDigital['totalBisnisDigital'] / $dataMahasiswa['totalMahasiswa'] * 100; ?>).toFixed(2) + '%'
                ],
                datasets: [{
                    data: [
                        <?= $dataInformatika['totalInformatika']; ?>,
                        <?= $dataSistemInformasi['totalSistemInformasi']; ?>,
                        <?= $dataSainsData['totalSainsData']; ?>,
                        <?= $dataBisnisDigital['totalBisnisDigital']; ?>
                    ],
                    backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 205, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 205, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            };

            var majorPieChart = new Chart(majorCtx, {
                type: 'pie',
                data: majorData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'right',
                    },
                },
            });
        });
    </script>
    
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>