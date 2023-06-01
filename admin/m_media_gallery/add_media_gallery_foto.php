<div class="page-header">
	<h3>TAMBAH DATA MEDIA GALLERY FOTO</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_medgall_foto">Media Gallery Foto</a></li>
		<li class="active">Tambah Data Foto</li>
	</ol>

	<form action="" class="form-inline form-input invalid" id="form-media-gallery-foto">
		<input type="hidden" name="id_admin" id="id_admin" value="<?= $_SESSION['id_admin']; ?>">

		<div class="input-group">
			<label class="input-group-btn">
				<span class="btn btn-danger" style="color:#f7f7f7;">
					Browse&hellip; <input type="file" class="invalid" id="media" name="media[]" style="display: none;" multiple readonly required>
				</span>
			</label>
			<input type="text" class="form-control invalid" size="30" readonly required>
		</div>
		<br><br>
		<div class="row" id="fetch-data-foto">

		</div>
		<br>
		<div class="input-group">
			<button type="submit" class="btn btn-primary" name="upload-foto" id="upload-foto"><i class="fa fa-upload"></i> Upload</button>
		</div>
	</form>
	<div class="progress" style="display:none;">
		<div id="progressBar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
			<span class="sr-only">0%</span>
		</div>
	</div>
	<div class="msg alert alert-info text-left" style="display:none;"></div>
</div>

<script src="../assets/js/form_validation/form_validation_medgall_foto.js"></script>