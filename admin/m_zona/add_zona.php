<div class="page-header">
	<h3>TAMBAH DATA STANDAR LAYANAN</h3> 
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_zona">ZONA</a></li>
		<li class="active">ZONA</li> 
	</ol>

	<form action="" class="form-horizontal form-input" id="form-zona">
		<div class="form-group">
			<label for="id_zona" class="col-sm-2 control-label"><span>**</span> ID zona</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="id_zona" id="id_zona" placeholder="Masukkan ID zona" required autofocus>
			</div>
			<div class="col-sm-3 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="nama_zona" class="col-sm-2 control-label"><span>**</span> Nama zona</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="nama_zona" id="nama_zona" placeholder="Masukkan Nama Zona" required>
			</div>
			<div class="col-sm-3 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>


		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="simpan-zona" id="simpan-zona"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_zona.js"></script>