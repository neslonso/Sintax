<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
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
				'acClase':'acceso_usuario',
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

	$('#btnLoginUser').on('click', function () {
		var email=$.trim($('#emailLoginUser').val());
		var pass=$('#passLoginUser').val()
		var error=false;
		var msg="";
		if (email=="" || pass==""){
			error=true;
			msg="-Escribe tu email y contraseña<br>";
		}
		if (!error){
			//if (typeof token == 'undefined') {token='';}
			token='';
			$.post('<?=BASE_DIR.FILE_APP?>',{
				'MODULE':'actions',
				'acClase':'acceso_usuario',
				'acMetodo':'acLoginCliente',
				'acTipo':'ajax',
				'keyTienda':$('#keyTiendaNewUsr').val(),
				'email':email,
				'pass':$('#passLoginUser').val(),
				'token':token
			},
			function (response) {
				if (response.exito) {
					if (response.data=='true') {
						window.location='<?=BASE_URL?>';
					}
				} else {
					muestraMsgModal('Se ha producido un error durante el inicio de sesión',response.msg);
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
