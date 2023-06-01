$(document).ready(function(){

	let aksi = "";

	$('#form-direktori').find('.pesan .pesan-text').hide();

	// VALIDASI input
	$('#form-direktori').find('input').each(function(){
		$(this).blur(function(){
			if( !$(this).val() ) {
				return get_error_text(this);
			} else {
				$(this).removeClass('invalid');
				$(this).parent().parent().find('.pesan .pesan-text').hide();
				$(this).closest('div').removeClass('has-warning');
				$(this).closest('div').addClass('has-success');
				$(this).parent().parent().find('.pesan .pesan-text').removeClass('text-warning');
				$(this).parent().parent().find('.pesan .pesan-text').addClass('text-success');
				$(this).parent().parent().find('.pesan .pesan-text').html('');
				$(this).parent().parent().find('.pesan .pesan-text').html('<i class="glyphicon glyphicon-ok"></i>');
				$(this).parent().parent().find('.pesan .pesan-text').show("slow");
				
			}
		});
	});

	// VALIDASI ID DIREKTORI
	$('#form-zona').find('#id_zona, #id_zona_baru').blur(function(){
		let id  = $(this).val();
		let len = id.length;

		if( len>0 ) {
			// CEK PANJANG KARAKTER ID DIREKTORI
			if( len>3 ) {
				$(this).parent().parent().find('.pesan .pesan-text').html('');
				$(this).parent().parent().find('.pesan .pesan-text').html('<i class="glyphicon glyphicon-warning-sign"></i> ID Maksimal Karakter 3');

				return apply_feedback_error(this);
			} else {
				$.ajax({
					type: "POST",
					url: "m_zona/cek_id_zona.php",
					data: "id="+id,
					success: function(result){
						// CEK HASIL
						if( result == "ada" || result == "gagal" ) {
							$('#form-zona').find('#id_zona, #id_zona_baru').parent().parent().find('.pesan .pesan-text').html('');
							$('#form-zona').find('#id_zona, #id_zona_baru').parent().parent().find('.pesan .pesan-text').html('<i class="glyphicon glyphicon-warning-sign"></i> ID Direktori Sudah Ada.');

							return apply_feedback_error($('#form-zona').find('#id_zona, #id_zona_baru'));
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

	// VALIDASI NAMA DIREKTORI
	$('#form-zona').find('#nama_zona').blur(function(){
		let nama = $(this).val();
		let len  = nama.length;

		if( len>0 ) {
			// CEK PANJANG KARAKTER NAMA DIREKTORI
			if( len>30 ) {
				$(this).parent().parent().find('.pesan .pesan-text').html('');
				$(this).parent().parent().find('.pesan .pesan-text').html('<i class="glyphicon glyphicon-warning-sign"></i> Nama Maksimal Karakter 30');

				return apply_feedback_error(this);
			}
		}
	});

	$('#form-zona').find('button#simpan-zona').click(function(){
		aksi = "simpan";
	});
	$('#form-zona').find('button#ubah-zona').click(function(){
		aksi = "ubah";
	});

	$('#form-zona').submit(function(evt){
		evt.preventDefault();
		let valid = true;
		let dataForm = $(this).serialize();

		$(this).find('input').each(function(){
			if( !$(this).val() ) {
				valid = false;
				return get_error_text(this);
			}

			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		if( valid === true ) {
			if( aksi == "simpan" ) {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "m_zona/aksi_zona.php?zona=tambah",
					data: dataForm,
					success: function(result){
						let hasil = JSON.parse(result);
						// CEK HASIL
						if( hasil.hasil == "sukses" ) {
							alert(hasil.pesan.sukses);
							window.location.href = '?page=m_zona';
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
			} else {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "m_zona/aksi_zona.php?zona=ubah",
					data: dataForm,
					success: function(result){
						let hasil = JSON.parse(result);
						// CEK HASIL
						if( hasil.hasil == "sukses" ) {
							alert(hasil.pesan.sukses);
							window.location.href = '?page=m_zona';
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
			}
		}
	});

	function get_error_text(input) {
		$(input).parent().parent().find('.pesan .pesan-text').html('');
		$(input).parent().parent().find('.pesan .pesan-text').html('<i class="glyphicon glyphicon-warning-sign"></i> Lengkapi Isian Form');

		return apply_feedback_error(input);
	}

	function apply_feedback_error(input){
		$(input).addClass('invalid');
		$(input).parent().parent().find('.pesan .pesan-text').hide();
		$(input).closest('div').removeClass('has-success');
		$(input).closest('div').addClass('has-warning');
		$(input).parent().parent().find('.pesan .pesan-text').removeClass('text-success');
		$(input).parent().parent().find('.pesan .pesan-text').addClass('text-warning');
		$(input).parent().parent().find('.pesan .pesan-text').show("slow");
	}

});