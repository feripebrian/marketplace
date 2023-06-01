<?php

	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	// CEK APAKAH $_GET['id'] ADA
	if( empty($_GET['id']) ) {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='http://localhost/kemenagjaksel/admin/?page=carousel';
			</script>
		";
	} else {
		$id       = mysqli_real_escape_string($conn, $_GET['id']);
		$carousel = query("SELECT * FROM tb_carousel WHERE id_carousel='$id'")[0];
?>

<div class="page-header">
	<h3>UBAH DATA CAROUSEL</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=carousel">Carousel</a></li>
		<li class="active">Ubah Data Carousel</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-carousel" enctype="multipart/form-data">
		<input type="hidden" name="id_carousel" id="id_carousel" value="<?= $carousel['id_carousel']; ?>">

		<div class="form-group">
			<label for="gambar" class="col-sm-2 control-label"><span>**</span> Gambar</label>
			<div class="col-sm-6">
				<div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-danger" style="color:#f7f7f7;">
							Browse&hellip; <input type="file" name="gambar" id="gambar" style="display:none;" readonly required>
						</span>
					</label>
					<?php if( !$carousel['gambar'] ) : ?>
						<input type="text" class="form-control" name="gambar-text" id="gambar-text" readonly>
					<?php else : ?>
						<input type="text" class="form-control" name="gambar-text" id="gambar-text" value="<?= $carousel['gambar']; ?>" readonly>
					<?php endif; ?>
				</div>

				<br>
				<?php if( !$carousel['gambar'] ) : ?>
					<img src="images/no-image-icon.png" id="fetch-gambar" width="100%" height="320">
				<?php else : ?>
					<img src="../image/carousel/<?= $carousel['gambar']; ?>" id="fetch-gambar" width="100%" height="320">
				<?php endif; ?>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="ket_carousel" class="col-sm-2 control-label"><span>**</span> Keterangan</label>
			<div class="col-sm-6">
				<textarea class="form-control" name="ket_carousel" id="ket_carousel" cols="30" rows="5"><?= $carousel['ket_carousel']; ?></textarea>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="ubah-carousel" id="ubah-carousel"><i class="fa fa-edit"></i> Ubah</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_carousel.js"></script>

<?php
	} // Tutup if else
?>