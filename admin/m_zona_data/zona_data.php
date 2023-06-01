<?php
	$zona_data= query("SELECT * FROM tb_zona_data ORDER BY nama_data_link ASC");
	$no = 1;
?>

<div class="page-header">
	<h3>MASTER ZONA INTEGRITAS DATA</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Zona Integritas Data</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_zona_data" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data">
		<thead>
			<tr>
				<th class="text-center">No.</th>
				<th class="col-sm-3">Nama Data</th>
				<th class="col-sm-3">Link Dir Data</th>
				<th class="col-sm-2 text-center">Show Item</th>
				<th class="col-sm-2 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $zona_data as $zona_data ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td><?= $zona_data['nama_data_link']; ?></td>
				<td><?= $zona_data['link_dir_data']; ?></td>
				<td class="text-center">
				<?php
					$show_item = ( $zona_data['show_item'] == "Y" ? '<a href="#" id="show_item" data-id="'.$zona_data['id_data_link'].'" class="btn btn-success btn-sm unshow" style="width:100%;"><i class="fa fa-check"></i></a>' : '<a href="#" id="show_item" data-id="'.$zona_data['id_data_link'].'" class="btn btn-warning btn-sm show" style="width:100%;"><i class="fa fa-times"></i></a>');
				echo $show_item;
				?>
				</td>
				<td class="text-center">
					<a href="?page=edt_zona_data&id=<?= $zona_data['id_data_link']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_zona_data&id=<?= $zona_data['id_data_link']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $zona_data['nama_data_link']; ?> ?');"><i class="fa fa-trash-o"></i></a>
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
				url: "m_zona_data/show_zona_data.php?show=Y",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=m_zona_data';
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
				url: "m_zona_data/show_zona_data.php?show=N",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=m_zona_data';
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