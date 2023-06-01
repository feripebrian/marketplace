<?php

	require 'funct_admin.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA DIREKTORI
		if( hapus_admin($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data admin di-Hapus.');
					window.location.href='?page=m_admin';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data admin di-Hapus.');
					window.location.href='?page=m_admin';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_admin';
			</script>
		";
	}