$(document).ready(function(){

	let aksi = "";

	set_clear_invalid_input_all($('#form-carousel'));

	// UPLOAD GAMBAR KE LAYOUT
	$(function(){
		$('#form-carousel').find('#gambar').change(function(){
			let file = $(this).get(0).files,
			numFiles = file ? file.length : 0,
			label    = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');

			$(this).trigger('fileselect', [file, numFiles, label]);
		});

		$('#form-carousel').find('#gambar').on('fileselect', function(event, file, numFiles, label) {
			let text  = $(this).parents('.input-group').find('#gambar-text');

			// CEK APAKAH GAMBAR DIUPLOAD
			if( numFiles === 1 ) {
				text.val(label);

				// MENAMPILKAN GAMBAR
				function previewFile(file, onLoadCallback) {
					let reader = new FileReader();
					reader.onload = onLoadCallback;
					reader.readAsDataURL(file);
				}

				previewFile(file[0], function(e){
					$('#form-carousel').find('#fetch-gambar').attr('src', '');
					$('#form-carousel').find('#fetch-gambar').attr('src', e.target.result);
				});
			}
		});
	});

	$('#form-carousel').find('button#simpan-carousel').click(function(){
		aksi = "simpan";
	});
	$('#form-carousel').find('button#ubah-carousel').click(function(){
		aksi = "ubah";
	});

	$('#form-carousel').submit(function(evt){
		evt.preventDefault();
		let valid    = true;
		let pesan    = '';
		let dataForm = new FormData(this);

		set_clear_invalid_input_all($('#form-carousel'));

		// VALIDASI INPUT
		$('#form-carousel').find('#ket_carousel').each(function(){
			let input = $(this).val();
			let len   = input.length;

			if( !input ) {
				valid = false;
				pesan = 'Mohon dilengkapi.';

				return get_invalid_input(pesan, this);
			} else {
				if( len > 100 ) {
					valid = false;
					pesan = 'Keterangan maksimal 100 karakter.';

					return get_invalid_input(pesan, this);
				}
			}
		});

		$('#form-carousel').find('#ket_carousel, #gambar').each(function(){
			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		if( valid === true ) {
			if( aksi == "simpan" ) {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "carousel/aksi_carousel.php?carousel=tambah",
					data: dataForm,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result){
						// CEK HASIL
						if( result.hasil == "image nothing" ) {
							pesan = result.pesan.nothing;

							return get_invalid_input(pesan, $('#form-carousel').find('#gambar'));
						} else if( result.hasil == "image not match" ) {
							pesan = result.pesan.notmatch;

							return get_invalid_input(pesan, $('#form-carousel').find('#gambar'));
						} else if( result.hasil == "image size" ) {
							pesan = result.pesan.notsize;

							return get_invalid_input(pesan, $('#form-carousel').find('#gambar'));
						} else if( result.hasil == "gagal" ) {
							alert(result.pesan.gagal);
						} else if( result.hasil == "sukses" ) {
							alert(result.pesan.sukses);
							window.location.href = '?page=carousel';
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
					url: "carousel/aksi_carousel.php?carousel=ubah",
					data: dataForm,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result){
						// CEK HASIL
						if( result.hasil == "image not match" ) {
							pesan = result.pesan.notmatch;

							return get_invalid_input(pesan, $('#form-carousel').find('#gambar'));
						} else if( result.hasil == "image size" ) {
							pesan = result.pesan.notsize;

							return get_invalid_input(pesan, $('#form-carousel').find('#gambar'));
						} else if( result.hasil == "gagal" ) {
							alert(result.pesan.gagal);
						} else if( result.hasil == "sukses" ) {
							alert(result.pesan.sukses);
							window.location.href = '?page=carousel';
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
		$(form).find('#ket_carousel, #gambar').each(function(){
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