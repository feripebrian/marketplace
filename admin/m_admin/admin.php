<?php
	
	$superadmin = query("SELECT * FROM tb_admin WHERE level='Superadmin' ORDER BY nama_admin ASC");
	$no_superadmin = 1;
	$admin = query("SELECT * FROM tb_admin WHERE level='Admin' ORDER BY nama_admin ASC");
	$no_admin = 1;

?>

<div class="page-header">
	<h3>MASTER DATA ADMIN</h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li class="active">Admin</li>
	</ol>

	<br>

	<table class="table table-condensed">
		<thead>
			<tr>
				<th colspan="3">Superadmin</th>
			</tr>
			<tr>
				<th class="col-sm-2 text-center">No.</th>
				<th class="col-sm-5">Nama Admin</th>
				<th class="col-sm-5">Username</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $superadmin as $superadm ) : ?>
			<tr class="<?php if( $_SESSION['id_admin'] == $superadm['id_admin'] ) echo "active info"; ?>">
				<td class="text-center"><?= $no_superadmin++; ?></td>
				<td><?= $superadm['nama_admin']; ?></td>
				<td><?= $superadm['username']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<div class="tambah">
		<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-admin"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data">
		<thead>
			<tr>
				<th class="col-sm-1 text-center">No.</th>
				<th class="col-sm-4">Nama Admin</th>
				<th class="col-sm-4">Username</th>
				<th class="col-sm-2">Status</th>
				<th class="col-sm-1 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $admin as $adm ) : ?>
			<tr>
				<td class="text-center"><?= $no_admin++; ?></td>
				<td><?= $adm['nama_admin']; ?></td>
				<td><?= $adm['username']; ?></td>
				<td>
					<?php
						$status = ( $adm['status'] == "1" ? '<a href="#" id="status_admin" data-id="'.$adm['id_admin'].'" class="btn btn-success btn-sm aktif" style="width:100%;">Active</a>' : '<a href="#" id="status_admin" data-id="'.$adm['id_admin'].'" class="btn btn-danger btn-sm nonaktif" style="width:100%;">Non Active</a>');
						echo $status;
					?>
				</td>
				<td class="text-center">
					<a href="?page=del_admin&id=<?= $adm['id_admin']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $adm['nama_admin']; ?>?');"><i class="fa fa-trash-o"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-tambah-admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Data Admin</h4>
			</div>
			
			<form action="" class="form-horizontal form-input" id="form-tambah-admin">
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_admin" class="col-sm-4 control-label">Nama Admin</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="nama_admin" id="nama_admin" placeholder="Masukkan Nama Admin" required autofocus>

							<p class="text-muted pesan-text"></p>
						</div>
					</div>

					<div class="form-group">
						<label for="username_admin" class="col-sm-4 control-label">Username</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="username_admin" id="username_admin" placeholder="Masukkan Username Admin" required>

							<p class="text-muted pesan-text"></p>
						</div>
					</div>

					<div class="form-group">
						<label for="password_admin" class="col-sm-4 control-label">Password</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="password_admin" id="password_admin" placeholder="Masukkan Password Admin" required>

							<p class="text-muted pesan-text"></p>
						</div>
					</div>

					<div class="form-group">
						<label for="password_confirmation_admin" class="col-sm-4 control-label">Konfirmasi Password</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="password_confirmation_admin" id="password_confirmation_admin" placeholder="Masukkan Konfirmasi Password Admin" required>

							<p class="text-muted pesan-text"></p>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
					<button type="submit" class="btn btn-primary" name="btn-simpan-admin" id="btn-simpan-admin"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="../assets/js/form_validation/form_validation_admin.js"></script>