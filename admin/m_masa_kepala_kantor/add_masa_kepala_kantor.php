<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	$kepala_kantor = query("SELECT p.nip, p.nama_pegawai, p.kd_jabatan, j.nama_jabatan, p.foto FROM tb_pegawai p, tb_jabatan j WHERE p.kd_jabatan=j.kd_jabatan AND j.nama_jabatan='KEPALA KANTOR' ORDER BY nama_pegawai ASC");

?>

<div class="page-header">
	<h3>TAMBAH DATA MASA KEPALA KANTOR</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_masa_kpl">Masa Kepala Kantor</a></li>
		<li class="active">Tambah Data Masa Kepala Kantor</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-masa-kpl">
		<div class="form-group">
			<label for="kepala_kantor" class="col-sm-2 control-label"><span>**</span> Kepala Kantor</label>
			<div class="col-sm-6">
				<select class="form-control" name="kepala_kantor" id="kepala_kantor">
					<option value="">-- PILIH KEPALA KANTOR --</option>
				<?php foreach( $kepala_kantor as $kpl ) :
				?>
					<option value="<?= $kpl['nip']; ?>"><?= $kpl['nama_pegawai']." | ".$kpl['nama_jabatan']; ?></option>
				<?php endforeach; ?>
				</select>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6 text-center">
				<img src="images/no-image.png" width="152" height="172">
				<br><br>
				<strong style="text-decoration:underline"></strong>
				<br>
				<span style="color:#333;" id="nip"></span>
			</div>
		</div>

		<div class="form-group">
			<label for="periode_dari" class="col-sm-2 control-label"><span>**</span> Periode Dari</label>
			<div class="col-sm-6">
				<input class="form-control" name="periode_dari" id="periode_dari" placeholder="Masukkan Tanggal Periode Dari">
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="periode_sampai" class="col-sm-2 control-label"><span>**</span> Periode Sampai</label>
			<div class="col-sm-6">
				<input class="form-control" name="periode_sampai" id="periode_sampai" placeholder="Masukkan Tanggal Periode Sampai">
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="simpan-masa-kpl" id="simpan-masa-kpl"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_masa_kpl.js"></script>