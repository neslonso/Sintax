<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	var editTimeout;
	$('#divJqCesta').jqCesta({
		arrItems: $('#divJqCesta').data('arrItems')
	})
	.on('afterAdd.jqCesta', function(event,item) {
		updateCesta('acAddToCesta',item);
	})
	.on('afterRemove.jqCesta', function(event,item) {
		updateCesta('acRemoveFromCesta',item);
	})
	.on('editItem.jqCesta', function(event,item) {
		if (typeof editTimeout!='undefined') {clearTimeout(editTimeout);}
		editTimeout=setTimeout((function (item) {
			return function() {
				updateCesta('acEditCesta',item);
			}
		})(item),300);
	})
	.on('checkOrder.jqCesta', function(event,arrItems) {
		window.location='<?=BASE_URL?>comprar_pedido/';
	});
});

function updateCesta(acMetodo,item) {
	$.ajax({
		url: '<?=BASE_URL.FILE_APP?>', type: 'post',
		data: {
			'MODULE':'actions',
			'acClase':'Home',
			'acMetodo':acMetodo,
			'acTipo':'ajax',
			'id': item.id,
			'cantidad':item.quantity
		},
		success: function (data) {
			switch (acMetodo) {
				case 'acAddToCesta':
					if (data.exito) {
						$('#divJqNotifications').data('jqNotifications').addNotification('Producto añadido', 'Se ha añadido al pedido el producto <strong>'+item.descripcion+'</strong>', 'add');
					} else {
						$('#divJqNotifications').data('jqNotifications').addNotification('Error añadiendo producto', 'No fue psible añadir el producto <strong>'+item.descripcion+'</strong>.<br /><br />'+data.msg, 'other');
						muestraMsgModal('No fue posible añadir el producto a su pedido',data.msg);
						//$('#divJqCesta').data('jqCesta').removeItem(item.id);
					}
				break;
				case 'acRemoveFromCesta':
					if (data.exito) {
						$('#divJqNotifications').data('jqNotifications').addNotification('Producto eliminado', 'Se ha eliminado del pedido el producto <strong>'+item.descripcion+'</strong>', 'del');
					} else {
						$('#divJqNotifications').data('jqNotifications').addNotification('Error eliminando producto', 'No fue psible eliminar el producto <strong>'+item.descripcion+'</strong>.<br /><br />'+data.msg, 'other');
						muestraMsgModal('No fue posible eliminar el producto de su pedido',data.msg);
						//$('#divJqCesta').data('jqCesta').addItem(item.id);
					}
				break;
				case 'acEditCesta':
					if (data.exito) {
						$('#divJqNotifications').data('jqNotifications').addNotification('Producto modificado', 'Se ha modificado el producto <strong>'+item.descripcion+'</strong>', 'other');
					} else {
						$('#divJqNotifications').data('jqNotifications').addNotification('Error modificando producto', 'No fue psible modificar el producto <strong>'+item.descripcion+'</strong>.<br /><br />'+data.msg, 'other');
						muestraMsgModal('No fue posible eliminar el producto de su pedido',data.msg);
					}
				break;
			}
			if (typeof getLineas == 'function') {getLineas();}
		},
		dataType: 'json'
	});
}