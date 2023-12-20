<?php
include 'head-base.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Database Ilmu</title>
    <link rel="stylesheet" href="style/page-landing.css">
    <style></style>
</head>

<body>
    <div>
        <h1><strong>Database_Ilmu</strong></h1>
        <p id="dynamicText">Temukan informasi mahasiswa dengan mudah.</p>
        <a href="dashboard.php" class="btn btn-success">Masuk ke website <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var dynamicText = document.getElementById('dynamicText');
            var phrases = [
                '<i class="fa-solid fa-magnifying-glass"></i> Cari data mahasiswa aktif 2023.',
                'Ubah informasi pada mahasiswa.',
                '<i class="fa-solid fa-check"></i> Input nilai perkuliahan mahasiswa.',
                'Filter berdasarkan atribut mahasiswa.',
            ];

            var index = 0;

            function changeText() {
                dynamicText.style.opacity = 0;
                setTimeout(function () {
                    dynamicText.innerHTML = phrases[index];
                    dynamicText.style.opacity = 1;
                    index = (index + 1) % phrases.length;
                }, 400); // Waktu transisi setelah opacity menjadi 
            }

            setInterval(changeText, 2700);

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('.info-icon'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>

</html>
