<?php

	require 'funct_masa_kepala_kantor.php';

	// CEK APAKAH $_GET['nip'] ADA
	if( !empty($_GET['nip']) ) {
		$nip = $_GET['nip'];

		// PROSES HAPUS DATA MASA KEPALA KANTOR
		if( hapus_masa_kpl($nip) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data kepala kantor di-Hapus.');
					window.location.href='?page=m_masa_kpl';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data kepala kantor di-Hapus.');
					window.location.href='?page=m_masa_kpl';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_masa_kpl';
			</script>
		";
	}