$(document).ready(function(){

	$('.main-form').find('.title-login').find('.alert').hide();

	$('#form-login').submit(function(evt){
		evt.preventDefault();
		let dataForm = $(this).serialize();
		let valid = true;

		// CEK APAKAH USERNAME DAN PASSWORD TELAH TERISI
		$(this).find('input').each(function(){
			if( !$(this).val() ) {
				valid = false;
				$('.main-form').find('.title-login').find('.alert').show();
				return apply_feedback_error(this);
			} else {
				valid = true;
				$('.main-form').find('.title-login').find('.alert').hide();
				$(this).removeClass('invalid');
				$(this).closest('div').removeClass('has-error');
			}

			if( $(this).hasClass('invalid') ) {
				valid = false;
			}
		});

		if( valid === true ) {
			$.ajax({
				url: "cek_login.php?op=in",
				type: "POST",
				data: dataForm,
				success: function(result){
					// CEK HASIL
					if( result.hasil == "berhasil" ) {
						window.location.href = 'index.php';
					} else {
						$('.main-form').find('.title-login').find('.alert').show();
						return apply_feedback_error($('#form-login').find('input'));
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					setTimeout(function(){
						alert('Error', "Tolong Cek Koneksi Lalu Ulangi", 'error');
					}, 1000);
				}
			});
		}
	});

	function apply_feedback_error(input){
		$(input).addClass('invalid');
		$(input).closest('div').addClass('has-error');
	}

});