<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
	$('#divJqNotifications').jqNotifications();
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		if ($("#wrapper").hasClass("toggled")) {
			//está cerrado y lo vamos a abrir
			$("#sidebar-wrapper").css("overflow-y","auto");
			$("#sidebar-wrapper").css("overflow-x","hidden");
			$("#wrapper").toggleClass("toggled");
			$(this).delay(600).queue(function() {
				//ajustamos para que quite el overflow cuando ya termine la animacion
				$("#sidebar-wrapper").css("overflow-y","visible");
				$("#sidebar-wrapper").css("overflow-x","visible");
				$("#sidebar-wrapper").addClass('sidebar-wrapper-scroll');
				//$("#sidebar-wrapper").css("position","relative");
				$(this).dequeue();
			});

		} else {
			//está abierto y lo vamos a cerrar
			$("#sidebar-wrapper").css("overflow-y","auto");
			$("#sidebar-wrapper").css("overflow-x","hidden");
			$("#sidebar-wrapper").removeClass('sidebar-wrapper-scroll');
			//$("#sidebar-wrapper").css("position","fixed");
			$("#wrapper").toggleClass("toggled");
		}
	});
	$('.btnUserNav').click(function(e) {
		if($('#navUserMenu').hasClass('nav-user-menu-outside')){
			if($('.contentCart').hasClass('contentCartInside')){
				/*cerramos cesta*/
				$('.contentCart').removeClass('contentCartInside');
				$('.contentCart').addClass('contentCartOutside');
			}
			/* abrimos menu*/
			$('#navUserMenu').removeClass('nav-user-menu-outside');
			$('#navUserMenu').addClass('nav-user-menu-inside');
		}else{
			if($('#navUserMenu').hasClass('nav-user-menu-inside')){
				/* cerramos menu */
				$('#navUserMenu').removeClass('nav-user-menu-inside');
				$('#navUserMenu').addClass('nav-user-menu-outside');
			}else{
				if($('.contentCart').hasClass('contentCartInside')){
					/*cerramos cesta*/
					$('.contentCart').removeClass('contentCartInside');
					$('.contentCart').addClass('contentCartOutside');
				}
				/*abrimos menu*/
				$('#navUserMenu').removeClass('nav-user-menu-outside');
				$('#navUserMenu').addClass('nav-user-menu-inside');
			}
		}
	});
	$('#btnLogout').on('click', function () {
		$.post('<?=BASE_DIR.FILE_APP?>',{
			'MODULE':'actions',
			'acClase':'Home',
			'acMetodo':'acLogout',
			'acTipo':'ajax'
		},
		function (response) {
			window.location.reload();
		},
		'json');
	});
	$('#frmLogin').keypress(function(e){
		if(e.which == 13) {
			$('#frmLogin #btnLogin').click();
		}
	});

	$('#frmLogin #btnLogin').on('click', function () {
		if ($('#frmLogin #email').val()!="" && $('#frmLogin #pass').val()!=""){
			acLogin($('#email').val(),$('#pass').val());
		} else {
			muestraMsgModal('Datos no válidos','Escribe tu email y contraseña');
		}
	});

	$('.TwLogin').click(function () {
		$.overlay();
		$.post('<?=BASE_DIR.FILE_APP?>',{
			'MODULE':'actions',
			'acClase':'Home',
			'acMetodo':'acTwLogin',
			'acTipo':'ajax'
		},
		function (response) {
			console.log(response);
			if (response.exito) {
				//window.location.replace(response.data);//No queda en la history
				window.location.href=response.data;
			} else {
				muestraMsgModal('Error conectando con twitter','Ha ocurrido un error iniciando la conexión con twitter. '+response.msg);
			}
		},
		'json');
	});

	$('#btnSuscribir').click(function () {
		var email=$.trim($('#emailSuscribir').val());
		var error=false;
		var msg="";
		$('#emailSuscribir').removeClass('btn-danger');
		$('#spanAceptoSuscribir').addClass('btn-danger');
		if (!$('#aceptoSuscribir').is(':checked')){
			error=true;
			$('#spanAceptoSuscribir').addClass('btn-danger');
			msg+="- Debe aceptar las condiciones de uso<br>";
		}
		if (email==""){
			error=true;
			$('#emailSuscribir').addClass('btn-danger');
			msg+="- Escribe un correo electrónico válido<br>";
		}
		if (error){
			muestraMsgModal('Error',msg);
		} else {
			$.post('<?=BASE_DIR.FILE_APP?>',{
				'MODULE':'actions',
				'acClase':'Home',
				'acMetodo':'acGrabarCliente',
				'acTipo':'ajax',
				'email':$('#emailSuscribir').val(),
			},
			function (response) {
				console.log(response);
				if (!response.data.resultado.valor){
					muestraMsgModal('Error',response.data.resultado.msg);
				} else {
					muestraMsgModal('¡Gracias!','Su correo electrónico ha sido añadido a nuestro boletín. Gracias por su interés.');
				}
			},
			'json');
		}
	});
});

function acLogin(email,pass,token) {
	if (typeof token == 'undefined') {token='';}
	$.post('<?=BASE_DIR.FILE_APP?>',{
		'MODULE':'actions',
		'acClase':'Home',
		'acMetodo':'acLogin',
		'acTipo':'ajax',
		'email':email,
		'pass':pass,
		'token':token
	},
	function (response) {
		console.log(response);
		if (response.exito) {
			if (response.data===true) {
				window.location.reload();
			} else if (response.data=='FBLogin') {
				window.location='<?=BASE_URL?>registro_usuario/?email='+email;
			} else {
				muestraMsgModal('No fue posible iniciar sesión',response.msg);
			}
		} else {
			muestraMsgModal('Se ha producido un error durante el inicio de sesión',response.msg);
		}
	},
	'json');
}

function acGrabarCliente(email,pass) {
	$.post('<?=BASE_DIR.FILE_APP?>',{
		'MODULE':'actions',
		'acClase':'Home',
		'acMetodo':'acGrabarCliente',
		'acTipo':'ajax',
		'email':email,
		'pass':pass,
	},
	function (response) {
		console.log(response);
		if (!response.data.resultado.valor){
			muestraMsgModal('Error',response.data.resultado.msg);
		} else {
			//window.location.href = '<?=BASE_URL?>';
			window.location.reload();
		}
	},
	'json');
}

function validaDatosAltaCliente(email,pass,repass,legal) {
	var error=false;
	var msg="<ul>";
	if (email==""){
		error=true;
		msg+="<li>Debe introducir su dirección de correo electrónico.</li>";
	}
	if (pass=="") {
		error=true;
		msg+="<li>Debe introducir y confirmar la contraseña.</li>";
	}
	if (pass!=repass) {
		error=true;
		msg+="<li>Las contraseñas introducidas no coinciden.</li>";
	}
	if (!legal){
		error=true;
		msg+="<li>Debe aceptar las condiciones de uso</li>";
	}
	msg+="</ul>";
	return (error)?msg:false;
}