<?php

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		$linkpengaduan = query("SELECT * FROM tb_pengaduan_link WHERE id_pengaduan_link='$id'")[0];

?>

<div class="page-header">
	<h3>UBAH DATA LINK PENGADUAN</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=link_pengaduan">Link Pengaduan</a></li>
		<li class="active">Ubah Data Pengaduan</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-link-pengaduan">
		<input type="hidden" name="id_pengaduan_link" id="id_pengaduan_link" value="<?= $linkpengaduan['id_pengaduan_link']; ?>">

		<div class="form-group">
			<label for="nama_link" class="col-sm-2 control-label"><span>**</span> Nama Link</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_link" id="nama_link" value="<?= $linkpengaduan['nama_pengaduan_link']; ?>" placeholder="Masukkan Nama Link" required>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="link" class="col-sm-2 control-label"><span>**</span> Link URL</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="link" id="link" value="<?= $linkpengaduan['link_pengaduan']; ?>" placeholder="Masukkan Url Link" required></input><br>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="ubah-link-pengaduan" id="ubah-link-pengaduan"><i class="fa fa-edit"></i> Ubah</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_link_pengaduan.js"></script>

<?php
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_pengaduan';
			</script>
		";
	}
?>