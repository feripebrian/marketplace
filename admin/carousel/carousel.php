<?php

	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	$carousel = query("SELECT * FROM tb_carousel ORDER BY id_carousel ASC");
	$no = 1;

?>

<div class="page-header">
	<h3>CAROUSEL</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Carousel</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_carousel" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data">
		<thead>
			<tr>
				<th class="col-sm-1 text-center">No.</th>
				<th class="col-sm-4 text-center">Gambar</th>
				<th class="col-sm-4">Keterangan</th>
				<th class="col-sm-1 text-center">Posting</th>
				<th class="col-sm-2 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $carousel as $crsl ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td class="text-center"><img src="../image/carousel/<?= $crsl['gambar']; ?>" width="100%" height="220"></td>
				<td><?= $crsl['ket_carousel']; ?></td>
				<td class="text-center">
				<?php
					$posting = ($crsl['show_item'] == "Y" ? '<a href="#" id="posting_carousel" data-id="'.$crsl['id_carousel'].'" class="btn btn-warning btn-sm unposting" style="width:100%;"><i class="fa fa-times"></i></a>' : '<a href="#" id="posting_carousel" data-id="'.$crsl['id_carousel'].'" class="btn btn-success btn-sm posting" style="width:100%;"><i class="fa fa-check"></i></a>');
					echo $posting;
				?>
				</td>
				<td class="text-center">
					<a href="?page=edt_carousel&id=<?= $crsl['id_carousel']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_carousel&id=<?= $crsl['id_carousel']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $crsl['ket_carousel']; ?>?');"><i class="fa fa-trash-o"></i></a>
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
				url: "carousel/posting_carousel.php?posting=Y",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "not posting" ) {
						alert(hasil.pesan.notposting);
						window.location.href = '?page=carousel';
					} else if( hasil.hasil == "gagal" ) {
						alert(hasil.pesan.gagal);
					} else if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=carousel';
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
				url: "carousel/posting_carousel.php?posting=N",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=carousel';
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