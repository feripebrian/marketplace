<div class="page-header">
	<h3>TAMBAH ZONA INTEGRITAS DATA</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_zona_data">Link Zona Integritas Data</a></li>
		<li class="active">Tambah Zona Integritas Data</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-data-zona" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nama_data_link" class="col-sm-2 control-label"><span>**</span> Nama Data</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_data_link" id="nama_data_link" placeholder="Masukkan Nama Data" required>
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
				<button type="submit" class="btn btn-primary" name="simpan-data" id="simpan-data"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_zona_data.js"></script>