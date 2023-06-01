<?php

	require 'funct_layanan_publik.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LAYANAN PUBLIK
		if( hapus_layanan_publik($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data layanan publik di-Hapus.');
					window.location.href='?page=m_layananpublik';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data layanan publik di-Hapus.');
					window.location.href='?page=m_layananpublik';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_layananpublik';
			</script>
		";
	}