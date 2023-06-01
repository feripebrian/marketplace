<?php

	require 'funct_jabatan.php';

	// CEK APAKAH $_GET['kd'] ADA
	if( !empty($_GET['kd']) ) {
		$kode = $_GET['kd'];

		// PROSES HAPUS DATA JABATAN
		if( hapus_jabatan($kode) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data jabatan di-Hapus.');
					window.location.href='?page=m_jabatan';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data jabatan di-Hapus.');
					window.location.href='?page=m_jabatan';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_jabatan';
			</script>
		";
	}