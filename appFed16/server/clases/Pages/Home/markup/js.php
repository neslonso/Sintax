<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$.ajaxSetup({ cache: true });
	$.getScript('//connect.facebook.net/es_ES/sdk.js', function(){
		FB.init({
			appId   : '<?=$GLOBALS['config']->tienda->FB_APP_ID?>',
			//cookie  : true, // enable cookies to allow the server to access the session
			//xfbml   : true, // parse social plugins on this page
			status  : true, // ¿Llama a getLoginStatus al cargar el SDK?
			version : 'v2.7' // or v2.0, v2.1, v2.2, v2.3
		});
		$('.FbLogin').removeAttr('disabled');
	});
	$('.FbLogin').click(function () {
		$.overlay();
		FB.login(function(responseLogin) {
			console.log(responseLogin);
			switch (responseLogin.status) {
				case "connected":
					console.log('usuario loogeado en FB y aplicación autorizada');
					//conseguir sus datos
					FB.api('/me/?fields=id,email,first_name,last_name,gender,birthday,picture', function(responseApiMe) {
						console.log(responseApiMe);
						acLogin(responseApiMe.email,'',responseLogin.authResponse.accessToken);
						/*
						<? //Tratamos de loggear el email que viene de FB?>
						$.post('./actions.php',{
							'APP':'appTienda',
							'acClase':'Home',
							'acMetodo':'usrLoginFb',
							'acTipo':'ajaxAssoc',
							'accessToken': responseLogin.authResponse.accessToken,
							'email': responseApiMe.email
						},
						function (data,textStatus,jqXHR) {
							console.log (data);
							if (data.exito) {
								if (data.data.logged) {
									//loggeado, recargamos
									window.location.reload();
								} else {
									//no existe email-> mandarlo a newUsr con los datos rellenos
									var pictureURL=(responseApiMe.picture.data.is_silhouette)?'':responseApiMe.picture.data.url;
									Post('action','<?=BASE_DIR?>actions.php',
										'APP','appTienda','acClase','newUsr','acMetodo','rellenaDatosFb','acTipo','stdAssoc',
										'email',responseApiMe.email,'first_name',responseApiMe.first_name,'last_name',responseApiMe.last_name,
										'gender',responseApiMe.gender,'birthday',responseApiMe.birthday,'pictureURL',pictureURL
									);
								}
							} else {
								muestraMsgModal('Fallo realizando acceso mediante facebook',data.msg);
							}
						},
						'json');
						*/
					});
				break;
				case "not_authorized":
					console.log('usuario loggeado en FB y aplicación no autorizada');
					$.overlay('destroy');
					muestraMsgModal('Acceso con Facebook no autorizado',
						'Si desea acceder a <?=$GLOBALS['config']->tienda->SITE_NAME?> a través de Facebook debe autorizar a '+
						'<?=$GLOBALS['config']->tienda->SITE_NAME?> a utilizar sus datos.'
					);
				break;
				case "unknown":
				default:
					console.log('usuario no loggeado en FB, no se sabe si la aplicación está autorizada');
					$.overlay('destroy');
					muestraMsgModal('Sesión de Facebook no iniciada',
						'Si desea acceder a <?=$GLOBALS['config']->tienda->SITE_NAME?> a través de Facebook debe realizar el '+
						'inicio de sesión en Facebook');
				break;
			}
		}, {
			scope:'public_profile,email,user_friends',
			return_scopes:true,
		});
		//}, {scope:'public_profile,email,user_friends,user_birthday,user_likes'});
		return false;
	});

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
			if (response.data=='true') {
				window.location.reload();
			} else if (response.data=='FbLogin') {
				window.location='<?=BASE_URL?>registro_usuario/';
			} else {
				muestraMsgModal('No fue posible iniciar sesión',response.msg);
			}
		} else {
			muestraMsgModal('Se ha producido un error durante el inicio de sesión',response.msg);
		}
	},
	'json');
}