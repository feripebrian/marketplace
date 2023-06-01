<?php
	$zona = query("SELECT * FROM tb_zona ORDER BY nama_zona ASC");
	$no = 1;
?>

<div class="page-header">
	<h3>MASTER DATA ZONA</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Zona</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_zona" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data-zona">
		<thead>
			<tr>
				<th class="col-sm-1 text-center">No.</th>
				<th class="col-sm-7">Nama Zona</th>
				<th class="col-sm-4 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $zona as $dir ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td><?= $dir['nama_zona']; ?></td>
				<td class="text-center">
					<a href="?page=edt_zona&id=<?= $dir['id_zona']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_zona&id=<?= $dir['id_zona']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $dir['nama_zona']; ?>?');"><i class="fa fa-trash-o"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>