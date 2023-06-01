<?php

	require 'funct_link_survey.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LINK SURVEY
		if( hapus_link_survey($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data link survey di-Hapus.');
					window.location.href='?page=link_survey';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data link survey di-Hapus.');
					window.location.href='?page=link_survey';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_survey';
			</script>
		";
	}