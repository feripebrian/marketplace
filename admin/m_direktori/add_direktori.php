<div class="page-header">
	<h3>TAMBAH DATA DIREKTORI</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_direktori">Direktori</a></li>
		<li class="active">Tambah Data Direktori</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-direktori">
		<div class="form-group">
			<label for="id_direktori" class="col-sm-2 control-label"><span>**</span> ID Direktori</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="id_direktori" id="id_direktori" placeholder="Masukkan ID Direktori" required autofocus>
			</div>
			<div class="col-sm-3 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="nama_direktori" class="col-sm-2 control-label"><span>**</span> Nama Direktori</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="nama_direktori" id="nama_direktori" placeholder="Masukkan Nama Direktori" required>
			</div>
			<div class="col-sm-3 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="simpan-direktori" id="simpan-direktori"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_direktori.js"></script>