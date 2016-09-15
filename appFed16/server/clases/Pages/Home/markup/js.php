<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('#divJqCesta').jqCesta({'foo': 'bar'});
	$("#menu-toggle").click(function(e) {
        e.preventDefault();
        if ($("#wrapper").hasClass("toggled")) {
        	//está cerrado y lo vamos a abrir
        	$("#sidebar-wrapper").css("overflow-y","auto");
        	$("#wrapper").toggleClass("toggled");
			$(this).delay(600).queue(function() {
				//ajustamos para que quite el overflow cuando ya termine la animacion
				$("#sidebar-wrapper").css("overflow-y","visible");
				$("#sidebar-wrapper").addClass('sidebar-wrapper-scroll');
				//$("#sidebar-wrapper").css("position","relative");
				$(this).dequeue();
			});

		} else {
			//está abierto y lo vamos a cerrar
			$("#sidebar-wrapper").css("overflow-y","auto");
			$("#sidebar-wrapper").removeClass('sidebar-wrapper-scroll');
			//$("#sidebar-wrapper").css("position","fixed");
			$("#wrapper").toggleClass("toggled");
		}
    });
});
