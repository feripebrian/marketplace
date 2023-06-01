<?php
	
	require '../../config/koneksi.php';
	require '../helpers/funct_query.php';

	if( !empty($_POST['nip']) ) {
		$nip = mysqli_real_escape_string($conn, $_POST['nip']);

		$cek_pegawai = query("SELECT COUNT(nip) AS jml_pegawai FROM tb_pegawai WHERE nip='$nip'")[0];

		if( $cek_pegawai['jml_pegawai'] == 1 ) {
			$pegawai = query("SELECT nip, nama_pegawai, foto FROM tb_pegawai WHERE nip='$nip'")[0];

			$data['hasil'] = "sukses";
			$data['nip']   = $pegawai['nip'];
			$data['nama']  = $pegawai['nama_pegawai'];
			$data['foto']  = $pegawai['foto'];
		} else {
			$data['hasil'] = "gagal";
			$data['pesan']['gagal'] = "Tidak ada data kepala kantor.";
		}

		echo json_encode($data);
	} else {
		$data['hasil'] = "gagal";
		$data['pesan']['gagal'] = "Tidak ada data kepala kantor.";
		echo json_encode($data);
	}