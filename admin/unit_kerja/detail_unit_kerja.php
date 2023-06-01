<?php
	
	if( !isset($_SESSION['login']) ) {
		header("location:http://localhost/kemenagjaksel/admin");
		exit;
	}

	// CEK APAKAH $_GET['kd'] dan $_GET['nip'] ADA
	if( empty($_GET['kd']) || empty($_GET['nip']) ) {
		echo "
			<script>
				alert('Pilih ata dahulu!')
				window.location.href='http://localhost/kemenagjaksel/admin/?page=unitkerja';
			</script>
		";
	} else {
		$kode = mysqli_real_escape_string($conn, $_GET['kd']);
		$nip  = mysqli_real_escape_string($conn, $_GET['nip']);

		$dtl_unit_kerja = query("SELECT * FROM tb_detail_unit_kerja WHERE kd_unit_kerja='$kode'");
		$jabatan        = query("SELECT p.nip, p.kd_jabatan, j.nama_jabatan FROM tb_pegawai p, tb_jabatan j WHERE p.nip='$nip' AND p.kd_jabatan=j.kd_jabatan")[0];
		$no = 1;
?>

<div class="page-header">
	<h3>DATA DETAIL UNIT KERJA <?= $jabatan['nama_jabatan']; ?></h3>
</div>

<div class="content-data">
	<ol class="breadcrumb">
		<li><a href="?page=home">Home</a></li>
		<li><a href="?page=unitkerja">Unit Kerja</a></li>
		<li class="active">Detail Unit Kerja</li>
	</ol>

	<div class="tambah">
		<a href="?page=add_dtl_unitkerja&kd=<?= $kode; ?>&nip=<?= $nip; ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
	</div>

	<table class="table table-bordered table-striped" id="tabel-data">
		<thead>
			<tr>
				<th class="col-sm-1 text-center">No.</th>
				<th class="col-sm-5">Nama</th>
				<th class="col-sm-4">File</th>
				<th class="col-sm-2 text-center">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php foreach( $dtl_unit_kerja as $dtl_uk ) : ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td><?= $dtl_uk['nama_detail_uk']; ?></td>
				<td>
					<a href="../files/unit_kerja/<?= $dtl_uk['file']; ?>" style="text-decoration: none;" target="_blank"><?= $dtl_uk['file']; ?></a>
				</td>
				<td class="text-center">
					<a href="?page=edt_dtl_unitkerja&no=<?= $dtl_uk['no_detail_uk']; ?>&kd=<?= $kode; ?>&nip=<?= $nip; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
					<a href="?page=del_dtl_unitkerja&no=<?= $dtl_uk['no_detail_uk']; ?>&kd=<?= $kode; ?>&nip=<?= $nip; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin hapus data <?= $dtl_uk['nama_detail_uk']; ?>?');"><i class="fa fa-trash-o"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?php
	} // Tutup if else
?>