<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	// CEK APAKAH $_GET['no']/$_GET['kd']/$_GET['nip'] ADA
	if( empty($_GET['no']) || empty($_GET['kd']) || empty($_GET['nip']) ) {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='http://localhost/kemenagjaksel/admin/?page=unitkerja';
			</script>
		";
	} else {
		$no   = mysqli_real_escape_string($conn, $_GET['no']);
		$kode = mysqli_real_escape_string($conn, $_GET['kd']);
		$nip  = mysqli_real_escape_string($conn, $_GET['nip']);

		$jabatan = query("SELECT p.nip, p.kd_jabatan, j.nama_jabatan FROM tb_pegawai p, tb_jabatan j WHERE p.nip='$nip' AND p.kd_jabatan=j.kd_jabatan")[0];
		$data = query("SELECT * FROM tb_detail_unit_kerja WHERE no_detail_uk=$no")[0];
?>

<div class="page-header">
	<h3>UBAH DATA UNIT KERJA <?= $jabatan['nama_jabatan']; ?></h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=unitkerja">Unit Kerja</a></li>
		<li><a href="?page=dtl_unitkerja&kd=<?= $kode; ?>&nip=<?= $nip; ?>">Detail Unit Kerja</a></li>
		<li class="active">Ubah Data Detail Unit Kerja</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-detail-unitkerja">
		<input type="hidden" name="no_detail_uk" id="no_detail_uk" value="<?= $data['no_detail_uk']; ?>">
		<input type="hidden" name="kd_unit_kerja" id="kd_unit_kerja" value="<?= $kode; ?>">
		<input type="hidden" name="nip" id="nip" value="<?= $nip; ?>">

		<div class="form-group">
			<label for="nama_detail" class="col-sm-2 control-label"><span>**</span> Nama Unit Kerja</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_detail" id="nama_detail" value="<?= $data['nama_detail_uk']; ?>" placeholder="Masukkan Nama Unit Kerja" required autofocus>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="file" class="col-sm-2 control-label"><span>**</span> File</label>
			<div class="col-sm-6">
				<div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-danger" style="color:#f7f7f7;">
							Browse&hellip; <input type="file" name="file" id="file" style="display:none;" readonly>
						</span>
					</label>
					<?php if( !$data['file'] ) : ?>
						<input type="text" class="form-control" name="file-text" id="file-text" readonly>
					<?php else : ?>
						<input type="text" class="form-control" name="file-text" id="file-text" value="<?= $data['file']; ?>" readonly>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="ubah-detail-unitkerja" id="ubah-detail-unitkerja"><i class="fa fa-edit"></i> Ubah</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_detail_unit_kerja.js"></script>

<?php
	} // Tutup if else
?>