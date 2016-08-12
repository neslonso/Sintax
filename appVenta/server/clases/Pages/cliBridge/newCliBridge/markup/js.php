<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {

	$('#btnEnviarLogin').on('click', function () {
		if ($('#pass').val()==$('#pass2').val() && $('#pass').val()!=""){
			$.post('<?=BASE_DIR.FILE_APP?>',{
				'MODULE':'actions',
				'acClase':'newCliBridge',
				'acMetodo':'acGrabar',
				'acTipo':'ajax',
				'hash':$('#hash').val(),
				'email':$('#email').val(),
				'pass':$('#pass').val()
			},
			function (response) {
				console.log(response);
				//TODO
				/*
				if response.data= false -> error en el mail
				muestraMsgModal('Error','La dirección de email ya existe');
				else
				window.redirect -> perfil de cliente.
				*/
			},
			'json');
		} else {
			muestraMsgModal('Error','Escribe tu contraseña y repítela correctamente');
		}
	});

});