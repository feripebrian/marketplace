$(document).ready(function(){

	let aksi = "";

	$('#form-link-maklumat').find('.pesan .pesan-text').hide();

	// VALIDASI select, input, textarea
	$('#form-link-maklumat').find('select, input, textarea').each(function(){
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

	// VALIDASI NAMA LINK
	$('#form-link-maklumat').find('#nama_link').blur(function(){
		let namaLink  = $(this).val();
		let len       = namaLink.length;

		if( len>0 ) {
			// CEK PANJANG KARAKTER NAMA LINK
			if( len>50 ) {
				$(this).parent().parent().find('.pesan .pesan-text').html('');
				$(this).parent().parent().find('.pesan .pesan-text').html('<i class="glyphicon glyphicon-warning-sign"></i> Nama Maksimal Karakter 50');

				return apply_feedback_error(this);
			}
		}
	});

	// VALIDASI LINK
	$('#form-link-maklumat').find('#link').blur(function(){
		let link = $(this).val();
		let len   = link.length;

		if( len>0 ) {
			// CEK PANJANG KARAKTER LINK
			if( len>100 ) {
				$(this).parent().parent().find('.pesan .pesan-text').html('');
				$(this).parent().parent().find('.pesan .pesan-text').html('<i class="glyphicon glyphicon-warning-sign"></i> Nama Maksimal Karakter 100');

				return apply_feedback_error(this);
			}
		}
	});

	$('#form-link-maklumat').find('button#simpan-link-maklumat').click(function(){
		aksi = "simpan";
	});
	$('#form-link-maklumat').find('button#ubah-link-maklumat').click(function(){
		aksi = "ubah";
	});

	$('#form-link-maklumat').submit(function(evt){
		evt.preventDefault();
		let valid = true; 
		var form = $('form')[0];
		var formData = new FormData(form);
		formData.append('link', $('input[type=file]')[0].files[0]); 

		if( valid === true ) {
			if( aksi == "simpan" ) {
				// PROSES PENGIRIMAN DATA INPUTAN
				$.ajax({
					type: "POST",
					url: "link_maklumat/aksi_link_maklumat.php?linkmaklumat=tambah",
					data: formData,
					contentType: false,
					processData: false,
					success: function(result){
						// CEK HASIL
						if( result.hasil == "sukses" ) {
							alert(result.pesan.sukses);
							window.location.href = '?page=link_maklumat';
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
					url: "link_maklumat/aksi_link_maklumat.php?linkmaklumat=ubah",
					data: formData,
					contentType: false,
					processData: false,
					success: function(result){
						// CEK HASIL
						if( result.hasil == "sukses" ) {
							alert(result.pesan.sukses);
							window.location.href = '?page=link_maklumat';
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