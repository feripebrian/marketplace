<?php

	require 'funct_link_pengaduan.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LINK PENGADUAN
		if( hapus_link_pengaduan($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data link pengaduan di-Hapus.');
					window.location.href='?page=link_pengaduan';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data link pengaduan di-Hapus.');
					window.location.href='?page=link_pengaduan';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_pengaduan';
			</script>
		";
	}