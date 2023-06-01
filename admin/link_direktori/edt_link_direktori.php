<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	// CEK APAKAH $_GET['id'] ADA
	if( empty($_GET['id']) ) {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='http://localhost/kemenagjaksel/admin/?page=link_direktori';
			</script>
		";
	} else {
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		$direktori = query("SELECT * FROM tb_direktori ORDER BY nama_direktori ASC");
		$linkdir = query("SELECT * FROM tb_direktori_link WHERE id_dir_link='$id'")[0];

?>

<div class="page-header">
	<h3>UBAH DATA LINK DIREKTORI</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=link_direktori">Link Direktori</a></li>
		<li class="active">Ubah Data Direktori</li>
	</ol>

	<form action="" class="form-horizontal form-input" id="form-link-direktori">
		<input type="hidden" name="id_dir_link" id="id_dir_link" value="<?= $linkdir['id_dir_link']; ?>">

		<div class="form-group">
			<label for="direktori" class="col-sm-2 control-label"><span>**</span> Direktori</label>
			<div class="col-sm-6">
				<select class="form-control" name="direktori" id="direktori">
					<option value="">-- Pilih Direktori --</option>
				<?php foreach( $direktori as $dir ) : ?>
					<option value="<?= $dir['id_direktori']; ?>" <?php if( $linkdir['id_direktori'] == $dir['id_direktori'] ){ echo "selected"; } ?>><?= $dir['nama_direktori']; ?></option>
				<?php endforeach; ?>
				</select>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="nama_link" class="col-sm-2 control-label"><span>**</span> Nama Link</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama_link" id="nama_link" value="<?= $linkdir['nama_dir_link']; ?>" placeholder="Masukkan Nama Link" required>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<label for="link" class="col-sm-2 control-label"><span>**</span> Link</label>
			<div class="col-sm-6">
				<textarea class="form-control" name="link" id="link" cols="30" rows="5" placeholder="Masukkan Link URL" required><?= $linkdir['link_dir_link']; ?></textarea>
			</div>
			<div class="col-sm-4 pesan">
				<p class="text-muted pesan-text"></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-6">
				<button type="submit" class="btn btn-primary" name="ubah-link-direktori" id="ubah-link-direktori"><i class="fa fa-edit"></i> Ubah</button>
			</div>
		</div>
	</form>
</div>

<script src="../assets/js/form_validation/form_validation_link_direktori.js"></script>

<?php
	} // Tutup if else
?>