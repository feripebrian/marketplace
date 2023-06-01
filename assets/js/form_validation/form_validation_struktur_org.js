$(document).ready(function(){

	let aksi = "";

	$('#form-struktur-organisasi').find('.pesan .pesan-text').hide();
	$('#form-struktur-organisasi').find('#no_detail_org').prop('disabled', true);
	$('#form-struktur-organisasi').find('select').prop('disabled', true);

	$('#form-struktur-organisasi').find('#button1').click(function(event){
		event.preventDefault();
		let input  = $(this).parent().find('#no_detail_org');
		let select = $(this).parents('.input-group').find('select');

		$(this).prop('disabled', true);
		input.prop('disabled', false);
		select.prop('disabled', false);
	});

	$('#form-struktur-organisasi').find('#button2').click(function(event){
		event.preventDefault();
		let input  = $(this).parent().find('#no_detail_org');
		let select = $(this).parents('.input-group').find('select');

		$(this).prop('disabled', true);
		input.prop('disabled', false);
		select.prop('disabled', false);
	});

	$('#form-struktur-organisasi').find('#button3').click(function(event){
		event.preventDefault();
		let input  = $(this).parent().find('#no_detail_org');
		let select = $(this).parents('.input-group').find('select');

		$(this).prop('disabled', true);
		input.prop('disabled', false);
		select.prop('disabled', false);
	});

	$('#form-struktur-organisasi').find('#button4').click(function(event){
		event.preventDefault();
		let input  = $(this).parent().find('#no_detail_org');
		let select = $(this).parents('.input-group').find('select');

		$(this).prop('disabled', true);
		input.prop('disabled', false);
		select.prop('disabled', false);
	});

	$('#form-struktur-organisasi').find('#button5').click(function(event){
		event.preventDefault();
		let input  = $(this).parent().find('#no_detail_org');
		let select = $(this).parents('.input-group').find('select');

		$(this).prop('disabled', true);
		input.prop('disabled', false);
		select.prop('disabled', false);
	});

	$('#form-struktur-organisasi').find('#button6').click(function(event){
		event.preventDefault();
		let input  = $(this).parent().find('#no_detail_org');
		let select = $(this).parents('.input-group').find('select');

		$(this).prop('disabled', true);
		input.prop('disabled', false);
		select.prop('disabled', false);
	});

	$('#form-struktur-organisasi').find('#button7').click(function(event){
		event.preventDefault();
		let input  = $(this).parent().find('#no_detail_org');
		let select = $(this).parents('.input-group').find('select');

		$(this).prop('disabled', true);
		input.prop('disabled', false);
		select.prop('disabled', false);
	});

	$('#form-struktur-organisasi').find('#button8').click(function(event){
		event.preventDefault();
		let input  = $(this).parent().find('#no_detail_org');
		let select = $(this).parents('.input-group').find('select');

		$(this).prop('disabled', true);
		input.prop('disabled', false);
		select.prop('disabled', false);
	});

	$(function(){
		$('#form-struktur-organisasi').find('#gambar').change(function(){
			let file = $(this).get(0).files,
			numFiles = file ? file.length : 0,
			label    = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');

			$(this).trigger('fileselect', [file, numFiles, label]);
		});

		$('#form-struktur-organisasi').find('#gambar').on('fileselect', function(event, file, numFiles, label) {
			let text  = $(this).parents('.input-group').find('#gambar-text'),
			file_size = file[0].size,
			file_type = file[0].type,
			match     = ['image/jpg', 'image/jpeg', 'image/png'];

			// CEK APAKAH GAMBAR DIUPLOAD
			if( numFiles === 1 ) {
				text.val(label);

				// CEK FILE APAKAH GAMBAR
				if( !((file_type==match[0]) || (file_type==match[1]) || (file_type==match[2])) ) {
					$(this).parents('.input-group').parent().parent().find('.pesan .pesan-text').html('');
					$(this).parents('.input-group').parent().parent().find('.pesan .pesan-text').html('<i class="glyphicon glyphicon-warning-sign"></i> Format File Harus .jpg, .jpeg atau .png.');

					return apply_feedback_error_file(this);
				} else {
					// CEK file_size
					if( file_size > 5000000 ) { // JIKA file_size > 5mb
						$(this).parents('.input-group').parent().parent().find('.pesan .pesan-text').html('');
						$(this).parents('.input-group').parent().parent().find('.pesan .pesan-text').html('<i class="glyphicon glyphicon-warning-sign"></i> Ukuran File Terlalu Besar. (Tidak Boleh > 5mb)');

						return apply_feedback_error_file(this);
					} else {
						// MENAMPILKAN INPUT FOTO
						function previewFile(file, onLoadCallback) {
							let reader = new FileReader();
							reader.onload = onLoadCallback;
							reader.readAsDataURL(file);
						}

						previewFile(file[0], function(e){
							$('#form-struktur-organisasi').find('#fetch-gambar').attr('src', '');
							$('#form-struktur-organisasi').find('#fetch-gambar').attr('src', e.target.result);
						});

						$(this).removeClass('invalid');
						$(this).parents('.input-group').parent().parent().find('.pesan .pesan-text').hide();
						$(this).parents('.input-group').parent().parent().find('.pesan .pesan-text').html('');
						$(this).parents('.input-group').parent().parent().find('.pesan .pesan-text').html('<i class="glyphicon glyphicon-ok"></i>');
						$(this).parents('.input-group').parent().removeClass('has-warning');
						$(this).parents('.input-group').parent().addClass('has-success');
						$(this).parents('.input-group').parent().parent().find('.pesan .pesan-text').removeClass('text-warning');
						$(this).parents('.input-group').parent().parent().find('.pesan .pesan-text').addClass('text-success');
						$(this).parents('.input-group').parent().parent().find('.pesan .pesan-text').show("slow");
					}
				}
			}
		});
	});

	$('#form-struktur-organisasi').find('select').each(function(){
		$(this).blur(function(){
			if( !$(this).val() ) {
				return get_error_text(this);
			} else {
				$(this).removeClass('invalid');
				$(this).parents('.form-group').find('.pesan .pesan-text').hide();
				$(this).closest('div').removeClass('has-warning');
				$(this).closest('div').addClass('has-success');
				$(this).parents('.form-group').find('.pesan .pesan-text').removeClass('text-warning');
				$(this).parents('.form-group').find('.pesan .pesan-text').addClass('text-success');
				$(this).parents('.form-group').find('.pesan .pesan-text').html('');
				$(this).parents('.form-group').find('.pesan .pesan-text').html('<i class="glyphicon glyphicon-ok"></i>');
				$(this).parents('.form-group').find('.pesan .pesan-text').show("slow");
			}
		});
	});

	$('#form-struktur-organisasi').find('#batal-struktur-organisasi').click(function(event){
		event.preventDefault();

		history.go(0);
	});

	$('#form-struktur-organisasi').find('#ubah-struktur-organisasi').click(function(){
		aksi = "ubah";
	});

	$('#form-struktur-organisasi').submit(function(evt){
		evt.preventDefault();
		let valid = true;
		let dataForm = new FormData(this);

		$(this).find('select').each(function(){
			if( !$(this).val() ) {
				valid = false;
				return get_error_text(this);
			}
		});

		$(this).find('#gambar, select').each(function(){
			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		if( valid === true ) {
			if( aksi == "ubah" ) {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "m_struktur_organisasi/aksi_struktur_organisasi.php?org=ubah",
					data: dataForm,
					contentType: false,
					cache: false,
					processData:false,
					success: function(result){
						// console.log(result);
						// CEK HASIL
						if( result.hasil == "sukses" ) {
							alert(result.pesan.sukses);
							window.location.href = '?page=m_struktur_org';
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
		}
	});

	function apply_feedback_error_file(inputFile){
		$(inputFile).addClass('invalid');
		$(inputFile).parents('.input-group').parent().parent().find('.pesan .pesan-text').hide();
		$(inputFile).parents('.input-group').parent().removeClass('has-success');
		$(inputFile).parents('.input-group').parent().addClass('has-warning');
		$(inputFile).parents('.input-group').parent().parent().find('.pesan .pesan-text').removeClass('text-success');
		$(inputFile).parents('.input-group').parent().parent().find('.pesan .pesan-text').addClass('text-warning');
		$(inputFile).parents('.input-group').parent().parent().find('.pesan .pesan-text').show("slow");
	}

	function get_error_text(input) {
		$(input).parents('.form-group').find('.pesan .pesan-text').html('');
		$(input).parents('.form-group').find('.pesan .pesan-text').html('<i class="glyphicon glyphicon-warning-sign"></i> Lengkapi Isian Form');

		return apply_feedback_error(input);
	}

	function apply_feedback_error(input){
		$(input).addClass('invalid');
		$(input).parents('.form-group').find('.pesan .pesan-text').hide();
		$(input).closest('div').removeClass('has-success');
		$(input).closest('div').addClass('has-warning');
		$(input).parents('.form-group').find('.pesan .pesan-text').removeClass('text-success');
		$(input).parents('.form-group').find('.pesan .pesan-text').addClass('text-warning');
		$(input).parents('.form-group').find('.pesan .pesan-text').show("slow");
	}

});