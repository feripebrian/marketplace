<?php
	$link_penmad= query("SELECT * FROM tb_penmad_link ORDER BY nama_penmad_link ASC");
	$no = 1;
?>

<div class="page-header">
	<h3>MASTER DATA LINK PENDIDIKAN MADRASAH</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Link Pendidikan Madrasah</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_link_penmad" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data">
		<thead>
			<tr>
				<th class="text-center">No.</th>
				<th class="col-sm-3">Nama Link Pendidikan Madrasah</th>
				<th class="col-sm-3">Link Pendidikan Madrasah</th>
				<th class="col-sm-2 text-center">Show Item</th>
				<th class="col-sm-2 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $link_penmad as $linkpenmad ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td><?= $linkpenmad['nama_penmad_link']; ?></td>
				<td><?= $linkpenmad['link_penmad']; ?></td>
				<td class="text-center">
				<?php
					$show_item = ( $linkpenmad['show_item'] == "Y" ? '<a href="#" id="show_item" data-id="'.$linkpenmad['id_penmad_link'].'" class="btn btn-success btn-sm unshow" style="width:100%;"><i class="fa fa-check"></i></a>' : '<a href="#" id="show_item" data-id="'.$linkpenmad['id_penmad_link'].'" class="btn btn-warning btn-sm show" style="width:100%;"><i class="fa fa-times"></i></a>');
				echo $show_item;
				?>
				</td>
				<td class="text-center">
					<a href="?page=edt_link_penmad&id=<?= $linkpenmad['id_penmad_link']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_link_penmad&id=<?= $linkpenmad['id_penmad_link']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $linkpenmad['nama_penmad_link']; ?> ?');"><i class="fa fa-trash-o"></i></a>
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
				url: "link_penmad/show_link_penmad.php?show=Y",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					// CEK HASIL
					if( result.hasil == "sukses" ) {
						alert(result.pesan.sukses);
						window.location.href = '?page=link_penmad';
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
				url: "link_penmad/show_link_penmad.php?show=N",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					// CEK HASIL
					if( result.hasil == "sukses" ) {
						alert(result.pesan.sukses);
						window.location.href = '?page=link_penmad';
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