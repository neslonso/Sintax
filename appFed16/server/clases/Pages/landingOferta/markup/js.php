<?if (false) {?><script><?}?>
$(document).ready(function() {
	alert("ready");
	$('#tabsOferta a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
		alert("*************************pillando lineas1");
	getLineas();
});

/******************************************************************************/
function ulDtosEmpty() {
	$('#ulDtos').find('li').remove().end()
		.append('<li id="noDtos" class="noDtos">No se aplicará ningún descuento</li>')
		.data('empty',true);
}

function ulDtosAdd(id,concepto,tipo,importe) {
	var $ulDtos=$('#ulDtos');
	if ($ulDtos.data('empty')) {
		$ulDtos.find('li').remove();
	}
	var dtoDesc='';
	if (tipo!='') {dtoDesc=tipo+'%';} else {dtoDesc=importe+'€';}
	var denominacion=concepto+': '+dtoDesc
	$ulDtos.append('<li id="'+id+'" class="'+id+'" data-concepto="'+concepto+'" data-tipo="'+tipo+'" data-importe="'+importe+'">'+denominacion+'</li>');
	$ulDtos.data('empty',false);
}

function ulDtosDel(id) {
	var $ulDtos=$('#ulDtos');
	$ulDtos.find('#'+id).remove();
	if ($('#ulDtos').find('li').length==0) {
		ulDtosEmpty();
	}
}

function ulDtosTotalTipo() {
	var totalDtoTipo=0;
	var $ulDtos=$('#ulDtos');
	$ulDtos.find('li').each(function(index, el) {
		var dtoElto=parseFloat($(el).data('tipo'));
		if (!isNaN(dtoElto)) {
			totalDtoTipo+=dtoElto;
		}
	});
	return parseFloat(totalDtoTipo);
}
function ulDtosDescTipo() {
	var descTipo='';
	var $ulDtos=$('#ulDtos');
	$ulDtos.find('li').each(function(index, el) {
		if ($(el).data('tipo')!='') {
			descTipo+=$('<div />').append($(el).clone()).html();
		}
	});
	var result='';
	if (descTipo!="") {result='<ul>'+descTipo+'</ul>'}
	return result;
	return '<ul class="dtosDescTipo">'+descTipo+'</ul>';
}

function ulDtosTotalImporte() {
	var totalDtoImporte=0;
	var $ulDtos=$('#ulDtos');
	$ulDtos.find('li').each(function(index, el) {
		var dtoElto=parseFloat($(el).data('importe'));
		if (!isNaN(dtoElto)) {
			totalDtoImporte+=dtoElto;
		}
	});
	return parseFloat(totalDtoImporte);
}
function ulDtosDescImporte() {
	var descImporte='';
	var $ulDtos=$('#ulDtos');
	$ulDtos.find('li').each(function(index, el) {
		if ($(el).data('importe')!='') {
			descImporte+=$('<div />').append($(el).clone()).html();
		}
	});
	var result='';
	if (descImporte!="") {result='<ul class="dtosDescImporte">'+descImporte+'</ul>'}
	return result;
}
function calculaPortes(importe,idDireccion,callback) {
	$.post('<?=BASE_DIR.FILE_APP?>',{
		'MODULE':'actions',
		'acClase':'comprar_pedido',
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

function aplicaDtoVolumen() {
	ulDtosDel('dtoVolumen');

	var arrDtos=$('#newPedWizard').data('arrDtosVolumen');
	var volumen=$('#spTotalLineas').data('totalLineas');
	var tipoDto=0;

	//console.log(arrDtos);
	//console.log('Volumen pedido: '+volumen);

	for (i = 0; i < arrDtos.length; i++) {
		objDto=arrDtos[i];
		var volumenDto=parseFloat(objDto.volumen);
		if (volumenDto <= volumen) {
			tipoDto=objDto.tipo;
		}
	}
	//console.log('Dto volumen: '+tipoDto);
	if ($('#newPedWizard').data('tipoDtoCliente')<=0 || $('#newPedWizard').data('dtoClienteCompatibleDtoVolumen')) {
		if (tipoDto!=0) {
			//muestraMsgModal('Descuento por volumen aplicado.','Se aplicará un '+tipoDto+'% de descuento por volumen.');
			$('#divJqNotifications').data('jqNotifications')
				.addNotification('Descuento por volumen aplicado.','Se aplicará un '+tipoDto+'% de descuento por volumen.', 'info');
			ulDtosAdd('dtoVolumen','Descuento por volumen',tipoDto,'');
		}
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

function getLineas () {
	alert("*************************pillando lineas");
	//$.overlay({progress: {class:'progress-bar-success'}});
	$.post('<?=BASE_DIR.FILE_APP?>',{
		'MODULE':'actions',
		'acClase':'comprar_pedido',
		'acMetodo':'acGetLineas',
		'acTipo':'ajax',
		'session_name':'<?=$GLOBALS['session_name']?>'
	},
	function (response) {
		if (!response.exito){
			muestraMsgModal('Ha ocurrido un error en el calculo del pedido','Se ha producido el siguiente error durante el cálculo de importes de pedido:<br/>'+response.msg);
		} else {
			var arrLineas=response.data.arrLineas;
			var totalLineas=parseFloat(response.data.totalLineas).toFixed(2);
			var totalRebotes=parseFloat(response.data.totalRebotes).toFixed(2);
			var totalRebotesDesc=response.data.totalRebotesDesc;
			var creditoMaximoAplicable=parseFloat(response.data.creditoMaximoAplicable).toFixed(2);
			$('#tableLineas').data('arrLineas',arrLineas);
			//$('#spPortes').html(portes).data('portes',portes);
			$('.spTotalLineas').html(totalLineas).data('totalLineas',totalLineas);

			$('#spTotalRebotes').html(totalRebotes+'€').attr({
				'data-toggle'         : 'tooltip',
				'data-placement'      : 'top',
				'data-html'           : 'true',
				'data-original-title' : totalRebotesDesc,
				'title'               : totalRebotesDesc,
			}).data('totalRebotes',totalRebotes);
			if (totalRebotes>0) {$('#spTotalRebotes').closest('h4').show();} else {$('#spTotalRebotes').closest('h4').hide();}

			$('#panelCredito').data('creditoMaximoAplicable',creditoMaximoAplicable);
			$('#credito').attr({max:creditoMaximoAplicable}).val(creditoMaximoAplicable);
			$('#credito').trigger('input');
			$('#creditoMaximoAplicable').html(creditoMaximoAplicable+'€');
			aplicaDtoVolumen();
		}
	},
	'json')
	.always(function() {
		$.overlay('destroy');
		refreshTableLineas();
		calculaTotales();
		compruebaPanelCredito();
		$('[data-toggle="tooltip"]').tooltip({container:'body',html:true});
	});
}

function calculaTotales() {
	var totalLineas=$('#spTotalLineas').data('totalLineas');
	var dtoImporte=ulDtosTotalImporte().toFixed(2);
	var baseDtosPorcentuales=(totalLineas-dtoImporte).toFixed(2);
	var dtoTipo=ulDtosTotalTipo().toFixed(2);
	var restoToCredito=($('#panelCredito').data('importe_minimo_aplicacion_credito')-totalLineas).toFixed(2);
	var idDirEntrega=$('input[name="idDirEntrega"]:checked', '#direccionEntregaSelectionControl').val();

	$('#spRestoToCredito').html(restoToCredito).data('restoToCredito',restoToCredito);
	$('#spDtoTipo').html(dtoTipo).data('dtoTipo',dtoTipo);
	var dtoMonto=(Math.round(
			baseDtosPorcentuales*(ulDtosTotalTipo()/100)
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

function compruebaPanelCredito() {
	if ($('#spTotalLineas').data('totalLineas') > $('#panelCredito').data('importe_minimo_aplicacion_credito')) {
		$('#creditoPermitido').show();
		$('#creditoNoPermitido').hide();
	} else {
		$('#creditoPermitido').hide();
		$('#creditoNoPermitido').show();
	}
}
<?="\n/*".get_class()."*/\n"?>
