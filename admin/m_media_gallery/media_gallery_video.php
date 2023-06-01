<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	require 'helpers/funct_tanggal.php';

	$media_gallery = query("SELECT * FROM tb_media_gallery WHERE kategori_medgall='VIDEO' ORDER BY created_date DESC, created_time DESC");
	$no = 1;
?>

<div class="page-header">
	<h3>MEDIA GALLERY VIDEO</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Media Gallery Video</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_medgall_video" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data">
		<thead>
			<tr>
				<th class="col-sm-1 text-center">No.</th>
				<th class="col-sm-5 text-center">Video</th>
				<th class="col-sm-3">Waktu/Tgl. Posting</th>
				<th class="col-sm-1 text-center">Posting</th>
				<th class="col-sm-2 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $media_gallery as $medgall ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td class="text-center">
					<video width="100%" height="240" controls="controls">
						<source src="../media_gallery/video/<?= $medgall['nama_file_medgall']; ?>" type="video/mp4">
						Your browser does not support the video tag.
					</video>
					<br>
					<?= $medgall['judul']; ?>
				</td>
				<td>
					<?php
						if( $medgall['created_date'] == "0000-00-00" && $medgall['created_time'] == "00:00" )
							echo "<center>-</center>";
						else
							echo tanggal_tampil($medgall['created_date'])." ".$medgall['created_time']." WIB";
					?>
				</td>
				<td class="text-center">
				<?php
					$posting = ($medgall['show_item'] == "Y" ? '<a href="#" id="posting_medgall_video" data-id="'.$medgall['id_medgall'].'" class="btn btn-warning btn-sm unposting" style="width:100%;"><i class="fa fa-times"></i></a>' : '<a href="#" id="posting_medgall_video" data-id="'.$medgall['id_medgall'].'" class="btn btn-success btn-sm posting" style="width:100%;"><i class="fa fa-check"></i></a>');
					echo $posting;
				?>
				</td>
				<td class="text-center">
					<a href="?page=edt_medgall_video&id=<?= $medgall['id_medgall']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_medgall_video&id=<?= $medgall['id_medgall']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $medgall['judul']; ?> ?');"><i class="fa fa-trash-o"></i></a>
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
				url: "m_media_gallery/posting_medgall_video.php?posting=Y",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "not posting" ) {
						alert(hasil.pesan.notposting);
						window.location.href = '?page=m_medgall_video';
					} else if( hasil.hasil == "gagal" ) {
						console.log(hasil.pesan.gagal);
					} else if( hasil.hasil == "sukses" ) {
						console.log(hasil.pesan.sukses);
						window.location.href = '?page=m_medgall_video';
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
				url: "m_media_gallery/posting_medgall_video.php?posting=N",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "gagal" ) {
						console.log(hasil.pesan.gagal);
					} else if( hasil.hasil == "sukses" ) {
						console.log(hasil.pesan.sukses);
						window.location.href = '?page=m_medgall_video';
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