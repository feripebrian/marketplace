<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	$jabatan = query("SELECT * FROM tb_jabatan ORDER BY kd_jabatan ASC");
	$no = 1;
?>

<div class="page-header">
	<h3>MASTER DATA JABATAN</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Jabatan</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_jabatan" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data-jabatan">
		<thead>
			<tr>
				<th class="col-sm-1 text-center">No.</th>
				<th class="col-sm-7">Nama Jabatan</th>
				<th class="col-sm-4 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $jabatan as $jbtn ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td><?= $jbtn['nama_jabatan']; ?></td>
				<td class="text-center">
					<a href="?page=edt_jabatan&kd=<?= $jbtn['kd_jabatan']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_jabatan&kd=<?= $jbtn['kd_jabatan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $jbtn['nama_jabatan']; ?>?');"><i class="fa fa-trash-o"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>