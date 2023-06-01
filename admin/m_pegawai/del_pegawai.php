<?php

	require 'funct_pegawai.php';

	// CEK APAKAH $_GET['nip'] ADA
	if( !empty($_GET['nip']) ) {
		$nip = $_GET['nip'];

		// PROSES HAPUS DATA PEGAWAI
		if( hapus_pegawai($nip) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data pegawai di-Hapus.');
					window.location.href='?page=m_pegawai';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data pegawai di-Hapus.');
					window.location.href='?page=m_pegawai';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_pegawai';
			</script>
		";
	}