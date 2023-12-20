<?php
include 'koneksi.php';

function buildQuery($filters) {
    $query = "SELECT * FROM mahasiswa WHERE 1";

    if (!empty($filters['gender'])) {
        $query .= " AND gender = '{$filters['gender']}'";
    }

    if (!empty($filters['alamat'])) {
        $query .= " AND SUBSTRING_INDEX(alamat, ' ', -1) = '{$filters['alamat']}'";
    }

    if (!empty($filters['jurusan'])) {
        $query .= " AND jurusan = '{$filters['jurusan']}'";
    }

    if (!empty($filters['angkatan'])) {
        $query .= " AND SUBSTRING(npm, 1, 2) = '{$filters['angkatan']}'";
    }

    $query .= " ORDER BY npm;";

    return $query;
}

function executeQuery($query) {
    global $conn;
    return mysqli_query($conn, $query);
}
?>
