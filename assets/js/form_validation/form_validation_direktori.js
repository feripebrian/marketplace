$(document).ready(function(){

	let aksi = "";

	set_clear_invalid_input_all($('#form-direktori'));

	$('#form-direktori').find('button#simpan-direktori').click(function(){
		aksi = "simpan";
	});
	$('#form-direktori').find('button#ubah-direktori').click(function(){
		aksi = "ubah";
	});

	$('#form-direktori').submit(function(evt){
		evt.preventDefault();
		let valid = true;
		let pesan = '';
		let dataForm = $(this).serialize();

		set_clear_invalid_input_all($('#form-direktori'));

		// VALIDASI INPUT TERISI
		$('#form-direktori').find('input').each(function(){
			if( !$(this).val() ) {
				valid = false;
				pesan = 'Mohon dilengkapi';

				return get_invalid_input(pesan, this);
			}

			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		// VALIDASI PANJANG KARAKTER INPUT
		$('#form-direktori').find('#id_direktori, #id_direktori_baru').each(function(){
			let len = $(this).val().length;

			if( len > 3 ) {
				valid = false;
				pesan = 'ID maksimal 3 karakter.';

				return get_invalid_input(pesan, this);
			}
		});

		$('#form-direktori').find('#nama_direktori').each(function(){
			let len = $(this).val().length;

			if( len > 30 ) {
				valid = false;
				pesan = 'Nama maksimal 30 karakter.';

				return get_invalid_input(pesan, this);
			}
		});

		if( valid === true ) {
			if( aksi == "simpan" ) {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "m_direktori/aksi_direktori.php?direktori=tambah",
					data: dataForm,
					cache: false,
					processData:false,
					success: function(result){
						let hasil = JSON.parse(result);
						// CEK HASIL
						if( hasil.hasil == "duplicate id" ) {
							pesan = hasil.pesan.duplicate;

							return get_invalid_input(pesan, $('#form-direktori').find('#id_direktori'));
						} else if( hasil.hasil == "gagal" ) {
							alert(hasil.pesan.gagal);
						} else if( hasil.hasil == "sukses" ) {
							alert(hasil.pesan.sukses);
							window.location.href = '?page=m_direktori';
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
					url: "m_direktori/aksi_direktori.php?direktori=ubah",
					data: dataForm,
					cache: false,
					processData:false,
					success: function(result){
						let hasil = JSON.parse(result);
						// CEK HASIL
						if( hasil.hasil == "duplicate id" ) {
							pesan = hasil.pesan.duplicate;

							return get_invalid_input(pesan, $('#form-direktori').find('#id_direktori_baru'));
						} else if( hasil.hasil == "gagal" ) {
							alert(hasil.pesan.gagal);
						} else if( hasil.hasil == "sukses" ) {
							alert(hasil.pesan.sukses);
							window.location.href = '?page=m_direktori';
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

	function set_clear_invalid_input_all(form) {
		$(form).find('.form-group').removeClass('has-error');
		$(form).find('input').each(function(){
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
		$(input).parents('.form-group').find('.pesan .pesan-text').show('slow');
	}

});