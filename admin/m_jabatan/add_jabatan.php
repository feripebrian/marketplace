<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

?>

<div class="page-header">
	<h3>TAMBAH DATA JABATAN</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_jabatan">Jabatan</a></li>
		<li class="active">Tambah Data Jabatan</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-jabatan">

		<div class="form-group">
			<label for="nama_jabatan" class="col-sm-2 control-label"><span>**</span> Nama Jabatan</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" placeholder="Masukkan Nama Jabatan" required autofocus>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="simpan-jabatan" id="simpan-jabatan"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
		
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_jabatan.js"></script>