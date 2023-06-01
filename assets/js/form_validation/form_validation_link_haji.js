$(document).ready(function(){

	let aksi = "";

	$('#form-link-haji').find('.pesan .pesan-text').hide();

	// VALIDASI select, input, textarea
	$('#form-link-haji').find('select, input, textarea').each(function(){
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
	$('#form-link-haji').find('#nama_link').blur(function(){
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
	$('#form-link-haji').find('#link').blur(function(){
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

	$('#form-link-haji').find('button#simpan-link-haji').click(function(){
		aksi = "simpan";
	});
	$('#form-link-haji').find('button#ubah-link-haji').click(function(){
		aksi = "ubah";
	});

	$('#form-link-haji').submit(function(evt){
		evt.preventDefault();
		let valid = true;
		let dataForm = $(this).serialize();

		$(this).find('select, input, textarea').each(function(){
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
					url: "link_haji/aksi_link_haji.php?linkhaji=tambah",
					data: dataForm,
					success: function(result){
						// CEK HASIL
						if( result.hasil == "sukses" ) {
							alert(result.pesan.sukses);
							window.location.href = '?page=link_haji';
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
					url: "link_haji/aksi_link_haji.php?linkhaji=ubah",
					data: dataForm,
					success: function(result){
						// CEK HASIL
						if( result.hasil == "sukses" ) {
							alert(result.pesan.sukses);
							window.location.href = '?page=link_haji';
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