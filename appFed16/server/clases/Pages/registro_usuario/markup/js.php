<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
	$('#btnEnviarLogin').on('click', function () {
		if (($('#pass').val()==$('#pass2').val()) && $('#pass').val()!=""){
			$.post('<?=BASE_DIR.FILE_APP?>',{
				'MODULE':'actions',
				'acClase':'registro_usuario',
				'acMetodo':'acGrabarCliente',
				'acTipo':'ajax',
				'keyTienda':$('#keyTienda').val(),
				'email':$('#email').val(),
				'pass':$('#pass').val()
			},
			function (response) {
				if (!response.data.resultado.valor){
					muestraMsgModal('Error',response.data.resultado.msg);
				} else {
					//recargamos pagina
				}
			},
			'json');
		} else {
			muestraMsgModal('Error','Escribe tu contraseña y repítela correctamente');
		}
	});
