<?php
include 'koneksi.php';

function buildQuery($filters, $kodeMataKuliah) {
    $query = "SELECT * FROM nilai_mahasiswa WHERE 1";

    if (!empty($filters['tugas'])) {
        $query .= " AND tugas >= '{$filters['tugas']}'";
    }

    if (!empty($filters['uts'])) {
        $query .= " AND uts >= '{$filters['uts']}'";
    }

    if (!empty($filters['uas'])) {
        $query .= " AND uas >= '{$filters['uas']}'";
    }

    if (!empty($filters['tugas_akhir'])) {
        $query .= " AND tugas_akhir >= '{$filters['tugas_akhir']}'";
    }

    if (!empty($filters['ipk'])) {
        $query .= " AND ipk >= '{$filters['ipk']}'";
    }

    if (!empty($filters['predikat'])) {
        $query .= " AND predikat = '{$filters['predikat']}'";
    }

    if (!empty($filters['above_average'])) {
        $query .= " AND ipk > (SELECT AVG(ipk) FROM nilai_mahasiswa)";
    }

    if (!empty($filters['below_average'])) {
        $query .= " AND ipk < (SELECT AVG(ipk) FROM nilai_mahasiswa)";
    }

    if (!empty($kodeMataKuliah)) {
        $query .= " AND kode_kelas = '$kodeMataKuliah'";
    }

    $query .= " ORDER BY npm;";

    return $query;
}

function executeQuery($query) {
    global $conn;
    return mysqli_query($conn, $query);
}

?>