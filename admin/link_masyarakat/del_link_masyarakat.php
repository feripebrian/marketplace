<?php

	require 'funct_link_masyarakat.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LINK MASYARAKAT
		if( hapus_link_masyarakat($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data link masyarakat di-Hapus.');
					window.location.href='?page=link_masyarakat';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data link masyarakat di-Hapus.');
					window.location.href='?page=link_masyarakat';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_masyarakat';
			</script>
		";
	}