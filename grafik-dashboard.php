<?php
include 'koneksi.php';

$queryMahasiswa = "SELECT COUNT(*) as totalMahasiswa FROM mahasiswa";
$resultMahasiswa = mysqli_query($conn, $queryMahasiswa);
$dataMahasiswa = mysqli_fetch_assoc($resultMahasiswa);

$queryMale = "SELECT COUNT(*) as totalMale FROM mahasiswa WHERE gender = 'Pria'";
$resultMale = mysqli_query($conn, $queryMale);
$dataMale = mysqli_fetch_assoc($resultMale);

$queryFemale = "SELECT COUNT(*) as totalFemale FROM mahasiswa WHERE gender = 'Wanita'";
$resultFemale = mysqli_query($conn, $queryFemale);
$dataFemale = mysqli_fetch_assoc($resultFemale);

$queryInformatika = "SELECT COUNT(*) as totalInformatika FROM mahasiswa WHERE jurusan = '081'";
$resultInformatika = mysqli_query($conn, $queryInformatika);
$dataInformatika = mysqli_fetch_assoc($resultInformatika);

$querySistemInformasi = "SELECT COUNT(*) as totalSistemInformasi FROM mahasiswa WHERE jurusan = '082'";
$resultSistemInformasi = mysqli_query($conn, $querySistemInformasi);
$dataSistemInformasi = mysqli_fetch_assoc($resultSistemInformasi);

$querySainsData = "SELECT COUNT(*) as totalSainsData FROM mahasiswa WHERE jurusan = '083'";
$resultSainsData = mysqli_query($conn, $querySainsData);
$dataSainsData = mysqli_fetch_assoc($resultSainsData);

$queryBisnisDigital = "SELECT COUNT(*) as totalBisnisDigital FROM mahasiswa WHERE jurusan = '084'";
$resultBisnisDigital = mysqli_query($conn, $queryBisnisDigital);
$dataBisnisDigital = mysqli_fetch_assoc($resultBisnisDigital);
?>
