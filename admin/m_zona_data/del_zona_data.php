<?php

	require 'funct_zona_data.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LINK ZONA
		if( hapus_link_zona($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data integritas zona di-Hapus.');
					window.location.href='?page=m_zona_data';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data integritas zona di-Hapus.');
					window.location.href='?page=m_zona_data';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=m_zona_data';
			</script>
		";
	}