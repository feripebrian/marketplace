<div class="page-header">
	<h3>TAMBAH DATA LINK MAKLUMAT</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=link_maklumat">Link Maklumat</a></li>
		<li class="active">Tambah Data Link Maklumat</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-link-maklumat" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nama_link" class="col-sm-2 control-label"><span>**</span> Nama Link</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_link" id="nama_link" placeholder="Masukkan Nama Link" required>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="link" class="col-sm-2 control-label"><span>**</span> Link Dir</label>
			<div class="col-sm-6">
				<input type="file" name="link" id="link" accept="application/pdf" required></input><br>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="simpan-link-maklumat" id="simpan-link-maklumat"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_link_maklumat.js"></script>