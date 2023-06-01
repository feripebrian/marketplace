<?php

	require 'funct_link_zona.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LINK ZONA
		if( hapus_link_zona($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data link zona di-Hapus.');
					window.location.href='?page=link_zona';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data link zona di-Hapus.');
					window.location.href='?page=link_zona';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_zona';
			</script>
		";
	}