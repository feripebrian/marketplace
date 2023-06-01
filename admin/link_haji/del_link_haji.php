<?php

	require 'funct_link_haji.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LINK haji
		if( hapus_link_haji($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data link haji di-Hapus.');
					window.location.href='?page=link_haji';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data link haji di-Hapus.');
					window.location.href='?page=link_haji';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_haji';
			</script>
		";
	}