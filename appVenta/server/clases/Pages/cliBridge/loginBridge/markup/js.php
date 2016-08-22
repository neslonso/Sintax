<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	setInterval(function() {
		var _docHeight = (document.height !== undefined) ? document.height : document.body.offsetHeight;
		//var _docWidth = (document.width !== undefined) ? document.width : document.body.offsetWidth;
		var objMsg= {
			service: "loginBridgeIframeHeight",
			parameters: _docHeight
		}
		parent.postMessage(objMsg, '*');
	}
	,100);

	$('#frmLogin').keypress(function(e){
		if(e.which == 13) {
			$('#frmLogin #btnLogin').click();
		}
	});

	$('#frmLogin #btnLogin').on('click', function () {
		if ($('#frmLogin #email').val()!="" && $('#frmLogin #pass').val()!=""){
			$.post('<?=BASE_DIR.FILE_APP?>',{
				'MODULE':'actions',
				'acClase':'loginBridge',
				'acMetodo':'acLogin',
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
			muestraMsgModal('Error','Escribe tu email y contraseña');
		}
	});

	$('#btnLogout').on('click', function () {
		$.post('<?=BASE_DIR.FILE_APP?>',{
			'MODULE':'actions',
			'acClase':'loginBridge',
			'acMetodo':'acLogout',
			'acTipo':'ajax',
		},
		function (response) {
				var objMsg= {
					service: "reload",
					parameters: ''
				}
				parent.postMessage(objMsg, '*');
		},
		'json');
	});

	$('#lnkDatos').on('click', function () {
		var objMsg= {
			service: "redirect",
			parameters: "datos"
		}
		parent.postMessage(objMsg, '*');
	});

	$('#lnkHistorial').on('click', function () {
		var objMsg= {
			service: "redirect",
			parameters: "historial"
		}
		parent.postMessage(objMsg, '*');
	});

	$('#btnRegistro').on('click', function () {
		var objMsg= {
			service: "redirect",
			parameters: "datos"
		}
		parent.postMessage(objMsg, '*');
	});

});