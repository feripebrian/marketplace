<?php

	function tanggal_tampil($tgl) {
		if( $tgl == "0000-00-00" ) {
			return false;
		}

		list($y, $m, $d) = explode('-', $tgl);
		$bulan = (int) $m;
		$bulan_terbilang = [
			1 => "Jan",
			2 => "Feb",
			3 => "Mar",
			4 => "Apr",
			5 => "Mei",
			6 => "Jun",
			7 => "Jul",
			8 => "Agu",
			9 => "Sept",
			10 => "Okt",
			11 => "Nov",
			12 => "Des",
		];

		$tanggal = $d." ".$bulan_terbilang[$bulan]." ".$y;

		return $tanggal;
	}