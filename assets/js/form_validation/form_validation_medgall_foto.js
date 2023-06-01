$(document).ready(function() {

	let aksi = "";

	$('#form-media-gallery-foto').find('#media').addClass('invalid');
	$('#form-media-gallery-foto').find('#media').parents('.input-group').find(':text').addClass('invalid');

	$(function(){
		// $(document).on('change', ':file', function(){
		$('#form-media-gallery-foto').find('#media').change(function(){
			let input = $(this),
			file      = input.get(0).files,
			numFiles  = file ? file.length : 0,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [file, numFiles, label]);
		});

		$('#form-media-gallery-foto').find('#media').on('fileselect', function(event, file, numFiles, label) {
			let input = $(this).parents('.input-group').find(':text');
			let match = ['image/jpg', 'image/jpeg', 'image/png'];

			// CEK APAKAH GAMBAR DIUPLOAD
			if( numFiles !== 0 ) {
				log = numFiles > 1 ? numFiles+' files selected' : label;

				if( input.length ) {
					input.val(log);
				} else {
					if( log ) alert(log);
				}

				// DELETE CONTENT div#fetch-data-foto
				$('#form-media-gallery-foto').find('#fetch-data-foto').empty();

				for( let i=0; i<numFiles; i++ ){
					let file_size = file[i].size;
					let file_type = file[i].type;

					// CEK FILE APAKAH GAMBAR
					if( !((file_type==match[0]) || (file_type==match[1]) || (file_type==match[2])) ) {
						alert('Kesalahan! Terdapat file yang tidak sesuai dengan format (.jpg, .jpeg, .png).');
						window.location.href='?page=add_medgall_foto';

						return false;
					} else {
						// CEK file_size
						if( file_size > 5000000 ) { // JIKA file_size > 5mb
							alert('Kesalahan! Terdapat file yang ukurannya terlalu besar.');
							window.location.href='?page=add_medgall_foto';

							return false;
						} else {
							// MENAMPILKAN INPUT FOTO
							function previewFile(file, onLoadCallback) {
								let reader = new FileReader();
								reader.onload = onLoadCallback;
								reader.readAsDataURL(file);
							}

							// ADD CONTENT KE div#input-foto
							previewFile(file[i], function(e){
								let img = '<img src="'+ e.target.result +'" width="100%" height="320">';

								let inputFoto = '<div class="col-sm-6">';
								inputFoto    += '<div class="input-group">';
								inputFoto    += img;
								inputFoto    += '<br>';
								inputFoto    += '<br>';
								inputFoto    += '</div>';
								inputFoto    += '</div>';

								$('#form-media-gallery-foto').find('#fetch-data-foto').append(inputFoto);
							});

							$('.progress').hide();
							$('#progressBar').attr('aria-valuenow', "0").css('width', '0%').text('0%');
							$('#form-media-gallery-foto').removeClass('invalid');
							$(this).removeClass('invalid');
							input.removeClass('invalid');
						} // Tutup if else CEK file_size
					} // Tutup if else CEK FILE APAKAH GAMBAR
				} // Tutup for
			} else {
				$(this).addClass('invalid');
				alert('File tidak ada atau rusak.');
			} // Tutup if else CEK APAKAH GAMBAR DIUPLOAD
		});
	});

	$(function(){
		$('#form-media-gallery-foto').find('#foto').change(function(){
			let input = $(this),
			file      = input.get(0).files,
			numFiles  = file ? file.length : 0,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [file, numFiles, label]);
		});

		$('#form-media-gallery-foto').find('#foto').on('fileselect', function(event, file, numFiles, label) {
			let input = $(this).parents('.input-group').find(':text');
			let file_size = file[0].size, 
			file_type     = file[0].type, 
			match         = ['image/jpg', 'image/jpeg', 'image/png'];

			// CEK APAKAH GAMBAR DIUPLOAD
			if( numFiles !== 0 ) {
				if( input.length ) {
					input.val(label);
				} else {
					if( label ) alert(label);
				}
				// CEK FILE APAKAH GAMBAR
				if( !((file_type==match[0]) || (file_type==match[1]) || (file_type==match[2])) ) {
					alert('Kesalahan! Terdapat file yang tidak sesuai dengan format (.jpg, .jpeg, .png).');
					history.go(0);

					return false;
				} else {
					// CEK file_size
					if( file_size > 5000000 ) { // JIKA file_size > 5mb
						alert('Kesalahan! Terdapat file yang ukurannya terlalu besar.');
						history.go(0);

						return false;
					} else {
						// MENAMPILKAN INPUT FOTO
						function previewFile(file, onLoadCallback) {
							let reader = new FileReader();
							reader.onload = onLoadCallback;
							reader.readAsDataURL(file);
						}

						previewFile(file[0], function(e){
							$('#form-media-gallery-foto').find('#fetch-foto').attr('src', '');
							$('#form-media-gallery-foto').find('#fetch-foto').attr('src', e.target.result);
						});

						$('.progress').hide();
						$('#progressBar').attr('aria-valuenow', "0").css('width', '0%').text('0%');
						$('#form-media-gallery-foto').removeClass('invalid');
						$(this).removeClass('invalid');
						input.removeClass('invalid');
					} // Tutup if else CEK file_size
				} // Tutup if else CEK FILE APAKAH GAMBAR
			} else {
				$(this).addClass('invalid');
				input.addClass('invalid');
				alert('File tidak ada atau rusak.');
			} // Tutup if else CEK APAKAH GAMBAR DIUPLOAD
		});
	});

	$('#form-media-gallery-foto').find('#upload-foto').click(function(){
		aksi = "tambah";
	});

	$('#form-media-gallery-foto').find('#ubah-foto').click(function(){
		aksi = "ubah";
	});

	$('#form-media-gallery-foto').submit(function(evt){
		evt.preventDefault();
		let valid  = true;

		let input1 = $(this).find('#media').parents('.input-group').find(':text');
		let input2 = $(this).find('#foto').parents('.input-group').find(':text');

		let dataForm = new FormData($(this)[0]);

		if( $(this).hasClass('invalid') ) {
			valid = false;
		}

		if( input1.hasClass('invalid') ) {
			valid = false;
		}
		if( input2.hasClass('invalid') ) {
			valid = false;
		}

		if( valid === true ) {
			if( aksi == "tambah" ) {
				$('.msg').hide();
				$('.progress').show();
				
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
					url: "m_media_gallery/aksi_media_gallery_foto.php?foto=tambah",
					data : dataForm,
					processData : false,
					contentType : false,
					success : function(response){
						$('#form-media-gallery-foto')[0].reset();
						$('.msg').show();

						if( response == "gagal" ) {
							alert('File gagal di upload');
						} else {
							let msg = response + ' File berhasil di upload.';
							
							// DELETE CONTENT div#fetch-data-foto
							$('#form-media-gallery-foto').find('#fetch-data-foto').empty();
							$('.msg').html(msg);
						}
					}
				});
			} else {
				$('.msg').hide();
				$('.progress').show();
				
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
					url: "m_media_gallery/aksi_media_gallery_foto.php?foto=ubah",
					data : dataForm,
					processData : false,
					contentType : false,
					success : function(response){
						$('#form-media-gallery-foto')[0].reset();
						$('.msg').show();

						if( response == "gagal" ) {
							alert('File gagal di ubah');
						} else {
							let msg = 'File berhasil di ubah.';
							$('.msg').html(msg);
						}
					}
				});
			}
		} else {
			$('#form-media-gallery-foto')[0].reset();
			alert('Form belum valid.');
		}
	});
	
});