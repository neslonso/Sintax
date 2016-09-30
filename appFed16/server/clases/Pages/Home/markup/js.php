<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
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
	$('[data-toggle="tooltip"]').tooltip({container: 'body'});
	$('#modalItems').on('show.bs.modal', function (e) {
		var idItem=$(e.relatedTarget).data('item');
		$("#popupItemActive").val(idItem);
		$("#itemPopup"+idItem).addClass('active');
	});
	$('#modalItems').on('hide.bs.modal', function (e) {
		var itemActive= $("#popupItemActive").val();
		$("#itemPopup"+itemActive).removeClass('active');
		$("#popupItemActive").val("");
	});
	$('#btnUserNav').click(function(e) {
		if($('#navUserMenu').hasClass('nav-user-menu-outside')){
			$('#navUserMenu').removeClass('nav-user-menu-outside');
			$('#navUserMenu').addClass('nav-user-menu-inside');
		}else{
			if($('#navUserMenu').hasClass('nav-user-menu-inside')){
				$('#navUserMenu').removeClass('nav-user-menu-inside');
				$('#navUserMenu').addClass('nav-user-menu-outside');
			}else{
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
			$.post('<?=BASE_DIR.FILE_APP?>',{
				'MODULE':'actions',
				'acClase':'Home',
				'acMetodo':'acLogin',
				'acTipo':'ajax',
				'email':$('#email').val(),
				'pass':$('#pass').val()
			},
			function (response) {
				console.log(response);
				if (!response.data.resultado.valor){
					muestraMsgModal('Error',response.data.resultado.msg);
				} else {
					window.location.reload();
				}
			},
			'json');
		} else {
			muestraMsgModal('Error','Escribe tu email y contraseña');
		}
	});

});

