$(document).ready(function(){

	let aksi = "";

	set_clear_invalid_input_all($('#form-tugasfungsi'));

	// VALIDASI SELECT
	$('#form-tugasfungsi').find('#pegawai').change(function(){
		let pegawai = $(this).val();

		// PROSES FETCH DATA TUGAS FUNGSI
		$.ajax({
			url: "tugas_fungsi/fetch_data_tugas_fungsi.php",
			type: "POST",
			data: "nip="+pegawai,
			success: function(result){
				let hasil = JSON.parse(result);
				// CEK HASIL
				if( hasil.hasil == "sukses" ) {
					// SET FOTO
					$('#form-tugasfungsi').find('#fetch-foto').attr('src', '');
					$('#form-tugasfungsi').find('#fetch-foto').attr('src', '../image/pegawai/'+hasil.pegawai.foto);
					// SET NAMA PEGAWAI
					$('#form-tugasfungsi').find('#fetch-foto').parent().find('strong').text('');
					$('#form-tugasfungsi').find('#fetch-foto').parent().find('strong').text(hasil.pegawai.nama);
					// SET NIP PEGAWAI
					$('#form-tugasfungsi').find('#fetch-foto').parent().find('span#nip').text('');
					$('#form-tugasfungsi').find('#fetch-foto').parent().find('span#nip').text(hasil.pegawai.nip);
				} else {
					return get_invalid_input(hasil.pesan.gagal, $('#form-tugasfungsi').find('#pegawai'));
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				setTimeout(function(){
					alert('Error', "Tolong Cek Koneksi Lalu Ulangi", 'error');
				}, 1000);
			}
		});
	});

	$('#form-tugasfungsi').find('#ubah-tugasfungsi').click(function(){
		aksi = "ubah";
	});

	$('#form-tugasfungsi').submit(function(evt){
		evt.preventDefault();
		let valid = true;
		let pesan = '';
		let dataForm = [
			$(this).find('#kd_tugas_fungsi').val(), 
			$(this).find('#pegawai').val(), 
			$(this).find('#deskripsi').val()
		];

		set_clear_invalid_input_all($('#form-tugasfungsi'));

		$('#form-tugasfungsi').find('#pegawai, #deskripsi').each(function(){
			if( !$(this).val() ) {
				valid = false;
				pesan = 'Mohon dilengkapi.';

				return get_invalid_input(pesan, this);
			}

			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		if( valid === true ) {
			if( aksi == "ubah" ) {
				// PROSES PENGIRIMAN DATA
				$.ajax({
					url: "tugas_fungsi/aksi_tugas_fungsi.php?tugasfungsi=ubah",
					type: "POST",
					data: "kode="+dataForm[0]+"&nip="+dataForm[1]+"&deskripsi="+dataForm[2],
					cache: false,
					processData: false,
					success: function(result){
						let hasil = JSON.parse(result);

						// CEK HASIL
						if( hasil.hasil == "sukses" ) {
							alert(hasil.pesan.sukses);
							window.location.href='?page=tugasfungsi';
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
		} else {
			console.log('Invalid Form.');
		}
	});

	function set_clear_invalid_input_all(form) {
		$(form).find('.form-group').removeClass('has-error');
		$(form).find('#pegawai, #deskripsi').each(function(){
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