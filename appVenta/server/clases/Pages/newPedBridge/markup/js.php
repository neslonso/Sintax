<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();

	setInterval(function() {
		var _docHeight = (document.height !== undefined) ? document.height : document.body.offsetHeight;
		//var _docWidth = (document.width !== undefined) ? document.width : document.body.offsetWidth;
		var objMsg= {
			service: "newPedBridgeIframeHeight",
			parameters: _docHeight
		}
		parent.postMessage(objMsg, '*');
	}
	,100);

	ulDtosEmpty();
	if ($('#newPedWizard').data('tipoDtoCliente')>0) {
		ulDtosAdd('dtoCliente','Descuento cliente',$('#newPedWizard').data('tipoDtoCliente'),'');
	}

	/*
	$('#newPedWizard').on('stepclicked.fu.wizard', function (evt, data) {
	});
	*/

	$('#newPedWizard').on('actionclicked.fu.wizard', function (evt, data) {
		//console.log (data);
		if (data.step==1 && data.direction=='next') {
			$dirRadioChecked=$('input[name="idDirEntrega"]:checked', '#direccionEntregaSelectionControl');
			if (!$dirRadioChecked.length>0) {
				muestraMsgModal('Dirección de entega','Debe seleccionar una dirección de entrega para su pedido.');
				//$('#newPedWizard').wizard('selectedItem', {step:1});

				var veces=0;
				var intervalId=setInterval(function() {
					veces+=1;
					$('[data-target="#modalAddDir"]').toggleClass('btn-danger');
 					$('.panel','#direccionEntregaSelectionControl').toggleClass('panel-danger');
					if (veces>20) {
						$('[data-target="#modalAddDir"]').removeClass('btn-danger');
						$('.panel','#direccionEntregaSelectionControl').removeClass('panel-danger');
						clearInterval(intervalId);
					}
				}
				,250);
				evt.preventDefault();
			}
		}
	});

	$('#newPedWizard').on('changed.fu.wizard', function (evt, data) {
		btnNextAdjust(this,data.step);

		var ultimoPaso=$(this).find('.steps li').length;
		if (data.step==ultimoPaso-1) {
			$('#addCredito').click();
			aplicaDtoVolumen();
		}
		if (data.step==ultimoPaso) {
			var totalLineas=$('#spTotalLineas').data('totalLineas');

			var dtoImporte=ulDtosTotalImporte().toFixed(2);

			var baseDtosPorcentuales=(totalLineas-dtoImporte).toFixed(2);

			var dtoTipo=ulDtosTotalTipo().toFixed(2);

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

			$.overlay({
				progress: {class:'progress-bar-success'}
			});
			calculaPortes(
				$('#spTotalLineas').data('totalLineas'),
				$('input[name="idDirEntrega"]:checked', '#direccionEntregaSelectionControl').val(),
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

	});

	$('#newPedWizard').on('finished.fu.wizard', function (evt) {
		$dirRadioChecked=$('input[name="idDirEntrega"]:checked', '#direccionEntregaSelectionControl');
		if (!$dirRadioChecked.data()) {
			muestraMsgModal('Dirección de entega','Debe seleccionar una dirección de entrega para su pedido.');
			$('#newPedWizard').wizard('selectedItem', {step:1});
			return;
		}
		var destinatario=$dirRadioChecked.data('destinatario');
		var direccion=$dirRadioChecked.data('direccion');
		var poblacion=$dirRadioChecked.data('poblacion');
		var provincia=$dirRadioChecked.data('provincia');
		var cp=$dirRadioChecked.data('cp');
		var pais=$dirRadioChecked.data('pais');
		var telefono=$dirRadioChecked.data('movil');

		var nombre=$('#newPedWizard').data('nombreCliente');
		var apellidos=$('#newPedWizard').data('apellidosCliente');
		var email=$('#newPedWizard').data('emailCliente');
		var idMulti_cliente=$('#newPedWizard').data('idMulti_cliente');


		var objCmbCupon=$('#cuponCombo').combobox('selectedItem');
		var idCupon=objCmbCupon.id;
		if (typeof idCupon=='undefined') {idCupon=null;}
		var idMulti_cupon=idCupon;

		var portes=parseFloat($('#spPortes').data('portes'));

		var credito=$('#ulDtos').find('#dtoCredito').data('importe');
		if (typeof credito=='undefined') {credito=0;}

		var idPedidoModoPago=$('input[name="modoPago"]:checked').val();
		var lineas=[];
		$('.trLinea').each(function(index, el) {
			lineas.push($(this).data('objLinea'));
		});
		var dtos=[];
		$('#ulDtos>li').each (function () {
			//El crédito no se envía a guardar como un descuento, tiene su propio campo en el pedido
			if (!$(this).hasClass('dtoCredito')) {
				dtos.push($(this).data());
			}
		});
		var comentarios=$('#comentarios').val();
		var pedData={
			'nombre':nombre,
			'apellidos':apellidos,
			'destinatario':destinatario,
			'telefono':telefono,
			'email':email,
			'direccion':direccion,
			'cp':cp,
			'poblacion':poblacion,
			'provincia':provincia,
			'pais':pais,
			//'horario':'horario',
			'portes':portes,
			'credito':credito,
			//'notas':'notas',
			//'idUsuario':idUsuario,
			//'idCupon':idCupon,
			'idPedidoModoPago':idPedidoModoPago,
			//'keyTienda':'keyTienda',
			'idMulti_cliente':idMulti_cliente,
			'idMulti_cupon':idMulti_cupon,
			'lineas': lineas,
			'dtos':dtos,
			'comentarios':comentarios,
		}
		console.log(pedData);
		//if (confirm("¿Realizar el POST?")) {
			Post ('action','<?=BASE_DIR.FILE_APP?>',
				'MODULE','actions','acClase','newPedBridge','acMetodo','acGrabar','acTipo','stdAssoc',
				'pedData',pedData,'session_name','<?=$GLOBALS['session_name']?>'
			);
		//}
	});

	$('input[type=radio][name=modoPago]').change(function() {
		ulDtosDel('dtoModoPago');
		if ($(this).data('tipoDescuento')>0) {
			ulDtosAdd('dtoModoPago','Descuento por modo de pago',$(this).data('tipoDescuento'),'');
		}
	});
	$('#modoPago-0 input[type=radio]').change();

	$('#credito').on('input', function (e) {
		var value=parseFloat($(this).val()).toFixed(2);
		$('#creditoAplicar').data('creditoAplicar',value);
		$('#creditoAplicar').text(value+"€");
	});

	$('#addCredito').on('click', function () {
		var credito=$('#creditoAplicar').data('creditoAplicar');
		ulDtosDel('dtoCredito');
		if (credito>0) {
			muestraMsgModal('Crédito de cliente aplicado.','Se aplicarán '+credito+'€ de crédito de cliente.');
			ulDtosAdd('dtoCredito','Crédito de cliente','',credito);
		} else {
			muestraMsgModal('Crédito de cliente aplicado.','No se aplicará crédito de cliente.');
		}
	});

	/*
	$('#cuponCombo').on('changed.fu.combobox', function (evt, data) {
		$(this).data('dirty',true);
	});
	*/

	$('#addCupon').on('click', function () {
		ulDtosDel('dtoCupon');
		var comboSelectedItem=$('#cuponCombo').combobox('selectedItem');
		var codigoCupon=(comboSelectedItem.value)?comboSelectedItem.value:comboSelectedItem.text;
		if (codigoCupon!="") {
			$('#cuponCombo').combobox('disable');
			$('#addCupon').button('loading');
			$.post('<?=BASE_DIR.FILE_APP?>',{
				'MODULE':'actions',
				'acClase':'newPedBridge',
				'acMetodo':'acValidaCupon',
				'acTipo':'ajaxAssoc',
				'codigo':codigoCupon,
				'session_name':'<?=$GLOBALS['session_name']?>'
			},
			function (response) {
				console.log('Response cupon');
				console.log(response);
				if (!response.exito){
					muestraMsgModal('Error validando cupon','Se ha producido el siguiente error durante la validación del cupón:<br/>'+response.msg);
				} else {
					if (response.data.id) {
						if (!response.data.caducado && !response.data.utilizado) {
							muestraMsgModal('El cupón introducido es válido.','Se aplicará el descuento del cupón ('+response.data.tipoDescuento+'%)');
							var msgAplicable='';
							if (response.data.restringido) {
								msgAplicable='<p class="help-block">Aplicable sólo a los productos indicados en el cupón</p>';
							}
							ulDtosAdd('dtoCupon','Descuento cupón '+response.data.codigo+''+msgAplicable,response.data.tipoDescuento,'');
							$('#cuponSelectionControl').replaceWith(response.data.combo);
						} else {
							if (response.data.caducado) {
								muestraMsgModal('El cupón introducido no es válido.','El cupón '+response.data.codigo+' ha caducado.');
							} else if (response.data.utilizado) {
								muestraMsgModal('El cupón introducido no es válido.','Usted ya ha utiilizado utilizado el cupón '+response.data.codigo+' en otro pedido.');
							}
						}
					} else {
						muestraMsgModal('El cupón introducido no es válido.','No se ha encontrado el cupón "'+response.data.codigo+'".');
					}
				}
			},
			'json'
			).fail(function () {
				muestraMsgModal('Fallo en la carga de datos de cupón','No fue posible validar el cupón introducido, por favor, intentelo de nuevo más tarde o utilize un cupón diferente.');
			}).always(function () {
				$('#cuponCombo').combobox('enable');
				$('#addCupon').button('reset');
			});
		} else {
			muestraMsgModal('Código de cupón no introducido','Debe introducir el codigo del cupón que desea aplicar a su pedido o escoger de la lista.');
		}
	});

	$('#btnAddDir').on('click', function () {
		$.post('<?=BASE_DIR.FILE_APP?>',{
			'MODULE':'actions',
			'acClase':'newPedBridge',
			'acMetodo':'acAddDireccion',
			'acTipo':'ajaxAssoc',
			'id':0,
			'nombre':$('#nombre','#modalAddDir').val(),
			'destinatario':$('#destinatario','#modalAddDir').val(),
			'movil':$('#movil','#modalAddDir').val(),
			'direccion':$('#direccion','#modalAddDir').val(),
			'poblacion':$('#poblacion','#modalAddDir').val(),
			'provincia':$('#provincia','#modalAddDir').val(),
			'cp':$('#cp','#modalAddDir').val(),
			'pais':$('#pais','#modalAddDir').val(),
			'session_name':'<?=$GLOBALS['session_name']?>'
		},
		function (response) {
			console.log(response);
			if (!response.exito){
				muestraMsgModal('Error añadiendo dirección',response.msg);
			} else {
				$('#modalAddDir').modal('hide');
				$('#direccionEntregaSelectionControl').replaceWith(response.data);
				$('[name="idDirEntrega"]').change();
			}
		},
		'json');
	});


	$('body')
	.on('change', '[name="idDirEntrega"]', function (e) {
 		$('.panel','#direccionEntregaSelectionControl').removeClass('panel-success').addClass('panel-default');
		$(this).closest('.panel').removeClass('panel-default').addClass('panel-success');
	});
});

/*****************************************************************************/
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
	return '<ul>'+descTipo+'</ul>';
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
	if (descImporte!="") {result='<ul>'+descImporte+'</ul>'}
	return result;
}
/*****************************************************************************/

function btnNextAdjust(wizard,paso) {
	var ultimoPaso=$(wizard).find('.steps li').length;
	if (paso==ultimoPaso) {
		$(wizard).find('.actions .btn-next').removeClass('btn-primary').addClass('btn-warning');
	} else {
		$(wizard).find('.actions .btn-next').removeClass('btn-warning').addClass('btn-primary');
	}
}

function calculaPortes(importe,idDireccion,callback) {
	$.post('<?=BASE_DIR.FILE_APP?>',{
		'MODULE':'actions',
		'acClase':'newPedBridge',
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

	console.log(arrDtos);
	console.log(volumen);

	for (i = 0; i < arrDtos.length; i++) {
		objDto=arrDtos[i];
		if (objDto.volumen <= volumen) {
			tipoDto=objDto.tipo;
		}
	}
	if (tipoDto!=0) {
		muestraMsgModal('Descuento por volumen aplicado.','Se aplicará un '+tipoDto+'% de descuento por volumen.');
		ulDtosAdd('dtoVolumen','Descuento por volumen',tipoDto,'');
	}
}

function msgRedirect() {
	bootbox.dialog({
		message:'Es necesario seleccionar al menos un producto para poder realizar su pedido',
		title:'Su pedido no contiene ningún producto',
		onEscape: false,
		closeButton: false,
		buttons: {
			aceptar: {
				label: 'Aceptar',
				classname: 'btn-primary',
				callback: function () {
					var objMsg= {
						service: "redirect",
						parameters: "root"
					}
					parent.postMessage(objMsg, "*");
					return false;
				}
			}
		}
	});
}
<?="\n/*".get_class()."*/\n"?>