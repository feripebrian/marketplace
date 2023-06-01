<?php

	require 'funct_link_inovasi.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LINK INOVASI
		if( hapus_link_inovasi($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data link inovasi di-Hapus.');
					window.location.href='?page=link_inovasi';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data link inovasi di-Hapus.');
					window.location.href='?page=link_inovasi';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_inovasi';
			</script>
		";
	}