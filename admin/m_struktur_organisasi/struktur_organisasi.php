<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}
	
	$struktur_organisasi = query("SELECT * FROM tb_struktur_organisasi")[0];
	$pegawai = query("SELECT p.nip, p.nama_pegawai, p.kd_jabatan, j.nama_jabatan, p.status FROM tb_pegawai p, tb_jabatan j WHERE p.kd_jabatan=j.kd_jabatan AND p.status=1 ORDER BY p.kd_jabatan ASC");
	$detail_struktur_organisasi = query("SELECT * FROM tb_detail_struktur_organisasi ORDER BY no_detail_org ASC");
?>

<div class="page-header">
	<h3>MASTER DATA STRUKTUR ORGANISASI KANTOR KEMENTRIAN AGAMA JAKARTA SELATAN</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Struktur Organisasi</li>
	</ol>
	
	<form action="" class="form-horizontal form-input" id="form-struktur-organisasi">
		<input type="hidden" name="id_struktur_org" id="id_struktur_org" value="<?= $struktur_organisasi['id_struktur_org']; ?>">

		<div class="form-group">
			<label for="gambar" class="col-sm-2 control-label"><span>**</span> Gambar</label>
			<div class="col-sm-6">
				<div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-danger" style="color:#f7f7f7;">
							Browse&hellip; <input type="file" name="gambar" id="gambar" style="display:none;" readonly required>
						</span>
					</label>
					<input type="text" class="form-control" name="gambar-text" id="gambar-text" readonly>
				</div>

				<br>
			<?php if( !$struktur_organisasi['gambar'] ) : ?>
				<img src="images/no-image-icon.png" id="fetch-gambar" width="100%" height="320">
			<?php else : ?>
				<img src="../image/struktur_organisasi/<?= $struktur_organisasi['gambar']; ?>" id="fetch-gambar" width="100%" height="320">
			<?php endif; ?>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

	<?php foreach( $detail_struktur_organisasi as $dtl_org ) : ?>
		<div class="form-group">
			<label for="no_detail_org<?= $dtl_org['no_detail_org']; ?>" class="col-sm-2 control-label"><span>**</span> Pegawai <?= $dtl_org['no_detail_org']; ?></label>
			<div class="col-sm-6">
				<div class="input-group">
					<label class="input-group-btn">
						<button type="button" class="btn btn-info" id="button<?= $dtl_org['no_detail_org']; ?>" style="color:#f7f7f7;">Edit </button>
						<input type="hidden" name="no_detail_org[]" id="no_detail_org" value="<?= $dtl_org['no_detail_org']; ?>" readonly required disabled>
					</label>
					<select class="form-control" name="pegawai[]" id="pegawai" disabled>
						<option value="">-- Pilih Pegawai --</option>
					<?php foreach( $pegawai as $pg ) : ?>
						<option value="<?= $pg['nip'] ?>" <?php if( $dtl_org['nip'] == $pg['nip'] ) echo "selected"; ?>><?= $pg['nama_pegawai']." | ".$pg['nama_jabatan']; ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>
	<?php endforeach; ?>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-success" name="ubah-struktur-organisasi" id="ubah-struktur-organisasi"><i class="fa fa-edit"></i> Perbarui</button>
				<button type="button" class="btn btn-warning" name="batal-struktur-organisasi" id="batal-struktur-organisasi"><i class="fa fa-refresh"></i> Batal</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_struktur_org.js"></script>