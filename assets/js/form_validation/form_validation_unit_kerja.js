$(document).ready(function() {

	let aksi = "";

	set_clear_invalid_input_all($('#form-unitkerja'));

	$('#form-unitkerja').find('button#simpan-unitkerja').click(function(){
		aksi = "simpan";
	});
	$('#form-unitkerja').find('button#ubah-unitkerja').click(function(){
		aksi = "ubah";
	});

	$('#form-unitkerja').submit(function(evt){
		evt.preventDefault();
		let valid = true;
		let dataForm = new FormData(this);

		set_clear_invalid_input_all($('#form-unitkerja'));

		$('#form-unitkerja').find('#pegawai, #deskripsi').each(function(){
			if( !$(this).val() ) {
				let pesan = 'Mohon dilengkapi!';
				valid = false;

				return get_invalid_input(pesan, this);
			} else {
				return set_clear_invalid_input(this);
			}
		});

		$('#form-unitkerja').find('#pegawai, #deskripsi').each(function(){
			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		if( valid === true ) {
			if( aksi == "simpan" ) {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "unit_kerja/aksi_unit_kerja.php?unitkerja=tambah",
					data: dataForm,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result){
						// CEK HASIL
						if(result.hasil == "gagal") {
							alert(result.pesan.gagal);
						} else if(result.hasil == "sukses") {
							alert(result.pesan.sukses);
							window.location.href='?page=unitkerja';
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
					url: "unit_kerja/aksi_unit_kerja.php?unitkerja=ubah",
					data: dataForm,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result){
						// CEK HASIL
						if(result.hasil == "gagal") {
							alert(result.pesan.gagal);
						} else if(result.hasil == "sukses") {
							alert(result.pesan.sukses);
							window.location.href='?page=unitkerja';
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
		$(form).find('#pegawai, #deskripsi').each(function(){
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