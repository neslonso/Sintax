<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('#emailNewUsr').val(getUrlParameter('email',''));

	$('#btnNewUser').on('click', function () {
		var email=$.trim($('#emailNewUsr').val());
		var error=false;
		var msg="";
		if (email==""){
			error=true;
			msg="- Escribe un correo electrónico válido<br>";
		}
		if (($('#passNewUsr').val()==$('#pass2NewUsr').val()) && $('#passNewUsr').val()!="" && !error){
			$.post('<?=BASE_DIR.FILE_APP?>',{
				'MODULE':'actions',
				'acClase':'registro_usuario',
				'acMetodo':'acGrabarCliente',
				'acTipo':'ajax',
				'keyTienda':$('#keyTiendaNewUsr').val(),
				'email':$('#emailNewUsr').val(),
				'pass':$('#passNewUsr').val()
			},
			function (response) {
				console.log(response);
				if (!response.data.resultado.valor){
					muestraMsgModal('Error',response.data.resultado.msg);
				} else {
					window.location.href = "/";
				}
			},
			'json');
		} else {
			error=true;
			msg+="- Escribe tu contraseña y repítela correctamente";
		}
		if (error){
			muestraMsgModal('Error',msg);
		}
	});
});
