<?if (false) {?><script><?}?>
$(document).ready(function() {
	$('#tabsOferta a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
console.log("*************************ini");
	getLineas();
console.log("*************************fin");
	$('#btnModalSelDir').on('click',function(event) {
		event.preventDefault();
		$('#modalSelDir').appendTo('body').modal('show');
	});
	$('body')
	.on('change', '[name="idDirEntrega"]', function (e) {
 		$('.panel','#direccionEntregaSelectionControl').removeClass('panel-success').addClass('panel-default');
		$(this).closest('.panel').removeClass('panel-default').addClass('panel-success');
		$('#modalSelDir').appendTo('body').modal('hide');
		$('#dirSeleccionada').html();
		var idDirEntrega=$('input[name="idDirEntrega"]:checked', '#direccionEntregaSelectionControl').val();
alert("dirEntrega:".idDirEntrega);
	});
	$('#btnAddDir').on('click', function () {
		var destinatario = $('#destinatario','#modalAddDir').val();
		var direccion    = $('#direccion'   ,'#modalAddDir').val();
		var poblacion    = $('#poblacion'   ,'#modalAddDir').val();
		var provincia    = $('#provincia'   ,'#modalAddDir').val();
		var cp           = $('#cp'          ,'#modalAddDir').val();
		var pais         = $('#pais'        ,'#modalAddDir').val();
		var movil        = $('#movil'       ,'#modalAddDir').val();
		if (destinatario.trim()=="" || direccion.trim()=="" || poblacion.trim()=="" || provincia.trim()=="" || cp.trim()=="" || movil.trim()==""){
			muestraMsgModal('Error en el formulario','Por favor, rellene todos los campos marcados como obligatorios (<b>*</b>) de la dirección');
		} else {
			$.post('<?=BASE_DIR.FILE_APP?>',{
				'MODULE':'actions',
				'acClase':'mis_datos',
				'acMetodo':'acCheckCP',
				'acTipo':'ajax',
				'cp':cp,
				'pais':pais
			},
			function (response) {
				if (!response.data.resultado.valor){
					muestraMsgModal('Error',response.data.resultado.msg);
				} else {
					$.post('<?=BASE_DIR.FILE_APP?>',{
						'MODULE'      : 'actions',
						'acClase'     : 'comprar_pedido',
						'acMetodo'    : 'acAddDireccion',
						'acTipo'      : 'ajaxAssoc',
						'id'          : 0,
						'nombre'      : $('#nombre','#modalAddDir').val(),
						'destinatario': $('#destinatario','#modalAddDir').val(),
						'movil'       : $('#movil','#modalAddDir').val(),
						'direccion'   : $('#direccion','#modalAddDir').val(),
						'poblacion'   : $('#poblacion','#modalAddDir').val(),
						'provincia'   : $('#provincia','#modalAddDir').val(),
						'cp'          : $('#cp','#modalAddDir').val(),
						'pais'        : $('#pais','#modalAddDir').val(),
						'session_name': '<?=$GLOBALS['session_name']?>'
					},
					function (response) {
						//console.log(response);
						if (!response.exito){
							muestraMsgModal('Error añadiendo dirección',response.msg);
						} else {
							$('#modalSelDir').modal('hide');
							$('#direccionEntregaSelectionControl').replaceWith(response.data);
							$('[name="idDirEntrega"]').change();
							var idDirEntrega=$('input[name="idDirEntrega"]:checked', '#direccionEntregaSelectionControl').val();
alert("dirEntrega:".idDirEntrega);
						}
					},
					'json');
				}
			},
			'json');
		}
	});
});

/******************************************************************************/
function ulDtosEmpty() {
	$('#ulDtos').find('li').remove().end()
		.append('<li id="noDtos" class="noDtos">No se aplicará ningún descuento</li>')
		.data('empty',true);
}

function ulDtosAdd(id,concepto,tipo,importe) {
console.log("ulDtosAdd ini");
	var $ulDtos=$('#ulDtos');
	if ($ulDtos.data('empty')) {
		$ulDtos.find('li').remove();
	}
	var dtoDesc='';
	if (tipo!='') {dtoDesc=tipo+'%';} else {dtoDesc=importe+'€';}
	var denominacion=concepto+': '+dtoDesc
	$ulDtos.append('<li id="'+id+'" class="'+id+'" data-concepto="'+concepto+'" data-tipo="'+tipo+'" data-importe="'+importe+'">'+denominacion+'</li>');
	$ulDtos.data('empty',false);
console.log("ulDtosAdd fin");
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
console.log("*************************aplicaDtoVolumen ini");
	ulDtosDel('dtoVolumen');
console.log("*************************aplicaDtoVolumen 1");
	var arrDtos=$('#newPedWizard').data('arrDtosVolumen');
	var volumen=$('#spTotalLineas').data('totalLineas');
	var tipoDto=0;

	console.log(arrDtos);
	console.log('Volumen pedido: '+volumen);
console.log("*************************aplicaDtoVolumen 2");
	for (i = 0; i < arrDtos.length; i++) {
		objDto=arrDtos[i];
		var volumenDto=parseFloat(objDto.volumen);
		if (volumenDto <= volumen) {
			tipoDto=objDto.tipo;
		}
	}
console.log("*************************aplicaDtoVolumen 3");
	console.log('Dto volumen: '+tipoDto);
	if ($('#newPedWizard').data('tipoDtoCliente')<=0 || $('#newPedWizard').data('dtoClienteCompatibleDtoVolumen')) {
		if (tipoDto!=0) {
console.log ("tipoDto != 0");
			//muestraMsgModal('Descuento por volumen aplicado.','Se aplicará un '+tipoDto+'% de descuento por volumen.');
			/*$('#divJqNotifications').data('jqNotifications')
				.addNotification('Descuento por volumen aplicado.','Se aplicará un '+tipoDto+'% de descuento por volumen.', 'info');
			*/
console.log("añadimos el descuento por volumen INI");
			ulDtosAdd('dtoVolumen','Descuento por volumen',tipoDto,'');
console.log("añadimos el descuento por volumen FIN");
		}
	}
console.log("*************************aplicaDtoVolumen fin");
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
console.log("*************************getlineas");
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
console.log("*************************getlineas1");
			$('#tableLineas').data('arrLineas',arrLineas);
			//$('#spPortes').html(portes).data('portes',portes);
console.log("*************************getlineas2");
			$('.spTotalLineas').html(totalLineas).data('totalLineas',totalLineas);
console.log("*************************getlineas3");
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
console.log("*************************getlineas4");
			aplicaDtoVolumen();
console.log("*************************getlineas5");
		}
	},
	'json')
	.always(function() {
		//$.overlay('destroy');
console.log("*************************vamos a refreshTableLineas");
		refreshTableLineas();
console.log("*************************vamos a calculaTotales");
		calculaTotales();
console.log("*************************vamos a compruebaPanelCredito");
		compruebaPanelCredito();
		$('[data-toggle="tooltip"]').tooltip({container:'body',html:true});
	});
}

function calculaTotales() {
console.log("***************************** calculaTotales INI")	;
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
		//$.overlay({progress: {class:'progress-bar-success'}});
		calculaPortes(
			totalLineas,
			idDirEntrega,
			function() {
				var portes=parseFloat($('#spPortes').data('portes'));
				$('#spPortes').html(portes.toFixed(2));

				console.log('totalLineas: ' + totalLineas);
				console.log('dtoImporte: ' + dtoImporte);
				console.log('baseDtosPorcentuales: ' + baseDtosPorcentuales);
				console.log('dtoMonto: ' + dtoMonto);
				console.log('portes: ' + portes);

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
console.log("***************************** calculaTotales FIN")	;
}

function compruebaPanelCredito() {
console.log("compruebaPanelCredito INI");
	if ($('#spTotalLineas').data('totalLineas') > $('#panelCredito').data('importe_minimo_aplicacion_credito')) {
		$('#creditoPermitido').show();
		$('#creditoNoPermitido').hide();
	} else {
		$('#creditoPermitido').hide();
		$('#creditoNoPermitido').show();
	}
console.log("compruebaPanelCredito FIN");
}
<?="\n/*".get_class()."*/\n"?>
