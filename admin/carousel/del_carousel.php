<?php

	require 'funct_carousel.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];
		
		// PROSES HAPUS DATA CAROUSEL
		if( hapus_carousel($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data carousel di-Hapus.');
					window.location.href='?page=carousel';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data carousel di-Hapus.');
					window.location.href='?page=carousel';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=carousel';
			</script>
		";
	}