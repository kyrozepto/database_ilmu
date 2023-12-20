<?php
	include 'koneksi.php';
	include 'head-base.php';
	$id_mahasiswa ='';
	$npm = '';
	$nama_mahasiswa = '';
	$gender = '';
	$tanggal_lahir = '';
	$alamat = '';

	if(isset($_GET['ubah'])){
		$id_mahasiswa = $_GET['ubah'];

		$query = "SELECT * FROM mahasiswa WHERE id_mahasiswa = '$id_mahasiswa';";
		$sql = mysqli_query($conn, $query);

		$result = mysqli_fetch_assoc($sql);
		$npm = $result['npm'];
		$nama_mahasiswa = $result['nama_mahasiswa'];
		$gender = $result['gender'];
		$tanggal_lahir = $result['tanggal_lahir'];
		$alamat = $result['alamat'];
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Tambah Data - Database Ilmu</title>
	<link rel="stylesheet" href="style/page-base.css">
    <style></style>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#"><strong>Database Ilmu</strong> - Tambah/Ubah Data</a>
        </div>
    </nav>
		<div class="container">
			<form method="POST" action="proses.php" enctype="multipart/form-data">
				<input type="hidden" value="<?php echo $id_mahasiswa; ?>" name="id_mahasiswa">
				<div class="mb-3 row">
	    		<label for="npm" class="col-sm-2 col-form-label">NPM</label>
	    		<div class="col-sm-10">
	      			<input required type="text" name="npm" class="form-control" id="npm" placeholder= ' Contoh: 22081010180' value="<?php echo $npm; ?>" oninvalid="this.setCustomValidity('Mohon isi NPM mahasiswa.')" oninput="this.setCustomValidity('')">
	    		</div>
	  		</div>

	 		<div class="mb-3 row">
	    		<label for="nama_mahasiswa" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
	    		<div class="col-sm-10">
	      			<input required type="text" name="nama_mahasiswa" class="form-control" placeholder= ' Contoh: Ardiansyah' value="<?php echo $nama_mahasiswa; ?>" oninvalid="this.setCustomValidity('Mohon isi nama mahasiswa.')" oninput="this.setCustomValidity('')">
	    		</div>
	  		</div>

	  		<div class="mb-3 row">
	    		<label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin</label>
	    		<div class="col-sm-10">
					<select required id="gender" name="gender" class="form-select">
					    <option <?php if($gender == 'Pria'){ echo "selected"; } ?> value="Pria">Pria</option>
					    <option <?php if($gender == 'Wanita'){ echo "selected"; } ?> value="Wanita">Wanita</option>
					</select>
	    		</div>
	    	</div>

	  		<div class="mb-3 row">
	    		<label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
	    		<div class="col-sm-10">
	      			<input required type="text" name="tanggal_lahir" class="form-control" placeholder= 'Contoh: 17-01-2002' value="<?php echo $tanggal_lahir; ?>" oninvalid="this.setCustomValidity('Mohon isi tanggal lahir mahasiswa')" oninput="this.setCustomValidity('')">
	    		</div>
	  		</div>

			<div class="mb-2 row">
	    		<label for="foto_mahasiswa" class="col-sm-2 col-form-label">Foto Mahasiswa</label>
	    		<div class="col-sm-10">
	      			<input <?php if(!isset($_GET['ubah'])){echo "required";} ?> class="form-control" type="file" name="foto_mahasiswa" id="foto_mahasiswa" accept="image/*" oninvalid="this.setCustomValidity('Tambahkan foto untuk mahasiswa.')" oninput="this.setCustomValidity('')">
	    		</div>
	    	</div>

			<div class="mb-3 row">
			  	<label for="alamat" class="col-sm-2 col-form-label">Alamat Lengkap</label>
			  	<textarea required class="form-control" id="alamat" name="alamat" rows="3" oninvalid="this.setCustomValidity('Mohon isi alamat mahasiswa.')" oninput="this.setCustomValidity('')"><?php echo $alamat; ?></textarea>
			</div>

			<div class="mb-3 row mt-4" style="text-align: right;">
				<div class="col">
					<?php
						if(isset($_GET['ubah'])){
					?>
					<button type="submit" name="aksi" value="edit" class="btn btn-success">Simpan Perubahan</button>
					<?php
						} else {
					?>
					<button type="submit" name="aksi" value="add" class="btn btn-success">Tambah Data</button>
					<?php
					}
				?>
				<a href="index.php" type="button" class="btn btn-danger">Batal</a>
			</div>
		</form>
  	</div>
</body>
</html>