<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	//$('#divJqNotifications').html("Esto es una prueba");
	$('#divJqCesta').jqCesta({'foo': 'bar'});
	$('#divJqNotifications').jqNotifications({'foo': 'bar'});
});

function addProducto(){
	var exito = $('#divJqCesta').data('jqCesta').addItem('./appFed16/binaries/imgs/shop-item.jpg', 'LOREM IPSUM 6', 2, 15.00, 6);
	$('#divJqCesta').data('jqCesta').refreshTotal(0);
	if (exito){
		$('#divJqNotifications').data('jqNotifications').addNotification('Muy bien', 'Se ha añadido a cesta el producto <strong>LOREM IPSUM 6</strong>', 'add');
	}else{
		$('#divJqNotifications').data('jqNotifications').addNotification('Proceso incompleto', 'Se ha añadido a cesta el producto <strong>LOREM IPSUM 6</strong>', 'del');
	}
}