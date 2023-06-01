$(document).ready(function(){

	let aksi = "";

	set_clear_invalid_input_all($('#form-berita'));

	$(function(){
		$('#form-berita').find('#gambar').change(function(){
			let file = $(this).get(0).files,
			numFiles = file ? file.length : 0,
			label    = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');

			$(this).trigger('fileselect', [file, numFiles, label]);
		});

		$('#form-berita').find('#gambar').on('fileselect', function(event, file, numFiles, label) {
			let text  = $(this).parents('.input-group').find('#gambar-text');

			// CEK APAKAH GAMBAR DIUPLOAD
			if( numFiles === 1 ) {
				text.val(label);

				// MENAMPILKAN INPUT FOTO
				function previewFile(file, onLoadCallback) {
					let reader = new FileReader();
					reader.onload = onLoadCallback;
					reader.readAsDataURL(file);
				}

				previewFile(file[0], function(e){
					$('#form-berita').find('#fetch-gambar').attr('src', '');
					$('#form-berita').find('#fetch-gambar').attr('src', e.target.result);
				});
			}
		});
	});

	$('#form-berita').find('button#simpan-berita').click(function(){
		aksi = "simpan";
	});
	$('#form-berita').find('button#ubah-berita').click(function(){
		aksi = "ubah";
	});

	$('#form-berita').submit(function(evt){
		evt.preventDefault();
		let valid = true;
		let pesan = '';
		let dataForm = new FormData(this);

		set_clear_invalid_input_all($('#form-berita'));

		$('#form-berita').find('#judul_berita, #isi_berita').each(function(){
			if( !$(this).val() ) {
				valid = false;
				pesan = 'Mohon dilengkapi.';

				return get_invalid_input(pesan, this);
			}
		});

		// VALIDASI JUDUL BERITA
		$('#form-berita').find('#judul_berita').each(function(){
			let judul = $(this).val();
			let len   = judul.length;

			if( len>0 ) {
				// CEK PANJANG KARAKTER JUDUL BERITA
				if( len>100 ) {
					valid = false;
					pesan = 'Judul maksimal 100 karakter.';

					return get_invalid_input(pesan, this);
				}
			}
		});

		$('#form-berita').find('#judul_berita, #gambar, #isi_berita').each(function(){
			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		if( valid === true ) {
			if( aksi == "simpan" ) {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "m_berita/aksi_berita.php?berita=tambah",
					data: dataForm,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result){
						// CEK HASIL
						if( result.hasil == "image nothing" ) {
							pesan = result.pesan.nothing;

							return get_invalid_input(pesan, $('#form-berita').find('#gambar'));
						} else if( result.hasil == "image not match" ) {
							pesan = result.pesan.notmatch;

							return get_invalid_input(pesan, $('#form-berita').find('#gambar'));
						} else if( result.hasil == "image size" ) {
							pesan = result.pesan.notsize;

							return get_invalid_input(pesan, $('#form-berita').find('#gambar'));
						} else if( result.hasil == "gagal" ) {
							alert(result.pesan.gagal);
						} else if( result.hasil == "sukses" ) {
							alert(result.pesan.sukses);
							window.location.href = '?page=m_berita';
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
					url: "m_berita/aksi_berita.php?berita=ubah",
					data: dataForm,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result){
						// CEK HASIL
						if( result.hasil == "image not match" ) {
							pesan = result.pesan.notmatch;

							return get_invalid_input(pesan, $('#form-berita').find('#gambar'));
						} else if( result.hasil == "image size" ) {
							pesan = result.pesan.notsize;

							return get_invalid_input(pesan, $('#form-berita').find('#gambar'));
						} else if( result.hasil == "gagal" ) {
							alert(result.pesan.gagal);
						} else if( result.hasil == "sukses" ) {
							alert(result.pesan.sukses);
							window.location.href = '?page=m_berita';
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