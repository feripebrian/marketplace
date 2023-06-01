$(document).ready(function(){

	let aksi = "";

	set_clear_invalid_input_all($('#form-pegawai'));

	// UPLOAD FOTO KE LAYOUT
	$(function(){
		$('#form-pegawai').find('#foto').change(function(){
			let file = $(this).get(0).files,
			numFiles = file ? file.length : 0,
			label    = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');

			$(this).trigger('fileselect', [file, numFiles, label]);
		});

		$('#form-pegawai').find('#foto').on('fileselect', function(event, file, numFiles, label) {
			let text  = $(this).parents('.input-group').find('#foto-text');

			// CEK APAKAH FOTO DIUPLOAD
			if( numFiles === 1 ) {
				text.val(label);

				// MENAMPILKAN FOTO
				function previewFile(file, onLoadCallback) {
					let reader = new FileReader();
					reader.onload = onLoadCallback;
					reader.readAsDataURL(file);
				}

				previewFile(file[0], function(e){
					$('#form-pegawai').find('#fetch-foto').attr('src', '');
					$('#form-pegawai').find('#fetch-foto').attr('src', e.target.result);
				});
			}
		});
	});

	$('#form-pegawai').find('button#simpan-pegawai').click(function(){
		aksi = "simpan";
	});
	$('#form-pegawai').find('button#ubah-pegawai').click(function(){
		aksi = "ubah";
	});

	$('#form-pegawai').submit(function(evt){
		evt.preventDefault();
		let valid = true;
		let pesan = '';
		let dataForm = new FormData(this);

		set_clear_invalid_input_all($('#form-pegawai'));

		// VALIDASI input, select
		$('#form-pegawai').find('#nip, #nip_baru, #nama_pegawai, #jabatan, #foto-text').each(function(){
			if( !$(this).val() ) {
				valid = false;
				pesan = 'Mohon dilengkapi.';

				return get_invalid_input(pesan, this);
			}

			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		// VALIDASI NIP PEGAWAI
		$('#form-pegawai').find('#nip, #nip_baru').each(function(){
			let nip = $(this).val();
			let len = nip.length;

			if( len>0 ) {
				// CEK VALID NIP PEGAWAI
				if( !valid_nip(nip) ) {
					valid = false;
					pesan = 'NIP tidak boleh ada huruf.';

					return get_invalid_input(pesan, this);
				} else {
					// CEK PANJANG KARAKTER NIP PEGAWAI
					if( len>20 ) {
						valid = false;
						pesan = 'NIP maksimal 20 karakter.';

						return get_invalid_input(pesan, this);
					}
				}
			}
		});

		// VALIDASI NAMA PEGAWAI
		$('#form-pegawai').find('#nama_pegawai').each(function(){
			let nama = $(this).val();
			let len  = nama.length;

			if( len>0 ) {
				// CEK VALID NAMA PEGAWAI
				if( !valid_nama(nama) ) {
					valid = false;
					pesan = 'Nama tidak boleh ada angka.';

					return get_invalid_input(pesan, this);
				} else {
					// CEK PANJANG KARAKTER NAMA PEGAWAI
					if( len>50 ) {
						valid = false;
						pesan = 'Nama maksimal 50 karakter.';

						return get_invalid_input(pesan, this);
					}
				}
			}
		});

		if( $('#form-pegawai').find('#foto').hasClass('invalid') ) {
			valid = false;
		}

		if( valid === true ) {
			if( aksi == "simpan" ) {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "m_pegawai/aksi_pegawai.php?pegawai=tambah",
					data: dataForm,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result){
						// CEK HASIL
						if( result.hasil == "duplicate nip" ) {
							pesan = result.pesan.duplicate;

							return get_invalid_input(pesan, $('#form-pegawai').find('#nip'));
						} else if( result.hasil == "image nothing" ) {
							pesan = result.pesan.nothing;

							return get_invalid_input(pesan, $('#form-pegawai').find('#foto'));
						} else if( result.hasil == "image size" ) {
							pesan = result.pesan.notsize;

							return get_invalid_input(pesan, $('#form-pegawai').find('#foto'));
						} else if( result.hasil == "image not match" ) {
							pesan = result.pesan.notmatch;

							return get_invalid_input(pesan, $('#form-pegawai').find('#foto'));
						} else if( result.hasil == "gagal" ) {
							alert(result.pesan.gagal);
						} else if( result.hasil == "sukses" ) {
							alert(result.pesan.sukses);
							window.location.href = '?page=m_pegawai';
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
					url: "m_pegawai/aksi_pegawai.php?pegawai=ubah",
					data: dataForm,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result){
						// CEK HASIL
						if( result.hasil == "duplicate nip" ) {
							pesan = result.pesan.duplicate;

							return get_invalid_input(pesan, $('#form-pegawai').find('#nip'));
						} else if( result.hasil == "image nothing" ) {
							pesan = result.pesan.nothing;

							return get_invalid_input(pesan, $('#form-pegawai').find('#foto'));
						} else if( result.hasil == "image size" ) {
							pesan = result.pesan.notsize;

							return get_invalid_input(pesan, $('#form-pegawai').find('#foto'));
						} else if( result.hasil == "image not match" ) {
							pesan = result.pesan.notmatch;

							return get_invalid_input(pesan, $('#form-pegawai').find('#foto'));
						} else if( result.hasil == "gagal" ) {
							alert(result.pesan.gagal);
						} else if( result.hasil == "sukses" ) {
							alert(result.pesan.sukses);
							window.location.href = '?page=m_pegawai';
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
	
	// FUNGSI VALID NIP
	function valid_nip(nip){
		var pola = new RegExp(/^[0-9]+$/);
		return pola.test(nip);
	}

	// FUNGSI VALID NAMA
	function valid_nama(nama){
		var pola = new RegExp(/^[a-z A-Z . ,]+$/);
		return pola.test(nama);
	}

	function set_clear_invalid_input_all(form) {
		$(form).find('.form-group').removeClass('has-error');
		$(form).find('input, select').each(function(){
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