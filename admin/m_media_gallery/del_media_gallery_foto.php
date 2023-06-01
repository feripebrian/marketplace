<?php

	require 'funct_media_gallery.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA MEDIA GALLERY FOTO
		if( hapus_media_foto($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data foto di-Hapus.');
					window.location.href='?page=m_medgall_foto';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data foto di-Hapus.');
					window.location.href='?page=m_medgall_foto';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_medgall_foto';
			</script>
		";
	}