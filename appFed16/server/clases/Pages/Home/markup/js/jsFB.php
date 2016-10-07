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

});