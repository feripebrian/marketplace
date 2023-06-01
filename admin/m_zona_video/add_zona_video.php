<div class="page-header">
	<h3>TAMBAH ZONA INTEGRITAS VIDEO</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_zona_video">Link Zona Integritas Video</a></li>
		<li class="active">Tambah Zona Integritas Video</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-data-zona" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nama_video_link" class="col-sm-2 control-label"><span>**</span> Nama Video</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_video_link" id="nama_video_link" placeholder="Masukkan Nama Video" required>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="link" class="col-sm-2 control-label"><span>**</span> Video Dir</label>
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

<script src="../assets/js/form_validation/form_validation_zona_video.js"></script>