<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	// CEK APAKAH $_GET['nip'] ADA
	if( empty($_GET['nip']) ) {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='http://localhost/kemenagjaksel/admin/?page=m_pegawai';
			</script>
		";
	} else {
		$nip = mysqli_real_escape_string($conn, $_GET['nip']);

		$pegawai = query("SELECT * FROM tb_pegawai WHERE nip='$nip'")[0];
		$jabatan = query("SELECT * FROM tb_jabatan ORDER BY nama_jabatan ASC");
?>

<div class="page-header">
	<h3>UBAH DATA PEGAWAI</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_pegawai">Pegawai</a></li>
		<li class="active">Ubah Data Pegawai</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-pegawai" enctype="multipart/form-data">
		<input type="hidden" name="nip_lama" id="nip_lama" value="<?= $pegawai['nip']; ?>">

		<div class="form-group">
			<label for="nip_baru" class="col-sm-2 control-label"><span>**</span> NIP</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nip_baru" id="nip_baru" placeholder="Masukkan NIP Pegawai" value="<?= $pegawai['nip']; ?>" required autofocus>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="nama_pegawai" class="col-sm-2 control-label"><span>**</span> Nama</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" value="<?= $pegawai['nama_pegawai']; ?>" placeholder="Masukkan Nama Pegawai" required>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="jk" class="col-sm-2 control-label">Jenis Kelamin</label>
			<div class="col-sm-6">
				<label class="radio-inline">
					<input type="radio" name="jk" id="jkL" value="L" <?php if( $pegawai['jk'] == "L" ) echo "checked"; ?>> L
				</label>
				<label class="radio-inline">
					<input type="radio" name="jk" id="jkP" value="P" <?php if( $pegawai['jk'] == "P" ) echo "checked"; ?>> P
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
					<option value="<?= $jbtn['kd_jabatan']; ?>" <?php if( $pegawai['kd_jabatan'] == $jbtn['kd_jabatan'] ) echo "selected"; ?>><?= $jbtn['nama_jabatan']; ?></option>
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
					<input type="text" class="form-control" name="foto-text" id="foto-text" value="<?= $pegawai['foto']; ?>" readonly>
				</div>

				<br>
			<?php if( !$pegawai['foto'] ) : ?>
				<img src="images/no-image.png" id="fetch-foto" width="152" height="172">
			<?php else : ?>
				<img src="../image/pegawai/<?= $pegawai['foto']; ?>" id="fetch-foto" width="152" height="172">
			<?php endif; ?>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="ubah-pegawai" id="ubah-pegawai"><i class="fa fa-edit"></i> Ubah</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_pegawai.js"></script>

<?php
	} // Tutup if else
?>