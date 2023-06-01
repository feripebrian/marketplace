<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	$unit_kerja = query("SELECT uk.kd_unit_kerja, uk.nip, pg.nama_pegawai, pg.kd_jabatan, jb.nama_jabatan, pg.foto, uk.deskripsi, uk.show_item FROM tb_unit_kerja uk, tb_pegawai pg, tb_jabatan jb WHERE uk.nip=pg.nip AND pg.kd_jabatan=jb.kd_jabatan ORDER BY pg.kd_jabatan ASC");
	$no = 1;
?>

<div class="page-header">
	<h3>UNIT KERJA</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Unit Kerja</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_unitkerja" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data">
		<thead>
			<tr>
				<th class="col-sm-1 text-center">No.</th>
				<th class="col-sm-3 text-center">Pegawai</th>
				<th class="col-sm-2">Jabatan</th>
				<th class="col-sm-3">Deskripsi</th>
				<th class="col-sm-1 text-center">Show Item</th>
				<th class="col-sm-2 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $unit_kerja as $uk ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td class="text-center">
					<img src="../image/pegawai/<?= $uk['foto']; ?>" width="128" height="128">
					<br>
					<br>
					<a href="?page=dtl_unitkerja&kd=<?= $uk['kd_unit_kerja']; ?>&nip=<?= $uk['nip']; ?>" class="detail-unit-kerja">
						<strong style="text-decoration:underline"><?= $uk['nama_pegawai']; ?></strong>
						<br>
						NIP. <?= $uk['nip']; ?>
					</a>
				</td>
				<td><?= $uk['nama_jabatan']; ?></td>
				<td><?= $uk['deskripsi']; ?></td>
				<td class="text-center">
				<?php
					$show = ($uk['show_item'] == "Y" ? '<a href="#" id="show_unit_kerja" data-id="'.$uk['kd_unit_kerja'].'" class="btn btn-warning btn-sm unshow" style="width:100%;"><i class="fa fa-times"></i></a>' : '<a href="#" id="show_unit_kerja" data-id="'.$uk['kd_unit_kerja'].'" class="btn btn-success btn-sm show" style="width:100%;"><i class="fa fa-check"></i></a>');
					echo $show;
				?>
				</td>
				<td class="text-center">
					<a href="?page=edt_unitkerja&kd=<?= $uk['kd_unit_kerja']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_unitkerja&kd=<?= $uk['kd_unit_kerja']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $uk['nama_jabatan']; ?>?');"><i class="fa fa-trash-o"></i></a>
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
				url: "unit_kerja/show_unit_kerja.php?show=Y",
				type: "POST",
				data: "kd="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "gagal" ) {
						alert(hasil.pesan.gagal);
					} else if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=unitkerja';
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
				url: "unit_kerja/show_unit_kerja.php?show=N",
				type: "POST",
				data: "kd="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "gagal" ) {
						alert(hasil.pesan.gagal);
					} else if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=unitkerja';
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