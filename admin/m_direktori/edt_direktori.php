<?php

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		$direktori = query("SELECT * FROM tb_direktori WHERE id_direktori='$id'")[0];
?>

<div class="page-header">
	<h3>UBAH DATA DIREKTORI</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_direktori">Direktori</a></li>
		<li class="active">Ubah Data Direktori</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-direktori">
		<input type="hidden" name="id_direktori_lama" id="id_direktori_lama" value="<?= $direktori['id_direktori']; ?>">
		<div class="form-group">
			<label for="id_direktori_baru" class="col-sm-2 control-label"><span>**</span> ID Direktori</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="id_direktori_baru" id="id_direktori_baru" value="<?= $direktori['id_direktori']; ?>" placeholder="Masukkan ID Direktori" required autofocus>
			</div>
			<div class="col-sm-3 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="nama_direktori" class="col-sm-2 control-label"><span>**</span> Nama Direktori</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="nama_direktori" id="nama_direktori" value="<?= $direktori['nama_direktori']; ?>" placeholder="Masukkan Nama Direktori" required>
			</div>
			<div class="col-sm-3 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="ubah-direktori" id="ubah-direktori"><i class="fa fa-edit"></i> Ubah</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_direktori.js"></script>

<?php
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_direktori';
			</script>
		";
	}
?>