<?php

	require 'funct_media_gallery.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA MEDIA GALLERY VIDEO
		if( hapus_media_video($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data video di-Hapus.');
					window.location.href='?page=m_medgall_video';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data video di-Hapus.');
					window.location.href='?page=m_medgall_video';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_medgall_video';
			</script>
		";
	}