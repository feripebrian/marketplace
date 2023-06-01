<?php

	require 'funct_link_pontren.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LINK pontren
		if( hapus_link_pontren($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data link pontren di-Hapus.');
					window.location.href='?page=link_pontren';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data link pontren di-Hapus.');
					window.location.href='?page=link_pontren';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_pontren';
			</script>
		";
	}