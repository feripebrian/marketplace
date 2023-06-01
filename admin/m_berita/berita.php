<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	require 'helpers/funct_tanggal.php';

	$berita = query("SELECT * FROM tb_berita ORDER BY created_date DESC, created_time DESC");
	$no = 1;
?>

<div class="page-header">
	<h3>BERITA</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Berita</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_berita" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data">
		<thead>
			<tr>
				<th class="col-sm-1 text-center">No.</th>
				<th class="col-sm-3 text-center">Gambar</th>
				<th class="col-sm-2">Judul Berita</th>
				<th class="col-sm-2">Tgl/Waktu Posting</th>
				<th class="col-sm-1 text-center">Views</th>
				<th class="col-sm-1 text-center">Posting</th>
				<th class="col-sm-2 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $berita as $brt ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td class="text-center"><img src="../image/berita/<?= $brt['gambar']; ?>" width="100%" height="152"></td>
				<td><?= $brt['judul_berita']; ?></td>
				<td>
					<?php
						if( ($brt['created_date'] == "0000-00-00" && $brt['created_time'] == "00:00") )
							echo "<center>-</center>";
						else
							echo tanggal_tampil($brt['created_date'])." ".$brt['created_time']." WIB";
					?>
				</td>
				<td class="text-center"><?= $brt['views']; ?></td>
				<td class="text-center">
				<?php
					$posting = ($brt['show_item'] == "Y" ? '<a href="#" id="posting_berita" data-id="'.$brt['id_berita'].'" class="btn btn-warning btn-sm unposting" style="width:100%;"><i class="fa fa-times"></i></a>' : '<a href="#" id="posting_berita" data-id="'.$brt['id_berita'].'" class="btn btn-success btn-sm posting" style="width:100%;"><i class="fa fa-check"></i></a>');
					echo $posting;
				?>
				</td>
				<td class="text-center">
					<a href="?page=dtl_berita&id=<?= $brt['id_berita']; ?>" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i></a>
					<a href="?page=edt_berita&id=<?= $brt['id_berita']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_berita&id=<?= $brt['id_berita']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $brt['id_berita']; ?>?');"><i class="fa fa-trash-o"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(function(){

		$('.posting').click(function(){
			let dataId = $(this).data('id');

			$.ajax({
				url: "m_berita/posting_berita.php?posting=Y",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=m_berita';
					} else {
						alert(hasil.pesan.gagal);
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					setTimeout(function(){
						alert('Error', "Tolong Cek Koneksi Lalu Ulangi", 'error');
					}, 1000);
				}
			});
		});

		$('.unposting').click(function(){
			let dataId = $(this).data('id');

			$.ajax({
				url: "m_berita/posting_berita.php?posting=N",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=m_berita';
					} else {
						alert(hasil.pesan.gagal);
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					setTimeout(function(){
						alert('Error', "Tolong Cek Koneksi Lalu Ulangi", 'error');
					}, 1000);
				}
			});
		});

	});
</script>