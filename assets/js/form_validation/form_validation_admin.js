$(document).ready(function(){

	set_clear_invalid_textbox_all($('#form-tambah-admin'));

	$('#modal-tambah-admin').on('shown.bs.modal', function () {
		$('#form-tambah-admin').find('#nama_admin').focus();
	});

	$('#form-tambah-admin').submit(function(evt){
		evt.preventDefault();
		let valid = true;
		let dataForm = $(this).serialize();

		$('#form-tambah-admin').find('#nama_admin, #username_admin, #password_admin').each(function(){
			let textInput     = $(this).val();
			let len_textInput = textInput.length;

			// CEK PANJANG KARAKTER INPUT
			if( len_textInput>30 ) {
				pesan = 'Maksimal 30 karakter.';
				valid = false;
				
				return get_invalid_textbox(pesan, this);
			} else {
				return set_clear_invalid_textbox(this);
			}
		});

		if( valid == true ) {
			set_clear_invalid_textbox_all($('#form-tambah-admin'));

			$.ajax({
				url: "m_admin/aksi_admin.php?admin=tambah",
				type: "POST",
				data: dataForm,
				success: function(response){
					let hasil = JSON.parse(response);

					console.log(hasil);

					if( hasil.hasil == "username ada" ) {
						return get_invalid_textbox(hasil.pesan.invalid, $('#form-tambah-admin').find('#username_admin'));
					} else if( hasil.hasil == "konfirmasi tidak sesuai" ) {
						return get_invalid_textbox(hasil.pesan.invalid, $('#form-tambah-admin').find('#password_confirmation_admin'));
					} else if(hasil.hasil == "gagal") {
						alert(hasil.pesan.gagal);
					} else if(hasil.hasil == "sukses") {
						alert(hasil.pesan.sukses);
						window.location.href='?page=m_admin';
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					setTimeout(function(){
						alert('Error', "Tolong Cek Koneksi Lalu Ulangi", 'error');
					}, 1000);
				}
			});
		} else {
			console.log('Invalid form');
		}
	});

	$('.aktif').click(function(){
		let dataId = $(this).data('id');

		$.ajax({
			url: "m_admin/aksi_admin.php?status=0",
			type: "POST",
			data: "id="+dataId,
			success: function(result){
				let hasil = JSON.parse(result);
				// CEK HASIL
				if( hasil.hasil == "sukses" ) {
					alert(hasil.pesan.sukses);
					window.location.href='?page=m_admin';
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
	});

	$('.nonaktif').click(function(){
		let dataId = $(this).data('id');

		$.ajax({
			url: "m_admin/aksi_admin.php?status=1",
			type: "POST",
			data: "id="+dataId,
			success: function(result){
				let hasil = JSON.parse(result);
				// CEK HASIL
				if( hasil.hasil == "sukses" ) {
					alert(hasil.pesan.sukses);
					window.location.href='?page=m_admin';
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
	});

	function set_clear_invalid_textbox_all(form) {
		$(form).find('.form-group').removeClass('has-error');
		$(form).find('input').each(function(){
			$(this).removeClass('invalid');
		});
		$(form).find('.pesan-text').text('');
		$(form).find('.pesan-text').removeClass('text-danger');
		$(form).find('.pesan-text').hide();
	}

	function set_clear_invalid_textbox(textbox) {
		$(textbox).parents('.form-group').removeClass('has-error');
		$(textbox).removeClass('invalid');
		$(textbox).parent().find('.pesan-text').text('');
		$(textbox).parent().find('.pesan-text').removeClass('text-danger');
		$(textbox).parent().find('.pesan-text').hide();
	}

	function get_invalid_textbox(pesan, textbox) {
		$(textbox).parents('.form-group').addClass('has-error');
		$(textbox).addClass('invalid');
		$(textbox).parent().find('.pesan-text').text('');
		$(textbox).parent().find('.pesan-text').addClass('text-danger');
		$(textbox).parent().find('.pesan-text').text(pesan);
		$(textbox).parent().find('.pesan-text').show();
	}

});