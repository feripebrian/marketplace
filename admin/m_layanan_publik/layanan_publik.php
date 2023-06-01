<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	$layanan_publik = query("SELECT * FROM tb_layanan_publik ORDER BY id_layanan_pblk ASC");
	$no = 1;

?>

<div class="page-header">
	<h3>LAYANAN PUBLIK</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Layanan Publik</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_layananpublik" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data">
		<thead>
			<tr>
				<th class="col-sm-1 text-center">No.</th>
				<th class="col-sm-3 text-center">Gambar</th>
				<th class="col-sm-3">Link URL</th>
				<th class="col-sm-3">Keterangan</th>
				<th class="col-sm-1 text-center">Posting</th>
				<th class="col-sm-1 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $layanan_publik as $lyn_pblk ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td class="text-center"><img src="../image/layanan_publik/<?= $lyn_pblk['gambar']; ?>" width="100%" height="152"></td>
				<td><?= $lyn_pblk['url_layanan_pblk']; ?></td>
				<td><?= $lyn_pblk['ket_layanan_pblk']; ?></td>
				<td class="text-center">
				<?php
					$posting = ($lyn_pblk['show_item'] == "Y" ? '<a href="#" id="posting_layanan_publik" data-id="'.$lyn_pblk['id_layanan_pblk'].'" class="btn btn-warning btn-sm unposting" style="width:100%;"><i class="fa fa-times"></i></a>' : '<a href="#" id="posting_layanan_publik" data-id="'.$lyn_pblk['id_layanan_pblk'].'" class="btn btn-success btn-sm posting" style="width:100%;"><i class="fa fa-check"></i></a>');
					echo $posting;
				?>
				</td>
				<td class="text-center">
					<a href="?page=edt_layananpublik&id=<?= $lyn_pblk['id_layanan_pblk']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_layananpublik&id=<?= $lyn_pblk['id_layanan_pblk']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $lyn_pblk['url_layanan_pblk']; ?>?');"><i class="fa fa-trash-o"></i></a>
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
				url: "m_layanan_publik/posting_layanan_publik.php?posting=Y",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=m_layananpublik';
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

		$('.unposting').click(function(){
			let dataId = $(this).data('id');

			$.ajax({
				url: "m_layanan_publik/posting_layanan_publik.php?posting=N",
				type: "POST",
				data: "id="+dataId,
				success: function(result){
					let hasil = JSON.parse(result);
					// CEK HASIL
					if( hasil.hasil == "sukses" ) {
						alert(hasil.pesan.sukses);
						window.location.href = '?page=m_layananpublik';
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