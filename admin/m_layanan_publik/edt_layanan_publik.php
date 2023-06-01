<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	require 'funct_layanan_publik.php';

	// CEK APAKAH $_GET['id'] ADA
	if( empty($_GET['id']) ) {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='http://localhost/kemenagjaksel/admin/?page=m_layananpublik';
			</script>
		";
	} else {
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		$layanan_publik = query("SELECT * FROM tb_layanan_publik WHERE id_layanan_pblk=$id")[0];
?>

<div class="page-header">
	<h3>UBAH DATA LAYANAN PUBLIK</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_layananpublik">Layanan Publik</a></li>
		<li class="active">Ubah Data Layanan Publik</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-layanan-publik" enctype="multipart/form-data">
		<input type="hidden" name="id_layanan_pblk" id="id_layanan_pblk" value="<?= $layanan_publik['id_layanan_pblk']; ?>">

		<div class="form-group">
			<label for="url_layanan_pblk" class="col-sm-2 control-label"><span>**</span> URL Link</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="url_layanan_pblk" id="url_layanan_pblk" value="<?= $layanan_publik['url_layanan_pblk']; ?>" placeholder="Masukkan URL Link" required autofocus>
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
					<?php if( !$layanan_publik['gambar'] ) : ?>
						<input type="text" class="form-control" name="gambar-text" id="gambar-text" readonly>
					<?php else : ?>
						<input type="text" class="form-control" name="gambar-text" id="gambar-text" value="<?= $layanan_publik['gambar']; ?>" readonly>
					<?php endif; ?>
				</div>

				<br>
				<?php if( !$layanan_publik['gambar'] ) : ?>
					<img src="images/no-image-icon.png" id="fetch-gambar" width="100%" height="252">
				<?php else : ?>
					<img src="../image/layanan_publik/<?= $layanan_publik['gambar']; ?>" id="fetch-gambar" width="100%" height="252">
				<?php endif; ?>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="ket_layanan_pblk" class="col-sm-2 control-label"><span>**</span> Keterangan</label>
			<div class="col-sm-6">
				<textarea class="form-control" name="ket_layanan_pblk" id="ket_layanan_pblk" cols="30" rows="5" required><?= $layanan_publik['ket_layanan_pblk']; ?></textarea>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="ubah-layanan" id="ubah-layanan"><i class="fa fa-edit"></i> Ubah</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_layanan.js"></script>

<?php
	} // Tutup if else
?>