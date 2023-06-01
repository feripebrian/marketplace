<?php

	require 'funct_link_dampak.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LINK DAMPAK
		if( hapus_link_dampak($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data link dampak di-Hapus.');
					window.location.href='?page=link_dampak';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data link dampak di-Hapus.');
					window.location.href='?page=link_dampak';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_dampak';
			</script>
		";
	}