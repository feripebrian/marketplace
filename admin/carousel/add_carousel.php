<?php

	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

?>

<div class="page-header">
	<h3>TAMBAH DATA CAROUSEL</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=carousel">Carousel</a></li>
		<li class="active">Tambah Data Carousel</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-carousel" enctype="multipart/form-data">
		<div class="form-group">
			<label for="gambar" class="col-sm-2 control-label"><span>**</span> Gambar</label>
			<div class="col-sm-6">
				<div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-danger" style="color:#f7f7f7;">
							Browse&hellip; <input type="file" name="gambar" id="gambar" style="display:none;" readonly required>
						</span>
					</label>
					<input type="text" class="form-control" name="gambar-text" id="gambar-text" readonly>
				</div>

				<br>
				<img src="images/no-image-icon.png" id="fetch-gambar" width="100%" height="320">
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="ket_carousel" class="col-sm-2 control-label"><span>**</span> Keterangan</label>
			<div class="col-sm-6">
				<textarea class="form-control" name="ket_carousel" id="ket_carousel" cols="30" rows="5"></textarea>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="simpan-carousel" id="simpan-carousel"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_carousel.js"></script>