$(document).ready(function() {

	let aksi = "";

	set_clear_invalid_input_all($('#form-media-gallery-video'));

	$(function(){
		$('#form-media-gallery-video').find('#media').change(function(){
			let input = $(this),
			file      = input.get(0).files,
			numFiles  = file ? file.length : 0,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [file, numFiles, label]);
		});

		$('#form-media-gallery-video').find('#media').on('fileselect', function(event, file, numFiles, label) {
			let input     = $(this).parents('.input-group').find(':text');
			let file_type = file[0].type;

			// CEK APAKAH VIDEO DIUPLOAD
			if( numFiles !== 0 ) {
				input.val(label);

				// DELETE CONTENT div#fetch-data-video
				$('#form-media-gallery-video').find('#fetch-data-video').empty();

				// MENAMPILKAN INPUT VIDEO
				function previewFile(file, onLoadCallback) {
					let reader = new FileReader();
					reader.onload = onLoadCallback;
					reader.readAsDataURL(file);
				}

				// ADD CONTENT KE div#input-video
				previewFile(file[0], function(e){
					let video = '<video width="100%" height="524" controls="controls">';
					video    += '<source src="'+ e.target.result +'" type="'+ file_type +'">';
					video    += 'Your browser does not support the video tag.';
					video    +=	'</video>';

					let inputVideo = '<div class="col-sm-8">';
					inputVideo    += '<div class="input-group">';
					inputVideo    += '<input type="text" class="form-control" name="judul" id="judul" size="100%" placeholder="Masukkan Judul Video" autofocus>';
					inputVideo    += '<br>';
					inputVideo    += '<div class="pesan">';
					inputVideo    += '<p class="text-muted pesan-text"></p>';
					inputVideo    += '</div>';
					inputVideo    += '</div>';
					inputVideo    += '<br>';
					inputVideo    += video;
					inputVideo    += '</div>';

					$('#form-media-gallery-video').find('#fetch-data-video').append(inputVideo);
				});

				set_clear_invalid_input_all($('#form-media-gallery-video'));
			}
		});
	});

	$('#form-media-gallery-video').find('#upload-video').click(function(){
		aksi = "simpan";
	});

	$('#form-media-gallery-video').find('#ubah-video').click(function(){
		aksi = "ubah";
	});

	$('#form-media-gallery-video').submit(function(evt){
		evt.preventDefault();
		let valid = true;
		let pesan = '';
		let dataForm = new FormData($(this)[0]);

		set_clear_invalid_input_all($('#form-media-gallery-video'));

		// VALIDASI INPUT JUDUL VIDEO
		$('#form-media-gallery-video').find('#judul').each(function(){
			let judul = $(this).val();
			let len   = judul.length;

			if( !judul ) {
				valid = false;
				pesan = 'Mohon dilengkapi.';

				return get_invalid_input(pesan, this);
			} else {
				// CEK KARAKTER INPUT JUDUL VIDEO
				if( len>100 ) {
					valid = false;
					pesan = 'Judul maksimal 100 karakter.';

					return get_invalid_input(pesan, this);
				}
			}
		});

		$('#form-media-gallery-video').find('input').each(function(){
			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		if( valid === true ){
			$('.msg').hide();
			$('.progress').show();

			if( aksi == "simpan" ) {
				$.ajax({
					xhr: function() {
						let xhr = new window.XMLHttpRequest();
						xhr.upload.addEventListener('progress', function(e){
							if(e.lengthComputable){
								console.log('Bytes Loaded : ' + e.loaded);
								console.log('Total Size : ' + e.total);
								console.log('Persen : ' + (e.loaded / e.total));
								
								let percent = Math.round((e.loaded / e.total) * 100);

								$('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
							}
						});
						return xhr;
					},
					
					type: "POST",
					url: "m_media_gallery/aksi_media_gallery_video.php?video=simpan",
					data : dataForm,
					processData : false,
					contentType : false,
					success : function(response){
						let hasil = JSON.parse(response);

						if( hasil.hasil == "video nothing" ) {
							pesan = hasil.pesan.nothing;

							return get_invalid_input(pesan, $('#form-media-gallery-video').find('#media'));
						} else if( hasil.hasil == "video not match" ) {
							pesan = hasil.pesan.notmatch;

							return get_invalid_input(pesan, $('#form-media-gallery-video').find('#media'));
						} else if( hasil.hasil == "video size" ) {
							pesan = hasil.pesan.notsize;

							return get_invalid_input(pesan, $('#form-media-gallery-video').find('#media'));
						} else if( hasil.hasil == "gagal" ) {
							$('.msg').html('');
							$('.msg').html(hasil.pesan.gagal);
							$('.msg').show();
						} else if( hasil.hasil == "sukses" ) {
							$('.msg').html('');
							$('.msg').html(hasil.pesan.sukses);
							$('.msg').show();

							// DELETE CONTENT div#fetch-data-video
							// $('#form-media-gallery-video').find('#fetch-data-video').empty();
						}

						// $('#form-media-gallery-video')[0].reset();
					}
				});
			} else {
				$.ajax({
					xhr: function() {
						let xhr = new window.XMLHttpRequest();
						xhr.upload.addEventListener('progress', function(e){
							if(e.lengthComputable){
								console.log('Bytes Loaded : ' + e.loaded);
								console.log('Total Size : ' + e.total);
								console.log('Persen : ' + (e.loaded / e.total));
								
								let percent = Math.round((e.loaded / e.total) * 100);

								$('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
							}
						});
						return xhr;
					},
					
					type: "POST",
					url: "m_media_gallery/aksi_media_gallery_video.php?video=ubah",
					data : dataForm,
					processData : false,
					contentType : false,
					success : function(response){
						let hasil = JSON.parse(response);

						if( hasil.hasil == "video not match" ) {
							pesan = hasil.pesan.notmatch;

							return get_invalid_input(pesan, $('#form-media-gallery-video').find('#media'));
						} else if( hasil.hasil == "video size" ) {
							pesan = hasil.pesan.notsize;

							return get_invalid_input(pesan, $('#form-media-gallery-video').find('#media'));
						} else if( hasil.hasil == "gagal" ) {
							$('.msg').html('');
							$('.msg').html(hasil.pesan.gagal);
							$('.msg').show();
						} else if( hasil.hasil == "sukses" ) {
							$('.msg').html('');
							$('.msg').html(hasil.pesan.sukses);
							$('.msg').show();

							// DELETE CONTENT div#fetch-data-video
							// $('#form-media-gallery-video').find('#fetch-data-video').empty();
						}

						// $('#form-media-gallery-video')[0].reset();
					}
				});
			}
		} else {
			console.log('Invalid Form.');
		}
	});

	function set_clear_invalid_input_all(form) {
		$(form).find('.input-group').removeClass('has-error');
		$(form).find('input').each(function(){
			$(this).removeClass('invalid');
		});
		$(form).find('.pesan .pesan-text').text('');
		$(form).find('.pesan .pesan-text').removeClass('text-danger');
		$(form).find('.pesan .pesan-text').hide();
		$(form).find('.progress').hide();
		$(form).find('#progressBar').attr('aria-valuenow', "0").css('width', '0%').text('0%');
	}

	function set_clear_invalid_input(input) {
		$(input).parents('.input-group').removeClass('has-error');
		$(input).removeClass('invalid');
		$(input).parents('.input-group').find('.pesan .pesan-text').text('');
		$(input).parents('.input-group').find('.pesan .pesan-text').removeClass('text-danger');
		$(input).parents('.input-group').find('.pesan .pesan-text').hide();
	}

	function get_invalid_input(pesan, input) {
		$(input).parents('.input-group').addClass('has-error');
		$(input).addClass('invalid');
		$(input).parents('.input-group').find('.pesan .pesan-text').text('');
		$(input).parents('.input-group').find('.pesan .pesan-text').addClass('text-danger');
		$(input).parents('.input-group').find('.pesan .pesan-text').text(pesan);
		$(input).parents('.input-group').find('.pesan .pesan-text').show("slow");
	}
	
});