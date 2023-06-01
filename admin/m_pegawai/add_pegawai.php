<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	$jabatan = query("SELECT * FROM tb_jabatan ORDER BY nama_jabatan ASC");

?>

<div class="page-header">
	<h3>TAMBAH DATA PEGAWAI</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_pegawai">Pegawai</a></li>
		<li class="active">Tambah Data Pegawai</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-pegawai" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nip" class="col-sm-2 control-label"><span>**</span> NIP</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nip" id="nip" placeholder="Masukkan NIP Pegawai" required autofocus>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="nama_pegawai" class="col-sm-2 control-label"><span>**</span> Nama Pegawai</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" placeholder="Masukkan Nama Pegawai" required>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="jk" class="col-sm-2 control-label">Jenis Kelamin</label>
			<div class="col-sm-6">
				<label class="radio-inline">
					<input type="radio" name="jk" id="jkL" value="L"> L
				</label>
				<label class="radio-inline">
					<input type="radio" name="jk" id="jkP" value="P"> P
				</label>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="jabatan" class="col-sm-2 control-label"><span>**</span> Jabatan</label>
			<div class="col-sm-6">
				<select class="form-control" name="jabatan" id="jabatan">
					<option value="">-- PILIH JABATAN --</option>
				<?php foreach( $jabatan as $jbtn ) : ?>
					<option value="<?= $jbtn['kd_jabatan']; ?>"><?= $jbtn['nama_jabatan']; ?></option>
				<?php endforeach; ?>
				</select>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="foto" class="col-sm-2 control-label"><span>**</span> Foto</label>
			<div class="col-sm-6">
				<div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-danger" style="color:#f7f7f7;">
							Browse&hellip; <input type="file" name="foto" id="foto" style="display:none;" readonly required>
						</span>
					</label>
					<input type="text" class="form-control" name="foto-text" id="foto-text" readonly>
				</div>

				<br>
				<img src="images/no-image.png" id="fetch-foto" width="152" height="172">
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="simpan-pegawai" id="simpan-pegawai"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_pegawai.js"></script>