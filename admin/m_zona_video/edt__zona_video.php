<?php

	require 'funct_media_gallery.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		$medgall_video = query("SELECT * FROM tb_media_gallery WHERE id_medgall=$id AND kategori_medgall='VIDEO'")[0];
?>

<div class="page-header">
	<h3>UBAH DATA MEDIA GALLERY VIDEO</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_medgall_video">Media Gallery Video</a></li>
		<li class="active">Ubah Data Video</li>
	</ol>

	<form action="" class="form-inline form-input" id="form-media-gallery-video">
		<input type="hidden" name="id_medgall" id="id_medgall" value="<?= $medgall_video['id_medgall']; ?>">
		<input type="hidden" name="id_admin" id="id_admin" value="<?= $_SESSION['id_admin']; ?>">

		<div class="input-group">
			<label class="input-group-btn">
				<span class="btn btn-danger" style="color:#f7f7f7;">
					Browse&hellip; <input type="file" id="media" name="media" style="display: none;" readonly required>
				</span>
			</label>
			<input type="text" class="form-control" size="30" value="<?= $medgall_video['nama_file_medgall']; ?>" readonly required>
		</div>

		<br><br>
		<div class="row" id="fetch-data-video">
			<div class="col-sm-8">
				<div class="input-group">
					<input type="text" class="form-control" name="judul" id="judul" value="<?= $medgall_video['judul']; ?>" size="100%" placeholder="Masukkan Judul Video" required>
					<br>
				<?php if( !$medgall_video['nama_file_medgall'] ) : ?>
					<video width="100%" height="524" controls="controls">
						<source src="" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				<?php else : ?>
					<video width="100%" height="524" controls="controls">
						<source src="../media_gallery/video/<?= $medgall_video['nama_file_medgall']; ?>" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				<?php endif; ?>
				</div>
			</div>
		</div>
		<br><br>

		<div class="input-group">
			<button type="submit" class="btn btn-primary" name="ubah-video" id="ubah-video"><i class="fa fa-edit"></i> Ubah</button>
		</div>
	</form>
	<div class="progress" style="display:none;">
		<div id="progressBar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
			<span class="sr-only">0%</span>
		</div>
	</div>
	<div class="msg alert alert-info text-left" style="display:none;"></div>
</div>

<script src="../assets/js/form_validation/form_validation_medgall_video.js"></script>

<?php
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_medgall_video';
			</script>
		";
	}
?>