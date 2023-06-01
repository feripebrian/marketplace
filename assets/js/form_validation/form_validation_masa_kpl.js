$(document).ready(function(){

	let aksi = "";

	$('#form-masa-kpl').find('#periode_dari, #periode_sampai').datepicker({
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true
	});

	set_clear_invalid_input_all($('#form-masa-kpl'));

	$('#form-masa-kpl').find('#kepala_kantor').change(function(){
		let nip   = $(this).val();
		let pesan = '';

		$.ajax({
			url: "m_masa_kepala_kantor/cek_kepala_kantor.php",
			type: "POST",
			data: "nip="+nip,
			success: function(result){
				let hasil = JSON.parse(result);
				// // CEK HASIL
				if( hasil.hasil == "gagal" ) {
					pesan = hasil.pesan.gagal;

					return get_invalid_input(pesan, $('#form-masa-kpl').find('#kepala_kantor'));
				} else {
					$('#form-masa-kpl').find('img').attr('src', '');
					$('#form-masa-kpl').find('img').attr('src', '../image/pegawai/'+hasil.foto);
					// TAMPILKAN NIP PEGAWAI
					$('#form-masa-kpl').find('img').parent().find('strong').text('');
					$('#form-masa-kpl').find('img').parent().find('strong').text(hasil.nama);
					// TAMPILKAN NAMA PEGAWAI
					$('#form-masa-kpl').find('img').parent().find('span#nip').text('');
					$('#form-masa-kpl').find('img').parent().find('span#nip').text('NIP. '+hasil.nip);
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				setTimeout(function(){
					alert('Error', "Tolong Cek Koneksi Lalu Ulangi", 'error');
				}, 1000);
			}
		});
	});

	$('#form-masa-kpl').find('button#simpan-masa-kpl').click(function(){
		aksi = "simpan";
	});
	$('#form-masa-kpl').find('button#ubah-masa-kpl').click(function(){
		aksi = "ubah";
	});

	$('#form-masa-kpl').submit(function(evt){
		evt.preventDefault();
		let valid = true;
		let pesan = '';
		let dataForm = $(this).serialize();

		set_clear_invalid_input_all($('#form-masa-kpl'));

		$('#form-masa-kpl').find('select, input').each(function(){
			if( !$(this).val() ) {
				valid = false;
				pesan = 'Mohon dilengkapi.';

				return get_invalid_input(pesan, this);
			}

			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		// VALIDASI TANGGAL periode_dari
		$('#form-masa-kpl').find('#periode_dari').each(function(){
			let periode_dari = $(this).val();
			let len          = periode_dari.length;

			if( len>0 ) {
				if( !valid_tanggal(periode_dari) ) {
					valid = false;
					pesan = 'Format tanggal harus dd/mm/yy (ex: 08/08/2001)';

					return get_invalid_input(pesan, this);
				} else {
					if( len>10 ) {
						valid = false;
						pesan = 'Tanggal maksimal 10 karakter';

						return get_invalid_input(pesan, this);
					}
				}
			}
		});

		// VALIDASI TANGGAL periode_sampai
		$('#form-masa-kpl').find('#periode_sampai').each(function(){
			let periode_sampai = $(this).val();
			let len            = periode_sampai.length;

			if( len>0 ) {
				if( !valid_tanggal(periode_sampai) ) {
					valid = false;
					pesan = 'Format tanggal harus dd/mm/yy (ex: 08/08/2001)';

					return get_invalid_input(pesan, this);
				} else {
					if( len>10 ) {
						valid = false;
						pesan = 'Tanggal maksimal 10 karakter';

						return get_invalid_input(pesan, this);
					}
				}
			}
		});

		if( valid === true ) {
			if( aksi == "simpan" ) {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "m_masa_kepala_kantor/aksi_masa_kepala_kantor.php?masakpl=tambah",
					data: dataForm,
					cache: false,
					processData:false,
					success: function(result){
						let hasil = JSON.parse(result);
						// CEK HASIL
						if( hasil.hasil == "duplicate nip" ) {
							pesan = hasil.pesan.duplicate;

							return get_invalid_input(pesan, $('#form-masa-kpl').find('#kepala_kantor'));
						} else if( hasil.hasil == "gagal" ) {
							alert(hasil.pesan.gagal);
						} else if( hasil.hasil == "sukses" ) {
							alert(hasil.pesan.sukses);
							window.location.href = '?page=m_masa_kpl';
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {
						setTimeout(function(){
							alert('Error', "Tolong Cek Koneksi Lalu Ulangi", 'error');
						}, 1000);
					}
				});
			} else {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "m_masa_kepala_kantor/aksi_masa_kepala_kantor.php?masakpl=ubah",
					data: dataForm,
					cache: false,
					processData:false,
					success: function(result){
						let hasil = JSON.parse(result);
						// CEK HASIL
						if( hasil.hasil == "gagal" ) {
							alert(hasil.pesan.gagal);
						} else if( hasil.hasil == "sukses" ) {
							alert(hasil.pesan.sukses);
							window.location.href = '?page=m_masa_kpl';
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {
						setTimeout(function(){
							alert('Error', "Tolong Cek Koneksi Lalu Ulangi", 'error');
						}, 1000);
					}
				});
			}
		} else {
			console.log('Invalid Form.');
		}
	});

	// FUNGSI VALID TANGGAL
	function valid_tanggal(tanggal){
		var pola = new RegExp(/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/);
		return pola.test(tanggal);
	}

	function set_clear_invalid_input_all(form) {
		$(form).find('.form-group').removeClass('has-error');
		$(form).find('select, input').each(function(){
			$(this).removeClass('invalid');
		});
		$(form).find('.pesan .pesan-text').text('');
		$(form).find('.pesan .pesan-text').removeClass('text-danger');
		$(form).find('.pesan .pesan-text').hide();
	}

	function set_clear_invalid_input(input) {
		$(input).parents('.form-group').removeClass('has-error');
		$(input).removeClass('invalid');
		$(input).parents('.form-group').find('.pesan .pesan-text').text('');
		$(input).parents('.form-group').find('.pesan .pesan-text').removeClass('text-danger');
		$(input).parents('.form-group').find('.pesan .pesan-text').hide();
	}

	function get_invalid_input(pesan, input) {
		$(input).parents('.form-group').addClass('has-error');
		$(input).addClass('invalid');
		$(input).parents('.form-group').find('.pesan .pesan-text').text('');
		$(input).parents('.form-group').find('.pesan .pesan-text').addClass('text-danger');
		$(input).parents('.form-group').find('.pesan .pesan-text').text(pesan);
		$(input).parents('.form-group').find('.pesan .pesan-text').show("slow");
	}

});