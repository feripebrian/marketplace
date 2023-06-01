<?php
	$direktori = query("SELECT * FROM tb_direktori ORDER BY nama_direktori ASC");
	$no = 1;
?>

<div class="page-header">
	<h3>MASTER DATA DIREKTORI</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Direktori</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_direktori" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data-direktori">
		<thead>
			<tr>
				<th class="col-sm-1 text-center">No.</th>
				<th class="col-sm-7">Nama Direktori</th>
				<th class="col-sm-4 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $direktori as $dir ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td><?= $dir['nama_direktori']; ?></td>
				<td class="text-center">
					<a href="?page=edt_direktori&id=<?= $dir['id_direktori']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_direktori&id=<?= $dir['id_direktori']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $dir['nama_direktori']; ?>?');"><i class="fa fa-trash-o"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>