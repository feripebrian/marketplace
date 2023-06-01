<?php

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		$linkpenmad = query("SELECT * FROM tb_penmad_link WHERE id_penmad_link='$id'")[0];

?>

<div class="page-header">
	<h3>UBAH DATA LINK PENDIDIKAN MADRASAH</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=link_penmad">Link Pendidikan Madrasah</a></li>
		<li class="active">Ubah Data Pendidikan Madrasah</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-link-penmad">
		<input type="hidden" name="id_penmad_link" id="id_penmad_link" value="<?= $linkpenmad['id_penmad_link']; ?>">

		<div class="form-group">
			<label for="nama_link" class="col-sm-2 control-label"><span>**</span> Nama Link</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_link" id="nama_link" value="<?= $linkpenmad['nama_penmad_link']; ?>" placeholder="Masukkan Nama Link" required>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="link" class="col-sm-2 control-label"><span>**</span> Link URL</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="link" id="link" value="<?= $linkpenmad['link_penmad']; ?>" placeholder="Masukkan Url Link" required></input><br>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="ubah-link-penmad" id="ubah-link-penmad"><i class="fa fa-edit"></i> Ubah</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_link_penmad.js"></script>

<?php
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_penmad';
			</script>
		";
	}
?>