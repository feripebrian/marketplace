<?php

	require 'funct_media_gallery.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		$medgall_foto = query("SELECT * FROM tb_media_gallery WHERE id_medgall=$id AND kategori_medgall='FOTO'")[0];
?>

<div class="page-header">
	<h3>UBAH DATA MEDIA GALLERY FOTO</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_medgall_foto">Media Gallery Foto</a></li>
		<li class="active">Ubah Data Foto</li>
	</ol>

	<form action="" class="form-inline form-input" id="form-media-gallery-foto">
		<input type="hidden" name="id_medgall" id="id_medgall" value="<?= $medgall_foto['id_medgall']; ?>">
		<input type="hidden" name="id_admin" id="id_admin" value="<?= $_SESSION['id_admin']; ?>">

		<div class="input-group">
			<label class="input-group-btn">
				<span class="btn btn-danger" style="color:#f7f7f7;">
					Browse&hellip; <input type="file" name="foto" id="foto" style="display: none;" readonly>
				</span>
			</label>
			<input type="text" class="form-control" size="30" readonly>
		</div>
		<br><br>
		<div class="row">
			<div class="col-sm-6">
				<div class="input-group">
				<?php if( !$medgall_foto['nama_file_medgall'] ) : ?>
					<img src="images/no-image-icon.png" id="fetch-foto" width="100%" height="350">
				<?php else : ?>
					<img src="../media_gallery/foto/<?= $medgall_foto['nama_file_medgall']; ?>" id="fetch-foto" width="100%" height="350">
				<?php endif; ?>
				</div>
			</div>
		</div>
		<br><br>
		<div class="input-group">
			<button type="submit" class="btn btn-primary" name="ubah-foto" id="ubah-foto"><i class="fa fa-edit"></i> Ubah</button>
		</div>
	</form>
	<div class="progress" style="display:none;">
		<div id="progressBar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
			<span class="sr-only">0%</span>
		</div>
	</div>
	<div class="msg alert alert-info text-left" style="display:none;"></div>
</div>

<script src="../assets/js/form_validation/form_validation_medgall_foto.js"></script>

<?php
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_medgall_foto';
			</script>
		";
	}
?>