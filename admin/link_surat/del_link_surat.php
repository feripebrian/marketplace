<?php

	require 'funct_link_surat.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LINK surat
		if( hapus_link_surat($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data link surat di-Hapus.');
					window.location.href='?page=link_surat';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data link surat di-Hapus.');
					window.location.href='?page=link_surat';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_surat';
			</script>
		";
	}