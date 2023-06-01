$(document).ready(function(){

	let aksi = "";

	set_clear_invalid_input_all($('#form-link-direktori'));

	$('#form-link-direktori').find('button#simpan-link-direktori').click(function(){
		aksi = "simpan";
	});
	$('#form-link-direktori').find('button#ubah-link-direktori').click(function(){
		aksi = "ubah";
	});

	$('#form-link-direktori').submit(function(evt){
		evt.preventDefault();
		let valid = true;
		let pesan = '';
		let dataForm = $(this).serialize();

		set_clear_invalid_input_all($('#form-link-direktori'));

		$('#form-link-direktori').find('select, input, textarea').each(function(){
			if( !$(this).val() ) {
				valid = false;
				pesan = 'Mohon dilengkapi.';

				return get_invalid_input(pesan, this);
			}

			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		// VALIDASI NAMA LINK
		$('#form-link-direktori').find('#nama_link').each(function(){
			let namaLink = $(this).val();
			let len      = namaLink.length;

			if( len>0 ) {
				// CEK PANJANG KARAKTER NAMA LINK
				if( len>50 ) {
					valid = false;
					pesan = 'Nama maksimal 50 karakter.';

					return get_invalid_input(pesan, this);
				}
			}
		});

		// VALIDASI LINK
		$('#form-link-direktori').find('#link').each(function(){
			let link = $(this).val();
			let len  = link.length;

			if( len>0 ) {
				// CEK PANJANG KARAKTER LINK
				if( len>100 ) {
					valid = false;
					pesan = 'Nama maksimal 100 karakter.';

					return get_invalid_input(pesan, this);
				}
			}
		});

		if( valid === true ) {
			if( aksi == "simpan" ) {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "link_direktori/aksi_link_direktori.php?linkdir=tambah",
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
							window.location.href = '?page=link_direktori';
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
					url: "link_direktori/aksi_link_direktori.php?linkdir=ubah",
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
							window.location.href = '?page=link_direktori';
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {
						setTimeout(function(){
							alert('Error', "Tolong Cek Koneksi Lalu Ulangi", 'error');
						}, 1000);
					}
				});
			}
		}
	});

	function set_clear_invalid_input_all(form) {
		$(form).find('.form-group').removeClass('has-error');
		$(form).find('select, input, textarea').each(function(){
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