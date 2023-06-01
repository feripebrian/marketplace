$(document).ready(function() {

	let aksi = "";

	set_clear_invalid_input_all($('#form-detail-unitkerja'));

	// UPLOAD FILE KE LAYOUT
	$(function(){
		$('#form-detail-unitkerja').find('#file').change(function(){
			let file = $(this).get(0).files,
			numFiles = file ? file.length : 0,
			label    = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');

			$(this).trigger('fileselect', [file, numFiles, label]);
		});

		$('#form-detail-unitkerja').find('#file').on('fileselect', function(event, file, numFiles, label) {
			let text  = $(this).parents('.input-group').find('#file-text');

			// CEK APAKAH FILE DIUPLOAD
			if( numFiles === 1 ) {
				text.val(label);
			}
		});
	});

	$('#form-detail-unitkerja').find('button#simpan-detail-unitkerja').click(function(){
		aksi = "simpan";
	});
	$('#form-detail-unitkerja').find('button#ubah-detail-unitkerja').click(function(){
		aksi = "ubah";
	});

	$('#form-detail-unitkerja').submit(function(evt){
		evt.preventDefault();
		let valid    = true;
		let pesan    = '';
		let dataForm = new FormData(this);

		set_clear_invalid_input_all($('#form-detail-unitkerja'));

		// VALIDASI INPUT NAMA DETAIL UNIT KERJA
		$('#form-detail-unitkerja').find('#nama_detail').each(function(){
			let nama_detail = $(this).val();
			let len         = nama_detail.length;

			if( !nama_detail ) {
				valid = false;
				pesan = 'Mohon dilengkapi.';

				return get_invalid_input(pesan, this);
			} else {
				if( len > 100 ) {
					valid = false;
					pesan = 'Nama detail maksimal 100 karakter.';

					return get_invalid_input(pesan, this);
				}
			}
		});

		$('#form-detail-unitkerja').find('#nama_detail, #file').each(function(){
			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		if( valid === true ) {
			if( aksi == "simpan" ) {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "unit_kerja/aksi_detail_unit_kerja.php?detailuk=tambah",
					data: dataForm,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result){
						// // CEK HASIL
						if( result.hasil == "not match" ) {
							pesan = result.pesan.notmatch;

							return get_invalid_input(pesan, $('#form-detail-unitkerja').find('#file'));
						} else if( result.hasil == "sukses" ) {
							let kode = $('#form-detail-unitkerja').find('#kd_unit_kerja').val(),
							nip      = $('#form-detail-unitkerja').find('#nip').val();

							alert(result.pesan.sukses);
							window.location.href = '?page=dtl_unitkerja'+'&kd='+kode+'&nip='+nip;
						} else {
							alert(result.pesan.gagal);
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
					url: "unit_kerja/aksi_detail_unit_kerja.php?detailuk=ubah",
					data: dataForm,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result){
						// CEK HASIL
						if( result.hasil == "not match" ) {
							pesan = result.pesan.notmatch;

							return get_invalid_input(pesan, $('#form-detail-unitkerja').find('#file'));
						} else if( result.hasil == "sukses" ) {
							let kode = $('#form-detail-unitkerja').find('#kd_unit_kerja').val(),
							nip      = $('#form-detail-unitkerja').find('#nip').val();

							alert(result.pesan.sukses);
							window.location.href = '?page=dtl_unitkerja'+'&kd='+kode+'&nip='+nip;
						} else {
							alert(result.pesan.gagal);
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