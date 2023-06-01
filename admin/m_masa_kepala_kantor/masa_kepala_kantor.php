<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}
	
	require 'helpers/funct_tanggal.php';

	$kepala_kantor = query("SELECT m.nip_kpl_kantor, p.nama_pegawai, m.periode_dari, m.periode_sampai, p.kd_jabatan, j.nama_jabatan, p.foto, m.show_item FROM tb_masa_kepala_kantor m, tb_pegawai p, tb_jabatan j WHERE m.nip_kpl_kantor=p.nip AND p.kd_jabatan=j.kd_jabatan AND j.nama_jabatan='KEPALA KANTOR' ORDER BY p.nama_pegawai ASC");
	$no = 1;
?>

<div class="page-header">
	<h3>MASTER DATA MASA KEPALA KANTOR</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Masa Kepala Kantor</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_masa_kpl" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data">
		<thead>
			<tr>
				<th class="col-sm-1 text-center">No.</th>
				<th class="col-sm-4 text-center">Kepala Kantor</th>
				<th class="col-sm-4">Periode</th>
				<th class="col-sm-1 text-center">Show Item</th>
				<th class="col-sm-2 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $kepala_kantor as $kpl ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td class="text-center">
					<img src="../image/pegawai/<?= $kpl['foto']; ?>" width="132" height="152">
					<br>
					<br>
					<strong style="text-decoration:underline"><?= $kpl['nama_pegawai']; ?></strong>
					<br>
					NIP. <?= $kpl['nip_kpl_kantor']; ?>
				</td>
				<td>
					<?php
						if( ($kpl['periode_dari'] != "0000-00-00" && $kpl['periode_sampai'] != "0000-00-00") ) {
							echo tanggal_tampil($kpl['periode_dari'])." s/d ".tanggal_tampil($kpl['periode_sampai']);
						} else {
							echo "<center>-</center>";
						}
					?>
				</td>
				<td class="text-center">
				<?php
					$show_item = ($kpl['show_item'] == "Y" ? '<a href="#" id="show_masa_kpl" data-id="'.$kpl['nip_kpl_kantor'].'" class="btn btn-warning btn-sm unshow" style="width:100%;"><i class="fa fa-times"></i></a>' : '<a href="#" id="show_masa_kpl" data-id="'.$kpl['nip_kpl_kantor'].'" class="btn btn-success btn-sm show" style="width:100%;"><i class="fa fa-check"></i></a>');
					echo $show_item;
				?>
				</td>
				<td class="text-center">
					<a href="?page=edt_masa_kpl&nip=<?= $kpl['nip_kpl_kantor']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_masa_kpl&nip=<?= $kpl['nip_kpl_kantor']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $kpl['nama_pegawai']; ?>?');"><i class="fa fa-trash-o"></i></a>
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
				url: "m_masa_kepala_kantor/show_masa_kpl.php?show=Y",
				type: "POST",
				data: "nip="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=m_masa_kpl';
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
				url: "m_masa_kepala_kantor/show_masa_kpl.php?show=N",
				type: "POST",
				data: "nip="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=m_masa_kpl';
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