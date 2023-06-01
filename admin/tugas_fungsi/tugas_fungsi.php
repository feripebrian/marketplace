<?php
	
	$tugas_fungsi = query("SELECT tf.kd_tugas_fungsi, tf.nip, pg.nama_pegawai, pg.foto, tf.deskripsi FROM tb_tugas_fungsi tf, tb_pegawai pg WHERE tf.nip=pg.nip")[0];
	$pegawai = query("SELECT p.nip, p.nama_pegawai, p.kd_jabatan, j.nama_jabatan, p.status FROM tb_pegawai p, tb_jabatan j WHERE p.kd_jabatan=j.kd_jabatan AND j.nama_jabatan='KEPALA KANTOR' AND p.status=1 ORDER BY p.nama_pegawai ASC");

?>

<div class="page-header">
	<h3>TUGAS DAN FUNGSI</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Tugas & Fungsi</li>
	</ol>
	
	<form action="" class="form-horizontal form-input" id="form-tugasfungsi">
		<input type="hidden" name="kd_tugas_fungsi" id="kd_tugas_fungsi" value="<?= $tugas_fungsi['kd_tugas_fungsi']; ?>">

		<div class="form-group">
			<label for="pegawai" class="col-sm-2 control-label"><span>**</span> Pegawai</label>
			<div class="col-sm-6">
				<select class="form-control" name="pegawai" id="pegawai">
					<option value="">-- Pilih Pegawai --</option>
				<?php foreach( $pegawai as $pg ) : ?>
					<option value="<?= $pg['nip']; ?>" <?php if( $pg['nip'] == $tugas_fungsi['nip'] ) echo "selected"; ?>><?= $pg['nama_pegawai']." | ".$pg['nama_jabatan']; ?></option>
				<?php endforeach; ?>
				</select>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6 text-center">
			<?php if( !$tugas_fungsi['foto'] ) : ?>
				<img src="images/no-image.png" id="fetch-foto" width="182" height="200">
			<?php else : ?>
				<img src="../image/pegawai/<?= $tugas_fungsi['foto']; ?>" id="fetch-foto" width="182" height="200">
			<?php endif; ?>
				<br><br>
				<strong style="text-decoration:underline;">
					<?php if( !$tugas_fungsi['nama_pegawai'] ) { echo ""; } else { echo $tugas_fungsi['nama_pegawai']; } ?>
				</strong>
				<br>
				<span style="color:#333;" id="nip">
					<?php if( !$tugas_fungsi['nip'] ) { echo ""; } else { echo $tugas_fungsi['nip']; } ?>
				</span>
			</div>
		</div>

		<div class="form-group">
			<label for="deskripsi" class="col-sm-2 control-label"><span>**</span> Deskripsi</label>
			<div class="col-sm-6">
				<textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5" placeholder="Deskripsi Tugas dan Fungsi"><?= $tugas_fungsi['deskripsi']; ?></textarea>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="ubah-tugasfungsi" id="ubah-tugasfungsi"><i class="fa fa-edit"></i> Ubah</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_tugasfungsi.js"></script>