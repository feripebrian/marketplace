<?php

	require 'funct_detail_unit_kerja.php';

	// CEK APAKAH $_GET['no']/$_GET['kd']/$_GET['nip'] ADA
	if( !empty($_GET['no']) || empty($_GET['kd']) || empty($_GET['nip']) ) {
		$no   = $_GET['no'];
		$kode = $_GET['kd'];
		$nip  = $_GET['nip'];

		// PROSES HAPUS DATA DETAIL UNIT KERJA
		if( hapus_detail_unit_kerja($no) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data detail unit kerja di-Hapus.');
					window.location.href='?page=dtl_unitkerja&kd=$kode&nip=$nip';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data detail unit kerja di-Hapus.');
					window.location.href='?page=dtl_unitkerja&kd=$kode&nip=$nip';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=unitkerja';
			</script>
		";
	}