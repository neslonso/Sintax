<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	getLineas();
	$('#divJqCesta').on('sessionUpdated.jqCesta', function(event,item) {
		getLineas();
	});
});

function getLineas () {
	$.overlay({progress: {class:'progress-bar-success'}});
	$.post('<?=BASE_DIR.FILE_APP?>',{
		'MODULE':'actions',
		'acClase':'<?=$page?>',
		'acMetodo':'acGetLineas',
		'acTipo':'ajax',
		'session_name':'<?=$GLOBALS['session_name']?>'
	},
	function (response) {
		if (!response.exito){
			muestraMsgModal('Ha ocurrido un error en el calculo del pedido','Se ha producido el siguiente error durante el cálculo de importes de pedido:<br/>'+response.msg);
		} else {
			var arrLineas=response.data.arrLineas;
			$('#tableLineas').data('arrLineas',arrLineas);
			var totalLineas=parseFloat(response.data.totalLineas).toFixed(2);
			$('.spTotalLineas').html(totalLineas).data('totalLineas',totalLineas);
			var totalRebotes=parseFloat(response.data.totalRebotes).toFixed(2);
			$('#tableLineas').data('totalRebotes',totalRebotes);
			var totalRebotesDesc=response.data.totalRebotesDesc;
			$('#tableLineas').data('totalRebotesDesc',totalRebotesDesc);
			var creditoMaximoAplicable=parseFloat(response.data.creditoMaximoAplicable).toFixed(2);
			$('#tableLineas').data('creditoMaximoAplicable',creditoMaximoAplicable);
			//$('#spPortes').html(portes).data('portes',portes);
		}
	},
	'json')
	.always(function() {
		$.overlay('destroy');
		refreshTableLineas();
		<?=$callbackPage?>
		$('[data-toggle="tooltip"]').tooltip({container:'body',html:true});
	});
}

function calculaTotales(dtoImporte, dtoTipo, ulDtosTotalTipo, ulDtosDescTipo, ulDtosDescImporte, idDirEntrega) {
	var totalLineas=$('#spTotalLineas').data('totalLineas');
	var baseDtosPorcentuales=(totalLineas-dtoImporte).toFixed(2);
	$('#spDtoTipo').html(dtoTipo).data('dtoTipo',dtoTipo);
	var dtoMonto=(Math.round(
			baseDtosPorcentuales*(ulDtosTotalTipo/100)
		*100)/100).toFixed(2);
	$('#spDtoMonto').html(dtoMonto).data('dtoMonto',dtoMonto);
	$('#tipDtosTipo').tooltip({
		placement: 'left',
		html: true,
		title: ulDtosDescTipo
	});

	$('#spDescuentoImporte').html(dtoImporte).data('dtoImporte',dtoImporte);
	$('#tipDtosImporte').tooltip({
		placement: 'left',
		html: true,
		title: ulDtosDescImporte
	});

	if (idDirEntrega) {
		$.overlay({progress: {class:'progress-bar-success'}});
		calculaPortes(
			totalLineas,
			idDirEntrega,
			function() {
				var portes=parseFloat($('#spPortes').data('portes'));
				$('#spPortes').html(portes.toFixed(2));

				//console.log('totalLineas: ' + totalLineas);
				//console.log('dtoImporte: ' + dtoImporte);
				//console.log('baseDtosPorcentuales: ' + baseDtosPorcentuales);
				//console.log('dtoMonto: ' + dtoMonto);
				//console.log('portes: ' + portes);

				var total=totalLineas-dtoMonto-dtoImporte+portes;
				total=(Math.round(total*100)/100).toFixed(2);
				$('#spTotal').html(total).data('total',total);

				var montoDevolucionImportePedidoEnCredito=(Math.round(
				total*parseFloat($('#spFidelizacionCredit').data('tipoDevolucionImportePedidoEnCredito'))/100
				*100)/100).toFixed(2);
				$('#spFidelizacionCredit').html(montoDevolucionImportePedidoEnCredito+'€').data('montoDevolucionImportePedidoEnCredito',montoDevolucionImportePedidoEnCredito);
				$.overlay('destroy');
			}
		);
	}
}

function refreshTableLineas() {
	var arrLineas=$('#tableLineas').data('arrLineas');
	$('#tableLineas tbody tr').remove();
	trsTableLineas(arrLineas);
	$('[data-toggle="tooltip"]').tooltip({container:'body',html:true});
}
function trsTableLineas (arrLineas) {
	if (arrLineas.length==0) {
		$('<tr class="trEmpty"><td colspan="999"><h1 class="text-danger text-center">Su pedido no contiene ningún producto</h1></td></tr>').appendTo('#tableLineas tbody');
		return;
	}
	for (var i = 0; i < arrLineas.length; i++) {
		var oLinea=arrLineas[i];
		var trHtml=[
			'<tr class="trLinea">',
				'<td>'+oLinea.referencia+'</td>',
				'<td>'+oLinea.concepto+'</td>',
				'<td><span '+oLinea.precioLineaTooltip+'>'+oLinea.pvp+'€</span></td>',
				'<td data-cantidad="'+oLinea.cantidad+'">'+oLinea.cantidad+'</td>',
				'<td><span data-toggle="tooltip" data-placement="left" data-html="true" title="'+oLinea.dtoTooltip+'">'+oLinea.dtoDesc+'</span></td>',
				'<td class="totalLinea" data-totalLinea="'+oLinea.totalLinea+'">'+oLinea.totalLinea+'€</td>',
			'</tr>',
		].join('');
		$(trHtml).
			data('objLinea',oLinea).
			appendTo('#tableLineas tbody');
	}
}

function calculaPortes(importe,idDireccion,callback) {
	$.post('<?=BASE_DIR.FILE_APP?>',{
		'MODULE':'actions',
		'acClase':'<?=$page?>',
		'acMetodo':'acGetPortes',
		'acTipo':'ajaxAssoc',
		'importe':importe,
		'idDireccion':idDireccion,
		'session_name':'<?=$GLOBALS['session_name']?>'
	},
	function (response) {
		if (!response.exito){
			muestraMsgModal('Error calculando gastos de envío','Se ha producido el siguiente error durante el cálculo de gastos de envio:<br/>'+response.msg);
		} else {
			var portes=response.data
			portes=parseFloat(portes).toFixed(2);
			$('#spPortes').html(portes).data('portes',portes);
		}
		if ($.isFunction(callback)) {
			callback(response);
		}
	},
	'json');
}
<?="\n/*".get_class()."*/\n"?>