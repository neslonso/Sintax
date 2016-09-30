<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('#divJqCesta').jqCesta({
		arrItems: $('#divJqCesta').data('arrItems')
	})
	.on('afterAdd.jqCesta', function(event,item) {
		$.ajax({
			url: '<?=BASE_URL.FILE_APP?>',
			type: 'post',
			data: {
				'MODULE':'actions',
				'acClase':'Home',
				'acMetodo':'acAddToCesta',
				'acTipo':'ajax',
				'id': item.id
			},
			success: function (data) {
				console.log(data);
				if (data.exito) {
					$('#divJqNotifications').data('jqNotifications')
						.addNotification('Producto añadido', 'Se ha añadido a cesta el producto <strong>'+item.descripcion+'</strong>', 'add');
				} else {
					$('#divJqNotifications').data('jqNotifications')
						.addNotification('Error añadiendo producto', 'No fue psible añadir el producto <strong>'+item.descripcion+'</strong>.<br /><br />'+data.msg, 'other');
					muestraMsgModal('No fue posible añadir el producto a su pedido',data.msg);
					$('#divJqCesta').data('jqCesta').removeItem(item.id);
				}
			},
			dataType: 'json'
		});
	})
	.on('afterRemove.jqCesta', function(event,item) {
		$.ajax({
			url: '<?=BASE_URL.FILE_APP?>',
			type: 'post',
			data: {
				'MODULE':'actions',
				'acClase':'Home',
				'acMetodo':'acRemoveFromCesta',
				'acTipo':'ajax',
				'id': item.id
			},
			success: function (data) {
				console.log(data);
				if (data.exito) {
					$('#divJqNotifications').data('jqNotifications')
						.addNotification('Producto eliminado', 'Se ha eliminado a cesta el producto <strong>'+item.descripcion+'</strong>', 'del');
				} else {
					$('#divJqNotifications').data('jqNotifications')
						.addNotification('Error eliminanda producto', 'No fue psible eliminar el producto <strong>'+item.descripcion+'</strong>.<br /><br />'+data.msg, 'other');
					muestraMsgModal('No fue posible eliminar el producto de su pedido',data.msg);
					$('#divJqCesta').data('jqCesta').addItem(item.id);
				}
			},
			dataType: 'json'
		});
	})
	.on('checkOrder.jqCesta', function(event,arrItems) {
		window.location='<?=BASE_URL?>comprar_pedido/';
	});
});