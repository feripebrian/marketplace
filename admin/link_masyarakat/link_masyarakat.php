<?php
	$link_masyarakat= query("SELECT * FROM tb_masyarakat_link ORDER BY nama_masyarakat_link ASC");
	$no = 1;
?>

<div class="page-header">
	<h3>MASTER DATA LINK MASYARAKAT</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Link Masyarakat</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_link_masyarakat" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data">
		<thead>
			<tr>
				<th class="text-center">No.</th>
				<th class="col-sm-3">Nama Link Masyarakat</th>
				<th class="col-sm-3">Link Dir Masyarakat</th>
				<th class="col-sm-2 text-center">Show Item</th>
				<th class="col-sm-2 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $link_masyarakat as $linkmasyarakat ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td><?= $linkmasyarakat['nama_masyarakat_link']; ?></td>
				<td><?= $linkmasyarakat['link_dir_masyarakat']; ?></td>
				<td class="text-center">
				<?php
					$show_item = ( $linkmasyarakat['show_item'] == "Y" ? '<a href="#" id="show_item" data-id="'.$linkmasyarakat['id_masyarakat_link'].'" class="btn btn-success btn-sm unshow" style="width:100%;"><i class="fa fa-check"></i></a>' : '<a href="#" id="show_item" data-id="'.$linkmasyarakat['id_masyarakat_link'].'" class="btn btn-warning btn-sm show" style="width:100%;"><i class="fa fa-times"></i></a>');
				echo $show_item;
				?>
				</td>
				<td class="text-center">
					<a href="?page=edt_link_masyarakat&id=<?= $linkmasyarakat['id_masyarakat_link']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_link_masyarakat&id=<?= $linkmasyarakat['id_masyarakat_link']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $linkmasyarakat['nama_masyarakat_link']; ?> ?');"><i class="fa fa-trash-o"></i></a>
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
				url: "link_masyarakat/show_link_masyarakat.php?show=Y",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					// CEK HASIL
					if( result.hasil == "sukses" ) {
						alert(result.pesan.sukses);
						window.location.href = '?page=link_masyarakat';
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
				url: "link_masyarakat/show_link_masyarakat.php?show=N",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					// CEK HASIL
					if( result.hasil == "sukses" ) {
						alert(result.pesan.sukses);
						window.location.href = '?page=link_masyarakat';
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