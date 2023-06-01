<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}
	
	require 'helpers/funct_tanggal.php';

	// CEK APAKAH $_GET['nip'] ADA
	if( empty($_GET['nip']) ) {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='http://localhost/kemenagjaksel/admin/?page=m_masa_kpl';
			</script>
		";
	} else {
		$nip = mysqli_real_escape_string($conn, $_GET['nip']);

		$kepala_kantor = query("SELECT m.nip_kpl_kantor, p.nama_pegawai, m.periode_dari, m.periode_sampai, p.kd_jabatan, j.nama_jabatan, p.foto FROM tb_masa_kepala_kantor m, tb_pegawai p, tb_jabatan j WHERE m.nip_kpl_kantor='$nip' AND m.nip_kpl_kantor=p.nip AND p.kd_jabatan=j.kd_jabatan")[0];
?>

<div class="page-header">
	<h3>UBAH DATA MASA KEPALA KANTOR</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_masa_kpl">Masa Kepala Kantor</a></li>
		<li class="active">Ubah Data Masa Kepala Kantor</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-masa-kpl">
		<input type="hidden" name="nip" id="nip" value="<?= $kepala_kantor['nip_kpl_kantor']; ?>">

		<div class="form-group">
			<label for="kepala_kantor" class="col-sm-2 control-label">Kepala Kantor</label>
			<div class="col-sm-6 text-center">
			<?php if( !$kepala_kantor['foto'] ) : ?>
				<img src="images/no-image.png" width="200" height="200">
			<?php else : ?>
				<img src="../image/pegawai/<?= $kepala_kantor['foto']; ?>" width="200" height="200">
				<br><br>
				<strong style="text-decoration:underline;"><?= $kepala_kantor['nama_pegawai']; ?></strong>
				<br>
				<?= "NIP. ".$kepala_kantor['nip_kpl_kantor']; ?>
			<?php endif; ?>
			</div>
		</div>

		<div class="form-group">
			<label for="periode_dari" class="col-sm-2 control-label"><span>**</span> Periode Dari</label>
			<div class="col-sm-6">
				<input class="form-control" name="periode_dari" id="periode_dari" value="<?= format_datepicker($kepala_kantor['periode_dari']); ?>" placeholder="Masukkan Tanggal Periode Dari">
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="periode_sampai" class="col-sm-2 control-label"><span>**</span> Periode Sampai</label>
			<div class="col-sm-6">
				<input class="form-control" name="periode_sampai" id="periode_sampai" value="<?= format_datepicker($kepala_kantor['periode_sampai']); ?>" placeholder="Masukkan Tanggal Periode Sampai">
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="ubah-masa-kpl" id="ubah-masa-kpl"><i class="fa fa-edit"></i> Ubah</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_masa_kpl.js"></script>

<?php
	} // Tutup if else
?>