<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	//$('#divJqNotifications').html("Esto es una prueba");
	var src_imagen_default = "./appFed16/binaries/imgs/shop-item.jpg";
	$('#divJqCesta').jqCesta({
		arrItems: [
			{ id: 1, titulo: "PARAMETRO IPSUM 1", imagen: src_imagen_default, descripcion: "PARAMETRO PRODUCT ABOVE FOCUSED ON USING VARIABLES 1", quantity: 1, precio: 23.00 },
			{ id: 2, titulo: "PARAMETRO IPSUM 2", imagen: src_imagen_default, descripcion: "PARAMETRO PRODUCT ABOVE FOCUSED ON USING VARIABLES 2", quantity: 2, precio: 20.00 },
			{ id: 3, titulo: "PARAMETRO IPSUM 3", imagen: src_imagen_default, descripcion: "PARAMETRO PRODUCT ABOVE FOCUSED ON USING VARIABLES 3", quantity: 1, precio: 21.50 },
			{ id: 4, titulo: "PARAMETRO IPSUM 4", imagen: src_imagen_default, descripcion: "PARAMETRO PRODUCT ABOVE FOCUSED ON USING VARIABLES 4", quantity: 5, precio: 60.85 },
			{ id: 5, titulo: "PARAMETRO IPSUM 5", imagen: src_imagen_default, descripcion: "PARAMETRO PRODUCT ABOVE FOCUSED ON USING VARIABLES 5", quantity: 1, precio: 13.00 }
		]
	}).on('afterAdd', function () {
		$('#divJqNotifications').data('jqNotifications').addNotification('Muy bien', 'Se ha añadido a cesta el producto <strong>LOREM IPSUM 6</strong>', 'add');
	})
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