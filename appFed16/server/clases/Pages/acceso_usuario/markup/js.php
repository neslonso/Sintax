<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('#emailNewUsr').val(getUrlParameter('email',''));

	$('.panel').keypress(function(e){
		if(e.which == 13) {
			$(this).find('#btnNewUser').click();
			$(this).find('#btnLoginUser').click();
		}
	});

	$('#btnNewUser').on('click', function () {
		var email=$.trim($('#emailNewUsr').val());
		var pass=$.trim($('#passNewUsr').val());
		var repass=$.trim($('#pass2NewUsr').val());
		var legal=$('#checkLegal').is(':checked');
		var errorMsg=validaDatosAltaCliente(email,pass,repass,legal);
		if (errorMsg==false){
			acGrabarCliente(email,pass);
		} else {
			muestraMsgModal('Datos no válidos',errorMsg);
		}
	});

	$('#btnLoginUser').on('click', function () {
		var email=$.trim($('#emailLoginUser').val());
		var pass=$('#passLoginUser').val()
		var error=false;
		var msg="";
		if (email=="" || pass==""){
			error=true;
			msg="Escribe tu email y contraseña<br>";
		}
		if (!error){
			acLogin(email,pass);
		} else {
			muestraMsgModal('Error',msg);
		}
	});

});
