<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand" href="dashboard.php"><i class="fa-solid fa-graduation-cap"></i><strong> Database Ilmu</strong> - <?php echo $inputPage; ?></a>             
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle ms-3" id="mahasiswaDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Informasi</a>
                <div class="dropdown-menu" aria-labelledby="mahasiswaDropdown">
                    <a class="dropdown-item" href="index.php">Mahasiswa</a>
                    <a class="dropdown-item" href="mata_kuliah.php">Mata Kuliah</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle ms-1" id="mahasiswaDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Perkuliahan</a>
                <div class="dropdown-menu" aria-labelledby="mahasiswaDropdown">
                    <a class="dropdown-item" href="kelas.php">Kelas</a>
                    <a class="dropdown-item" href="nilai_mahasiswa.php">Nilai</a>
                </div>
            </li>
            <li class="nav-item">
                <a href="landing.php" class="btn btn-outline-light ms-3">
                    Keluar <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>