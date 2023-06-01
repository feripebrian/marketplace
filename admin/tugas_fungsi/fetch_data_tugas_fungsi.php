<?php
	
	require '../../config/koneksi.php';
	require '../helpers/funct_query.php';

	if( !empty($_POST['nip']) ) {
		$nip  = mysqli_real_escape_string($conn, $_POST['nip']);

		$pegawai      = query("SELECT nip, nama_pegawai, foto FROM tb_pegawai WHERE nip='$nip'")[0];
		$data_pegawai = count($pegawai);

		if( $data_pegawai > 0 ) {
			$hasil['hasil'] = "sukses";
		} else {
			$hasil['hasil'] = "gagal";
		}

		if( $hasil['hasil'] == "sukses" ) {
			$hasil['pegawai']['nip']  = $pegawai['nip'];
			$hasil['pegawai']['nama'] = $pegawai['nama_pegawai'];
			$hasil['pegawai']['foto'] = $pegawai['foto'];
		} else {
			$hasil['pesan']['gagal'] = "Data tidak di-Temukan.";
		}

		echo json_encode($hasil);
	} else {
		$hasil['hasil'] = "gagal";
		echo json_encode($hasil);
	}