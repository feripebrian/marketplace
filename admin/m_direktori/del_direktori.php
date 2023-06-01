<?php

	require 'funct_direktori.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA DIREKTORI
		if( hapus_direktori($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data direktori di-Hapus.');
					window.location.href='?page=m_direktori';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data direktori di-Hapus.');
					window.location.href='?page=m_direktori';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_direktori';
			</script>
		";
	}