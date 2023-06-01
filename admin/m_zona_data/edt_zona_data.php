<?php

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		$linkdata = query("SELECT * FROM tb_zona_data WHERE id_data_link='$id'")[0];

?>

<div class="page-header">
	<h3>UBAH INTEGRITAS DATA ZONA</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_zona_data">Integritas Data Zona</a></li>
		<li class="active">Ubah Integritas Data Zona</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-data-zona">
		<input type="hidden" name="id_data_link" id="id_data_link" value="<?= $linkdata['id_data_link']; ?>">

		<div class="form-group">
			<label for="nama_data_link" class="col-sm-2 control-label"><span>**</span> Nama Data</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_data_link" id="nama_data_link" value="<?= $linkdata['nama_data_link']; ?>" placeholder="Masukkan Nama Data" required>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="link" class="col-sm-2 control-label"><span>**</span> Data Dir</label>
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

<script src="../assets/js/form_validation/form_validation_zona_data.js"></script>

<?php
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_zona_data';
			</script>
		";
	}
?>