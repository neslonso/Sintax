<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {

	$('#btnEnviarLogin').on('click', function () {
		if (($('#pass').val()==$('#pass2').val()) && $('#pass').val()!=""){
			$.post('<?=BASE_DIR.FILE_APP?>',{
				'MODULE':'actions',
				'acClase':'newCliBridge',
				'acMetodo':'acGrabar',
				'acTipo':'ajax',
				'keyTienda':$('#keyTienda').val(),
				'email':$('#email').val(),
				'pass':$('#pass').val()
			},
			function (response) {
				if (!response.data.resultado.valor){
					muestraMsgModal('Error',response.data.resultado.msg);
				} else {
					var objMsg= {
						service: "reload",
						parameters: ''
					}
					parent.postMessage(objMsg, '*');
				}
			},
			'json');
		} else {
			muestraMsgModal('Error','Escribe tu contraseña y repítela correctamente');
		}
	});

});