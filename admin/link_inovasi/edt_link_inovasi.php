<?php

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		$linkinovasi = query("SELECT * FROM tb_inovasi_link WHERE id_inovasi_link='$id'")[0];

?>

<div class="page-header">
	<h3>UBAH DATA LINK INOVASI</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=link_inovasi">Link Inovasi</a></li>
		<li class="active">Ubah Data Inovasi</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-link-inovasi">
		<input type="hidden" name="id_inovasi_link" id="id_inovasi_link" value="<?= $linkinovasi['id_inovasi_link']; ?>">

		<div class="form-group">
			<label for="nama_link" class="col-sm-2 control-label"><span>**</span> Nama Link</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_link" id="nama_link" value="<?= $linkinovasi['nama_inovasi_link']; ?>" placeholder="Masukkan Nama Link" required>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="link" class="col-sm-2 control-label"><span>**</span> Link Dir</label>
			<div class="col-sm-6">
				<input type="file"  accept="application/pdf" name="link" id="link"></input><br>
				<div id="link_old">
					<?= $linkinovasi['link_inovasi']; ?>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="ubah-link-inovasi" id="ubah-link-inovasi"><i class="fa fa-edit"></i> Ubah</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_link_inovasi.js"></script>
<script>
		$('#link').on('change', function() {                 
		$("#link_old").hide();
	});
</script>
<?php
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_inovasi';
			</script>
		";
	}
?>