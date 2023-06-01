<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	$pegawai = query("SELECT p.nip, p.nama_pegawai, p.kd_jabatan, j.nama_jabatan, p.status FROM tb_pegawai p, tb_jabatan j WHERE p.kd_jabatan=j.kd_jabatan AND j.nama_jabatan != 'KEPALA KANTOR' AND p.status=1 ORDER BY p.kd_jabatan ASC");

?>

<div class="page-header">
	<h3>TAMBAH DATA UNIT KERJA</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=unitkerja">Unit Kerja</a></li>
		<li class="active">Tambah Data Unit Kerja</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-unitkerja">
		<div class="form-group">
			<label for="pegawai" class="col-sm-2 control-label"><span>**</span> Pegawai</label>
			<div class="col-sm-6">
				<select class="form-control" name="pegawai" id="pegawai">
					<option value="">-- Pilih Pegawai --</option>
				<?php foreach( $pegawai as $pg ) : ?>
					<option value="<?= $pg['nip']; ?>"><?= $pg['nama_pegawai']." | ".$pg['nama_jabatan']; ?></option>
				<?php endforeach; ?>
				</select>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="deskripsi" class="col-sm-2 control-label"><span>**</span> Deskripsi</label>
			<div class="col-sm-6">
				<textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5" placeholder="Masukkan Deskripsi Unit Kerja" required></textarea>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="simpan-unitkerja" id="simpan-unitkerja"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_unit_kerja.js"></script>