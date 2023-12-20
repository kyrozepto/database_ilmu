<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $npm = $_POST['npm'];
    $kode_kelas = $_POST['kode_kelas'];

    
    if (updateKodeKelas($npm, $kode_kelas, $conn)) {
        
        updateJumlahMahasiswa($kode_kelas, $conn);

        
        header("Location: nilai_mahasiswa.php?kode_kelas=" . urlencode($kode_kelas));
        exit(); 
    } else {
        echo "Gagal mengupdate Kode Kelas.";
    }
}

function updateKodeKelas($npm, $kode_kelas, $conn) {
    
    $query = "UPDATE nilai_mahasiswa SET kode_kelas=? WHERE npm=?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $kode_kelas, $npm);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            mysqli_stmt_close($stmt);
            return true;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    } else {
        return false;
    }
}

function updateJumlahMahasiswa($kode_kelas, $conn) {
    
    $queryCount = "SELECT COUNT(*) AS total FROM nilai_mahasiswa WHERE kode_kelas=?";
    $stmtCount = mysqli_prepare($conn, $queryCount);

    if ($stmtCount) {
        mysqli_stmt_bind_param($stmtCount, 's', $kode_kelas);
        mysqli_stmt_execute($stmtCount);
        mysqli_stmt_bind_result($stmtCount, $total);
        mysqli_stmt_fetch($stmtCount);
        mysqli_stmt_close($stmtCount);

        
        $queryUpdateJumlah = "UPDATE kelas SET jumlah_mahasiswa=? WHERE kode_kelas=?";
        $stmtUpdateJumlah = mysqli_prepare($conn, $queryUpdateJumlah);

        if ($stmtUpdateJumlah) {
            mysqli_stmt_bind_param($stmtUpdateJumlah, 'ss', $total, $kode_kelas);
            mysqli_stmt_execute($stmtUpdateJumlah);
            mysqli_stmt_close($stmtUpdateJumlah);
        }
    }
}
?>
