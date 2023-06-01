<?php
	$link_pontren= query("SELECT * FROM tb_pontren_link ORDER BY nama_pontren_link ASC");
	$no = 1;
?>

<div class="page-header">
	<h3>MASTER DATA LINK PONTREN</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Link Pontren</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_link_pontren" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data">
		<thead>
			<tr>
				<th class="text-center">No.</th>
				<th class="col-sm-3">Nama Link Pontren</th>
				<th class="col-sm-3">Link Pontren</th>
				<th class="col-sm-2 text-center">Show Item</th>
				<th class="col-sm-2 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $link_pontren as $linkpontren ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td><?= $linkpontren['nama_pontren_link']; ?></td>
				<td><?= $linkpontren['link_pontren']; ?></td>
				<td class="text-center">
				<?php
					$show_item = ( $linkpontren['show_item'] == "Y" ? '<a href="#" id="show_item" data-id="'.$linkpontren['id_pontren_link'].'" class="btn btn-success btn-sm unshow" style="width:100%;"><i class="fa fa-check"></i></a>' : '<a href="#" id="show_item" data-id="'.$linkpontren['id_pontren_link'].'" class="btn btn-warning btn-sm show" style="width:100%;"><i class="fa fa-times"></i></a>');
				echo $show_item;
				?>
				</td>
				<td class="text-center">
					<a href="?page=edt_link_pontren&id=<?= $linkpontren['id_pontren_link']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_link_pontren&id=<?= $linkpontren['id_pontren_link']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $linkpontren['nama_pontren_link']; ?> ?');"><i class="fa fa-trash-o"></i></a>
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
				url: "link_pontren/show_link_pontren.php?show=Y",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					// CEK HASIL
					if( result.hasil == "sukses" ) {
						alert(result.pesan.sukses);
						window.location.href = '?page=link_pontren';
					} else {
						alert(result.pesan.gagal);
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
				url: "link_pontren/show_link_pontren.php?show=N",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					// CEK HASIL
					if( result.hasil == "sukses" ) {
						alert(result.pesan.sukses);
						window.location.href = '?page=link_pontren';
					} else {
						alert(result.pesan.gagal);
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