$(document).ready(function(){

	let aksi = "";

	set_clear_invalid_input_all($('#form-jabatan'));

	$('#form-jabatan').find('button#simpan-jabatan').click(function(){
		aksi = "simpan";
	});
	$('#form-jabatan').find('button#ubah-jabatan').click(function(){
		aksi = "ubah";
	});

	$('#form-jabatan').submit(function(evt){
		evt.preventDefault();
		let valid = true;
		let pesan = '';
		let dataForm = $(this).serialize();

		set_clear_invalid_input_all($('#form-jabatan'));

		$('#form-jabatan').find('input').each(function(){
			if( !$(this).val() ) {
				valid = false;
				pesan = 'Mohon dilengkapi.';

				return get_invalid_input(pesan, this);
			} else {
				if( $(this).val().length > 50 ) {
					valid = false;
					pesan = 'Nama maksimal 50 karakter.';

					return get_invalid_input(pesan, this);
				}
			}

			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		if( valid === true ) {
			if( aksi == "simpan" ) {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "m_jabatan/aksi_jabatan.php?jabatan=tambah",
					data: dataForm,
					cache: false,
					processData:false,
					success: function(result){
						let hasil = JSON.parse(result);
						// CEK HASIL
						if( hasil.hasil == "sukses" ) {
							alert(hasil.pesan.sukses);
							window.location.href = '?page=m_jabatan';
						} else {
							alert(hasil.pesan.gagal);
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
					url: "m_jabatan/aksi_jabatan.php?jabatan=ubah",
					data: dataForm,
					cache: false,
					processData:false,
					success: function(result){
						let hasil = JSON.parse(result);
						// CEK HASIL
						if( hasil.hasil == "sukses" ) {
							alert(hasil.pesan.sukses);
							window.location.href = '?page=m_jabatan';
						} else {
							alert(hasil.pesan.gagal);
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
		$(input).parents('.form-group').find('.pesan .pesan-text').show("slow");
	}
	
});