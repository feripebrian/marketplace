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

	function format_datepicker($tgl) {
		list($y, $m, $d) = explode('-', $tgl);
		$tanggal = $d."/".$m."/".$y;

		return $tanggal;
	}

	function tanggal_sql($tgl) {
		list($d, $m, $y) = explode('/', $tgl);
		$tanggal = $y."-".$m."-".$d;

		return $tanggal;
	}

	function tanggal_sekarang() {
		date_default_timezone_set('Asia/Jakarta');
		$created_date = date('y-m-d');

		return $created_date;
	}

	function waktu_sekarang() {
		date_default_timezone_set('Asia/Jakarta');
		$created_time = date('G:i');

		return $created_time;
	}