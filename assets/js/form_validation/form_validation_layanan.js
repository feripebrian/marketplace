$(document).ready(function(){

	let aksi = "";

	set_clear_invalid_input_all($('#form-layanan-publik'));

	$(function(){
		$('#form-layanan-publik').find('#gambar').change(function(){
			let file = $(this).get(0).files,
			numFiles = file ? file.length : 0,
			label    = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');

			$(this).trigger('fileselect', [file, numFiles, label]);
		});

		$('#form-layanan-publik').find('#gambar').on('fileselect', function(event, file, numFiles, label) {
			let text  = $(this).parents('.input-group').find('#gambar-text');

			// CEK APAKAH GAMBAR DIUPLOAD
			if( numFiles === 1 ) {
				text.val(label);

				function previewFile(file, onLoadCallback) {
					let reader = new FileReader();
					reader.onload = onLoadCallback;
					reader.readAsDataURL(file);
				}

				previewFile(file[0], function(e){
					$('#form-layanan-publik').find('#fetch-gambar').attr('src', '');
					$('#form-layanan-publik').find('#fetch-gambar').attr('src', e.target.result);
				});
			}
		});
	});

	$('#form-layanan-publik').find('button#simpan-layanan').click(function(){
		aksi = "simpan";
	});
	$('#form-layanan-publik').find('button#ubah-layanan').click(function(){
		aksi = "ubah";
	});

	$('#form-layanan-publik').submit(function(evt){
		evt.preventDefault();
		let valid = true;
		let pesan = '';
		let dataForm = new FormData(this);

		set_clear_invalid_input_all($('#form-layanan-publik'));

		$('#form-layanan-publik').find('#url_layanan_pblk, #gambar-text, #ket_layanan_pblk').each(function(){
			if( !$(this).val() ) {
				valid = false;
				pesan = 'Mohon dilengkapi.';

				return get_invalid_input(pesan, this);
			}
		});

		// VALIDASI URL LINK
		$('#form-layanan-publik').find('#url_layanan_pblk, #ket_layanan_pblk').each(function(){
			let input = $(this).val();
			let len   = input.length;

			if( len>0 ) {
				// CEK PANJANG KARAKTER INPUTAN
				if( len>100 ) {
					valid = false;
					pesan = 'Maksimal 100 karakter.';

					return get_invalid_input(pesan, this);
				}
			}
		});

		$('#form-layanan-publik').find('input, textarea').each(function(){
			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		if( valid === true ) {
			if( aksi == "simpan" ) {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "m_layanan_publik/aksi_layanan_publik.php?layananpublik=tambah",
					data: dataForm,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result){
						// CEK HASIL
						if( result.hasil == "image nothing" ) {
							pesan = result.pesan.nothing;

							return get_invalid_input(pesan, $('#form-layanan-publik').find('#gambar'));
						} else if( result.hasil == "image not match" ) {
							pesan = result.pesan.notmatch;

							return get_invalid_input(pesan, $('#form-layanan-publik').find('#gambar'));
						} else if( result.hasil == "image size" ) {
							pesan = result.pesan.notsize;

							return get_invalid_input(pesan, $('#form-layanan-publik').find('#gambar'));
						} else if( result.hasil == "gagal" ) {
							alert(result.pesan.gagal);
						} else if( result.hasil == "sukses" ) {
							alert(result.pesan.sukses);
							window.location.href = '?page=m_layananpublik';
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
					url: "m_layanan_publik/aksi_layanan_publik.php?layananpublik=ubah",
					data: dataForm,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result){
						// CEK HASIL
						if( result.hasil == "image not match" ) {
							pesan = result.pesan.notmatch;

							return get_invalid_input(pesan, $('#form-layanan-publik').find('#gambar'));
						} else if( result.hasil == "image size" ) {
							pesan = result.pesan.notsize;

							return get_invalid_input(pesan, $('#form-layanan-publik').find('#gambar'));
						} else if( result.hasil == "gagal" ) {
							alert(result.pesan.gagal);
						} else if( result.hasil == "sukses" ) {
							alert(result.pesan.sukses);
							window.location.href = '?page=m_layananpublik';
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
		$(form).find('input, textarea').each(function(){
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