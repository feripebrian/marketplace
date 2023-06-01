<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}
	
	require 'helpers/funct_tanggal.php';

	if( empty($_GET['id']) ) {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='http://localhost/kemenagjaksel/admin/?page=m_berita';
			</script>
		";
	} else {
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		$berita = query("SELECT b.id_berita, b.judul_berita, b.isi_berita, b.gambar, b.created_date, b.created_time, b.views, b.id_admin, a.nama_admin, a.level FROM tb_berita b, tb_admin a WHERE b.id_berita=$id AND b.id_admin=a.id_admin")[0];
?>

<div class="page-header">
	<h3>DETAIL DATA BERITA</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=m_berita">Berita</a></li>
		<li class="active">Detail Data Berita</li>
	</ol>

	<br>

	<div class="panel panel-info">
		<div class="panel-heading">ID(<?= $berita['id_berita']; ?>) - <?= $berita['judul_berita']; ?></div>
		<div class="panel-body">
			<table width="100%">
				<tr>
					<td>
						<img src="../image/berita/<?= $berita['gambar']; ?>" width="100%" height="524">
					</td>
				</tr>

				<tr>
					<td>
						<h5><strong>Posting by <?= $berita['nama_admin']; ?> (<?= $berita['level']; ?>) at <?= tanggal_tampil($berita['created_date'])." ".$berita['created_time']." WIB"; ?></strong></h5>
						<br>
						<p><?= $berita['isi_berita']; ?></p>
					</td>
				</tr>

				<tr>
					<td><strong style="font-style:italic;">Views</strong> <i class="fa fa-eye"></i> <?= $berita['views']; ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<?php
	} // Tutup if else
?>