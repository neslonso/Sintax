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
	$('#newPedWizard').on('actionclicked.fu.wizard', function (evt, data) {
	});
	$('#newPedWizard').on('stepclicked.fu.wizard', function (evt, data) {
	});
	*/

	$('#newPedWizard').on('changed.fu.wizard', function (evt, data) {
		//evt.preventDefault();
		//console.log (data);
		btnNextAdjust(this,data.step);

		var ultimoPaso=$(this).find('.steps li').length;
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

		}

	});

	$('#newPedWizard').on('finished.fu.wizard', function (evt) {
		var objSlDirEntrega=$('#slDirEntrega').selectlist('selectedItem');
		var nombre=objSlDirEntrega.nombre;
		var apellidos=objSlDirEntrega.apellidos;
		var telefono=objSlDirEntrega.telefono;
		var email=objSlDirEntrega.email;
		var direccion=objSlDirEntrega.direccion;
		var cp=objSlDirEntrega.cp;
		var poblacion=objSlDirEntrega.poblacion;
		var provincia=objSlDirEntrega.provincia;

		var idUsuario=objSlDirEntrega.id;

		var objCmbCupon=$('#cuponCombo').combobox('selectedItem');
		var idCupon=objCmbCupon.id;

		var portes=parseFloat($('#spPortes').data('portes'));

		//var credito=$('#creditoAplicar').data('creditoAplicar');
		var credito=$('#ulDtos').find('#dtoCredito').data('importe');

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
			'telefono':telefono,
			'email':email,
			'direccion':direccion,
			'cp':cp,
			'poblacion':poblacion,
			'provincia':provincia,
			//'horario':'horario',
			'portes':portes,
			'credito':credito,
			//'notas':'notas',
			'idUsuario':idUsuario,
			'idCupon':idCupon,
			'idPedidoModoPago':idPedidoModoPago,
			//'keyTienda':'keyTienda',
			'lineas': lineas,
			'dtos':dtos,
			'comentarios':comentarios
		}
		console.log(pedData);
		if (confirm("¿Realizar el POST?")) {
			Post ('action','<?=BASE_DIR.FILE_APP?>',
				'MODULE','actions','acClase','newPedBridge','acMetodo','acGrabar','acTipo','stdAssoc',
				'pedData',pedData
			);
		}
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


	$('#cuponCombo').on('changed.fu.combobox', function (evt, data) {
		$(this).data('dirty',true);
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

	$('#addCupon').on('click', function () {
		ulDtosDel('dtoCupon');
		var comboSelectedItem=$('#cuponCombo').combobox('selectedItem');
		var codigoCupon=(comboSelectedItem.value)?comboSelectedItem.value:comboSelectedItem.text;
		if (codigoCupon!="") {
			var hash='';
			var store=$('#newPedWizard').data('store');
			var urlAPI='http://farmaciacelorrio.com/api.php?APP=appMulti&service=NEW_PED_BRIDGE&subService=getCuponByCode&store='+store+'&cuponCode='+codigoCupon+'&hash='+hash;
			$('#cuponCombo').combobox('disable');
			$('#addCupon').button('loading');
			$.get(urlAPI,
				function (response,textStatus,jqXHR) {
					console.log(response);
					if (response) {
						if (!response.caducado) {
							//$('#cupon').prop('disabled', true).addClass('ui-state-disabled');
							//btnAddCupon.value="Eliminar cupón";

							muestraMsgModal('El cupón introducido es válido.','Se aplicará el descuento del cupón ('+response.tipoDescuento+'%)');

							var msgAplicable='';
							if (response.restringido) {
								msgAplicable='<p class="help-block">Aplicable sólo a los productos indicados en el cupón</p>';
							}
							ulDtosAdd('dtoCupon','Descuento cupón '+response.codigo+''+msgAplicable,response.tipoDescuento,'');//response.codigo o response.id van a tener que ir en el UL??
						} else {
							muestraMsgModal('El cupón introducido no es válido.','El cupón '+response.codigo+' ha caducado.');
						}
					} else {
						muestraMsgModal('El cupón introducido no es válido.','No se ha encontrado el cupón "'+codigoCupon+'".');
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
			muestraMsgModal('Código de cupón no introducido','Debe introducir el codigo del cupón que desea aplicar a su pedido.');
		}
	});

	$('#btnAddDir').on('click', function () {
		console.log("addDir");
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
			'pais':$('#pais','#modalAddDir').val()
		},
		function (response) {
			console.log(response);
			if (!response.data.resultado.valor){
				muestraMsgModal('Error añadiendo dirección',response.data.resultado.msg);
			} else {
				$('#modalAddDir').modal('hide');
				//$('#slDirEntrega ').selectlist('destroy');
				var id=1;
				var nombre=2;
				var apellidos=3;
				var telefono=4;
				var email=5;
				var direccion=response.data.datos.direccion;
				var cp=response.data.datos.cp;
				var poblacion=response.data.datos.poblacion;
				var provincia=response.data.datos.provincia;
				var idDireccion=10;
				var denominacion=nombre+' ('+direccion+', '+cp+', '+poblacion+', '+provincia+')';
				var $li=$('<li />')
					.attr('data-id',id)
					.attr('data-nombre',nombre)
					.attr('data-apellidos',apellidos)
					.attr('data-telefono',telefono)
					.attr('data-email',email)
					.attr('data-direccion',direccion)
					.attr('data-cp',cp)
					.attr('data-poblacion',poblacion)
					.attr('data-provincia',provincia)
					.attr('data-idDireccion',idDireccion)
					.append(
						$('<a>')
							.attr('href','#')
							.html(denominacion)
					);
				$('#slDirEntrega ul').append($li);

				//$('#slDirEntrega').selectlist('destroy');
				$('#slDirEntrega').selectlist();
				//$('#slDirEntrega ul')
			}
		},
		'json');
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

function btnNextAdjust(wizard,paso) {
	var ultimoPaso=$(wizard).find('.steps li').length;
	if (paso==ultimoPaso) {
		$(wizard).find('.actions .btn-next').removeClass('btn-primary').addClass('btn-warning');
	} else {
		$(wizard).find('.actions .btn-next').removeClass('btn-warning').addClass('btn-primary');
	}
}
<?="\n/*".get_class()."*/\n"?>