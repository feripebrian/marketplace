<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	// CEK APAKAH $_GET['kd'] ADA
	if( empty($_GET['kd']) ) {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='http://localhost/kemenagjaksel/admin/?page=m_jabatan';
			</script>
		";
	} else {
		$kode = mysqli_real_escape_string($conn, $_GET['kd']);

		$jabatan = query("SELECT * FROM tb_jabatan WHERE kd_jabatan='$kode'")[0];
?>

<div class="page-header">
	<h3>UBAH DATA JABATAN</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_jabatan">Jabatan</a></li>
		<li class="active">Ubah Data Jabatan</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-jabatan">
		<input type="hidden" name="kd_jabatan" id="kd_jabatan" value="<?= $jabatan['kd_jabatan']; ?>">

		<div class="form-group">
			<label for="nama_jabatan" class="col-sm-2 control-label"><span>**</span> Nama Jabatan</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" value="<?= $jabatan['nama_jabatan']; ?>" placeholder="Masukkan Nama Jabatan" required autofocus>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="ubah-jabatan" id="ubah-jabatan"><i class="fa fa-edit"></i> Ubah</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_jabatan.js"></script>

<?php
	} // Tutup if else
?>