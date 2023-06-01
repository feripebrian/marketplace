<?php

	require 'funct_link_maklumat.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LINK MAKLUMAT
		if( hapus_link_maklumat($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data link maklumat di-Hapus.');
					window.location.href='?page=link_maklumat';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data link maklumat di-Hapus.');
					window.location.href='?page=link_maklumat';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_maklumat';
			</script>
		";
	}