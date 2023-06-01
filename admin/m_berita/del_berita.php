<?php

	require 'funct_berita.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA BERITA
		if( hapus_berita($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data berita di-Hapus.');
					window.location.href='?page=m_berita';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data berita di-Hapus.');
					window.location.href='?page=m_berita';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_berita';
			</script>
		";
	}