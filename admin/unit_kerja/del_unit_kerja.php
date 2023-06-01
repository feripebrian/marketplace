<?php

	require 'funct_unit_kerja.php';

	// CEK APAKAH $_GET['kd'] ADA
	if( !empty($_GET['kd']) ) {
		$kd = $_GET['kd'];

		// PROSES HAPUS DATA UNIT KERJA
		if( hapus_unit_kerja($kd) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data unit kerja di-Hapus.');
					window.location.href='?page=unitkerja';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data unit kerja di-Hapus.');
					window.location.href='?page=unitkerja';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=unitkerja';
			</script>
		";
	}