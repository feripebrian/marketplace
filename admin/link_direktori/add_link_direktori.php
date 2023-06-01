<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	$direktori = query("SELECT * FROM tb_direktori ORDER BY nama_direktori ASC");

?>

<div class="page-header">
	<h3>TAMBAH DATA LINK DIREKTORI</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=link_direktori">Link Direktori</a></li>
		<li class="active">Tambah Data Link Direktori</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-link-direktori">
		<div class="form-group">
			<label for="direktori" class="col-sm-2 control-label"><span>**</span> Direktori</label>
			<div class="col-sm-6">
				<select class="form-control" name="direktori" id="direktori">
					<option value="">-- Pilih Direktori --</option>
				<?php foreach( $direktori as $dir ) : ?>
					<option value="<?= $dir['id_direktori']; ?>"><?= $dir['nama_direktori']; ?></option>
				<?php endforeach; ?>
				</select>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="nama_link" class="col-sm-2 control-label"><span>**</span> Nama</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_link" id="nama_link" placeholder="Masukkan Nama Link" required>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="link" class="col-sm-2 control-label"><span>**</span> Link</label>
			<div class="col-sm-6">
				<textarea class="form-control" name="link" id="link" cols="30" rows="5" placeholder="Masukkan Link URL" required></textarea>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="simpan-link-direktori" id="simpan-link-direktori"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_link_direktori.js"></script>