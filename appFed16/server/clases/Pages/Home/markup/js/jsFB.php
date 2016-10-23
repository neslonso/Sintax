<?if (false) {?><script><?}?>
$(document).ready(function() {
	$.ajaxSetup({ cache: true });
	$.getScript('//connect.facebook.net/es_ES/sdk.js', function(){
		FB.init({
			appId   : '<?=$GLOBALS['config']->tienda->SOCIAL->FB->APP_ID?>',
			//cookie  : true, // enable cookies to allow the server to access the session
			//xfbml   : true, // parse social plugins on this page
			status  : true, // ¿Llama a getLoginStatus al cargar el SDK?
			version : 'v2.7' // or v2.0, v2.1, v2.2, v2.3
		});
		$('.FbLogin').removeAttr('disabled');

<?
if (!isset($_SESSION['usuario'])){
?>
		FB.Event.subscribe('auth.statusChange', function(response) {
			switch (response.status) {
				case "connected":
					console.log('usuario loogeado en FB y aplicación autorizada');
					FB.api('/me/?fields=id,email,first_name,last_name,gender,birthday,picture', function(responseApiMe) {
						console.log(responseApiMe);
						acLogin(responseApiMe.email,'',response.authResponse.accessToken);
					});
				break;
			}
		});
<?
}
?>
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