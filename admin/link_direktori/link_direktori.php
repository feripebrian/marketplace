<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	$link_direktori = query("SELECT link.id_dir_link, link.id_direktori, link.nama_dir_link, link.link_dir_link, link.show_item FROM tb_direktori_link link, tb_direktori dir WHERE link.id_direktori=dir.id_direktori ORDER BY link.nama_dir_link ASC");
	$no = 1;

?>

<div class="page-header">
	<h3>MASTER DATA LINK DIREKTORI</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Link Direktori</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_link_direktori" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data">
		<thead>
			<tr>
				<th class="col-sm-1 text-center">No.</th>
				<th class="col-sm-3">Nama Link Direktori</th>
				<th class="col-sm-2">ID Direktori</th>
				<th class="col-sm-3">Link Direktori</th>
				<th class="col-sm-1 text-center">Show Item</th>
				<th class="col-sm-2 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $link_direktori as $linkdir ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td><?= $linkdir['nama_dir_link']; ?></td>
				<td><?= $linkdir['id_direktori']; ?></td>
				<td><?= $linkdir['link_dir_link']; ?></td>
				<td class="text-center">
				<?php
					$show_item = ( $linkdir['show_item'] == "Y" ? '<a href="#" id="show_item" data-id="'.$linkdir['id_dir_link'].'" class="btn btn-warning btn-sm unshow" style="width:100%;"><i class="fa fa-times"></i></a>' : '<a href="#" id="show_item" data-id="'.$linkdir['id_dir_link'].'" class="btn btn-success btn-sm show" style="width:100%;"><i class="fa fa-check"></i></a>');
				echo $show_item;
				?>
				</td>
				<td class="text-center">
					<a href="?page=edt_link_direktori&id=<?= $linkdir['id_dir_link']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_link_direktori&id=<?= $linkdir['id_dir_link']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $linkdir['nama_dir_link']; ?> ?');"><i class="fa fa-trash-o"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(function(){
		
		$('.show').click(function(){
			let dataId = $(this).data('id');

			$.ajax({
				url: "link_direktori/show_link_direktori.php?show=Y",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=link_direktori';
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

		$('.unshow').click(function(){
			let dataId = $(this).data('id');

			$.ajax({
				url: "link_direktori/show_link_direktori.php?show=N",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=link_direktori';
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