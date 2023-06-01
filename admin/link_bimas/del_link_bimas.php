<?php

	require 'funct_link_bimas.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LINK bimas
		if( hapus_link_bimas($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data link bimas di-Hapus.');
					window.location.href='?page=link_bimas';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data link bimas di-Hapus.');
					window.location.href='?page=link_bimas';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_bimas';
			</script>
		";
	}