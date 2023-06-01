<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	$pegawai = query("SELECT p.nip, p.nama_pegawai, p.jk, p.kd_jabatan, j.nama_jabatan, p.foto, p.status FROM tb_pegawai p, tb_jabatan j WHERE p.kd_jabatan=j.kd_jabatan ORDER BY p.kd_jabatan ASC");
	$no = 1;
?>

<div class="page-header">
	<h3>MASTER DATA PEGAWAI</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Pegawai</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_pegawai" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data">
		<thead>
			<tr>
				<th class="col-sm-1 text-center">No.</th>
				<th class="col-sm-6 text-center">Pegawai</th>
				<th class="col-sm-2 text-center">Jenis Kelamin</th>
				<th class="col-sm-1 text-center">Status</th>
				<th class="col-sm-2 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $pegawai as $pg ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td class="text-center">
					<?php if( !$pg['foto'] ) : ?>
						<img src="images/no-image.png" width="132" height="152">
					<?php else : ?>
						<img src="../image/pegawai/<?= $pg['foto']; ?>" width="132" height="152">
					<?php endif; ?>
					<br><br>
					<strong style="text-decoration:underline;"><?= $pg['nama_pegawai']; ?></strong>
					<br>
					<?= "NIP. ".$pg['nip']; ?>
				</td>
				<td class="text-center"><?= $pg['jk']; ?></td>
				<td class="text-center">
				<?php
					$status = ($pg['status'] == "1" ? '<a href="#" id="status_pegawai" data-id="'.$pg['nip'].'" class="btn btn-success btn-sm aktif" style="width:100%;">Active</a>' : '<a href="#" id="status_pegawai" data-id="'.$pg['nip'].'" class="btn btn-danger btn-sm nonaktif" style="width:100%;">Non Active</a>');
					echo $status;
				?>
				</td>
				<td class="text-center">
					<a href="?page=edt_pegawai&nip=<?= $pg['nip']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_pegawai&nip=<?= $pg['nip']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $pg['nama_pegawai']; ?>?');"><i class="fa fa-trash-o"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(function(){

		$('.aktif').click(function(){
			let dataId = $(this).data('id');

			$.ajax({
				url: "m_pegawai/status_pegawai.php?status=0",
				type: "POST",
				data: "nip="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=m_pegawai';
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

		$('.nonaktif').click(function(){
			let dataId = $(this).data('id');

			$.ajax({
				url: "m_pegawai/status_pegawai.php?status=1",
				type: "POST",
				data: "nip="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=m_pegawai';
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