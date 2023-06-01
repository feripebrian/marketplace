<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}
	
	require 'funct_berita.php';

	// CEK APAKAH $_GET['id'] ADA
	if( empty($_GET['id']) ) {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='http://localhost/kemenagjaksel/admin/?page=m_berita';
			</script>
		";
	} else {
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		$berita = query("SELECT * FROM tb_berita WHERE id_berita=$id")[0];
?>

<div class="page-header">
	<h3>UBAH DATA BERITA</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_berita">Berita</a></li>
		<li class="active">Ubah Data Berita</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-berita" enctype="multipart/form-data">
		<input type="hidden" name="id_berita" id="id_berita" value="<?= $berita['id_berita']; ?>">
		<input type="hidden" name="id_admin" id="id_admin" value="<?= $_SESSION['id_admin']; ?>">

		<div class="form-group">
			<label for="judul_berita" class="col-sm-2 control-label"><span>**</span> Judul Berita</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="judul_berita" id="judul_berita" value="<?= $berita['judul_berita']; ?>" placeholder="Masukkan Judul Berita" required autofocus>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="gambar" class="col-sm-2 control-label"><span>**</span> Gambar</label>
			<div class="col-sm-6">
				<div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-danger" style="color:#f7f7f7;">
							Browse&hellip; <input type="file" name="gambar" id="gambar" style="display:none;" readonly required>
						</span>
					</label>
					<?php if( !$berita['gambar'] ) : ?>
						<input type="text" class="form-control" name="gambar-text" id="gambar-text" readonly>
					<?php else : ?>
						<input type="text" class="form-control" name="gambar-text" id="gambar-text" value="<?= $berita['gambar']; ?>" readonly>
					<?php endif; ?>
				</div>

				<br>
				<?php if( !$berita['gambar'] ) : ?>
					<img src="images/no-image-icon.png" id="fetch-gambar" width="100%" height="252">
				<?php else : ?>
					<img src="../image/berita/<?= $berita['gambar']; ?>" id="fetch-gambar" width="100%" height="252">
				<?php endif; ?>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="isi_berita" class="col-sm-2 control-label"><span>**</span> Isi Berita</label>
			<div class="col-sm-6">
				<textarea class="form-control" name="isi_berita" id="isi_berita" cols="30" rows="5"><?= $berita['isi_berita']; ?></textarea>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="ubah-berita" id="ubah-berita"><i class="fa fa-edit"></i> Ubah</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_berita.js"></script>

<?php
	} // Tutup if else
?>