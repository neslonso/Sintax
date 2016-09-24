<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('#divJqCesta').jqCesta();
	$('#divJqNotifications').jqNotifications({'foo': 'bar'});
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
});
function openItem(id){
	alert("abriendo");
	$("#popupItemActive").val(id);
	$("#itemPopup"+id).addClass('active');
}
function closePopup(){
	var itemActive= $("#popupItemActive").val();
	$("#itemPopup"+itemActive).removeClass('active');
	$("#popupItemActive").val("");
}