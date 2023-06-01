<?php

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		$linkdata = query("SELECT * FROM tb_zona_video WHERE id_video_link='$id'")[0];

?>

<div class="page-header">
	<h3>UBAH INTEGRITAS DATA VIDEO</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_zona_video">Integritas Data Video</a></li>
		<li class="active">Ubah Integritas Data Video</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-data-zona">
		<input type="hidden" name="id_video_link" id="id_video_link" value="<?= $linkdata['id_video_link']; ?>">

		<div class="form-group">
			<label for="nama_data_link" class="col-sm-2 control-label"><span>**</span> Nama Video</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_video_link" id="nama_video_link" value="<?= $linkdata['nama_video_link']; ?>" placeholder="Masukkan Nama video" required>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="link" class="col-sm-2 control-label"><span>**</span> Video Dir</label>
			<div class="col-sm-6">
				<input type="file" name="link" id="link" required></input><br>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="ubah-data" id="ubah-data"><i class="fa fa-edit"></i> Ubah</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_zona_video.js"></script>

<?php
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_zona_video';
			</script>
		";
	}
?>