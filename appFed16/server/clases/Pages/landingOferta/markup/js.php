<?if (false) {?><script><?}?>
$(document).ready(function() {
	$('#tabsOferta a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
	$('#btnModalSelDir').on('click',function(event) {
		event.preventDefault();
		$('#modalSelDir').appendTo('body').modal('show');
	});
	$('body')
	.on('change', '[name="idDirEntrega"]', function (e) {
 		$('.panel','#direccionEntregaSelectionControl').removeClass('panel-success').addClass('panel-default');
		$(this).closest('.panel').removeClass('panel-default').addClass('panel-success');
		$('#modalSelDir').appendTo('body').modal('hide');
		var idDirEntrega=$('input[name="idDirEntrega"]:checked', '#direccionEntregaSelectionControl').val();
		var dir=$('input[name="idDirEntrega"]:checked', '#direccionEntregaSelectionControl');
		var txtDireccion=dir.data('destinatario')+" - "+dir.data('direccion')+' '+dir.data('cp')+', '+dir.data('poblacion')+' '+dir.data('provincia');
		$('#dirSeleccionada').html(txtDireccion);
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
							var txtDireccion=$('#destinatario','#modalAddDir').val()+" - "+$('#direccion','#modalAddDir').val()+' '+$('#cp','#modalAddDir').val()+', '+$('#poblacion','#modalAddDir').val()+' '+$('#provincia','#modalAddDir').val();
							$('#dirSeleccionada').html(txtDireccion);
						}
					},
					'json');
				}
			},
			'json');
		}
	});
	$('#btnAddCesta').on('click', function () {
		$.post('<?=BASE_DIR.FILE_APP?>',{
			'MODULE'      : 'actions',
			'acClase'     : 'landingOferta',
			'acMetodo'    : 'acAddToCestaOferta',
			'acTipo'      : 'ajaxAssoc',
			'idOfer'      : $('#idOfer').val(),
			'session_name': '<?=$GLOBALS['session_name']?>'
		},
		function (response) {
			location.href="<?=BASE_URL?>/comprar_pedido";
		},
		'json');
	});
	$('#btnPagar').on('click', function (evt) {
		$dirRadioChecked=$('input[name="idDirEntrega"]:checked', '#direccionEntregaSelectionControl');
		if (!$dirRadioChecked.data()) {
			muestraMsgModal('Dirección de entega','Debe seleccionar una dirección de entrega para su pedido.');
			return;
		}
		var destinatario    = $dirRadioChecked.data('destinatario');
		var direccion       = $dirRadioChecked.data('direccion');
		var poblacion       = $dirRadioChecked.data('poblacion');
		var provincia       = $dirRadioChecked.data('provincia');
		var cp              = $dirRadioChecked.data('cp');
		var pais            = $dirRadioChecked.data('pais');
		var telefono        = $dirRadioChecked.data('movil');
		var nombre          = $('#newPedWizard').data('nombreCliente');
		var apellidos       = $('#newPedWizard').data('apellidosCliente');
		var email           = $('#newPedWizard').data('emailCliente');
		var idMulti_cliente = $('#newPedWizard').data('idMulti_cliente');

		var idCupon=$('#newPedWizard').data('idCupon');
		if (idCupon=='') {idCupon=null;}
		var idMulti_cupon=idCupon;

		var portes=parseFloat($('#spPortes').data('portes'));

		var credito=$('#tableLineas').data('creditoMaximoAplicable');
		if (typeof credito=='') {credito=0;}

		var idPedidoModoPago=$('#newPedWizard').data('idTipoModoPago');
		var lineas=[];
		$('.trLinea').each(function(index, el) {
			lineas.push($(this).data('objLinea'));
		});
		if (lineas.length==0) {
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
							//window.location.replace("<?=BASE_URL?>");
							//return false;
						}
					}
				}
			});
			return;
		}

		var dtos=[];
		$('#ulDtos>li').each (function () {
			//El crédito no se envía a guardar como un descuento, tiene su propio campo en el pedido
			if (!$(this).hasClass('dtoCredito')) {
				dtos.push($(this).data());
			}
		});
		var comentarios="";

		var pedData={
			'nombre'           : nombre,
			'apellidos'        : apellidos,
			'destinatario'     : destinatario,
			'telefono'         : telefono,
			'email'            : email,
			'direccion'        : direccion,
			'cp'               : cp,
			'poblacion'        : poblacion,
			'provincia'        : provincia,
			'pais'             : pais,
			//'horario'        : 'horario',
			'portes'           : portes,
			'credito'          : credito,
			//'notas'          : 'notas',
			//'idUsuario'      : idUsuario,
			//'idCupon'        : idCupon,
			'idPedidoModoPago' : idPedidoModoPago,
			//'keyTienda'      : 'keyTienda',
			'idMulti_cliente'  : idMulti_cliente,
			'idMulti_cupon'    : idMulti_cupon,
			'lineas'           :  lineas,
			'dtos'             : dtos,
			'comentarios'      : comentarios,
		}
		$.post('<?=BASE_DIR.FILE_APP?>',{
			'MODULE'      : 'actions',
			'acClase'     : 'landingOferta',
			'acMetodo'    : 'acGrabar',
			'acTipo'      : 'ajaxAssoc',
			'pedData'     :  pedData,
			'session_name': '<?=$GLOBALS['session_name']?>'
		},
		function (response) {
			$.post('<?=BASE_DIR.FILE_APP?>',{
				'MODULE'      : 'actions',
				'acClase'     : 'landingOferta',
				'acMetodo'    : 'acGetFormTpvv',
				'acTipo'      : 'ajaxAssoc',
				'idPedido'    :  response.data,
				'keyTienda'	  :  '<?=$GLOBALS['config']->tienda->key?>',
				'session_name': '<?=$GLOBALS['session_name']?>'
			},
			function (response) {
				$('#divFormTPVV').html(response.data.html);
				$('#formTpvv').submit();
			},
			'json');
		},
		'json');
	});
});
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
function callbackLandingOferta(){
	var totalRebotes=$('#tableLineas').data('totalRebotes');
	var totalRebotesDesc=$('#tableLineas').data('totalRebotesDesc');
	$('#spTotalRebotes').html(totalRebotes+'€').attr({
		'data-toggle'         : 'tooltip',
		'data-placement'      : 'top',
		'data-html'           : 'true',
		'data-original-title' : totalRebotesDesc,
		'title'               : totalRebotesDesc,
	});
	if (totalRebotes>0) {$('#spTotalRebotes').closest('h4').show();} else {$('#spTotalRebotes').closest('h4').hide();}
	var dtoImporteTotal=0; //dtoXimporte=credito
	var dtoImporteTotalDesc="";
	var dtoTipoTotal=0; //dtoXtipo=descCliente+modoPago+cupon+volumen
	var dtoTipoTotalDesc="";
	//**** DESCUENTOS POR IMPORTE ****
	//desc importe credito
	dtoImporteTotal+=parseFloat($('#tableLineas').data('creditoMaximoAplicable'));
	dtoImporteTotalDesc+="<li>Crédito de cliente:"+dtoImporteTotal+"€</li>";
	ulDtosAdd('dtoCredito','Crédito de cliente','',dtoImporteTotal);
	//**** DESCUENTOS POR TIPO ****
	//desc cupon
	if ($('#newPedWizard').data('tipoDtoCliente')<=0 || $('#newPedWizard').data('dtoClienteCompatibleCupon')) {
		//cupon de mayor descuento. Ordenar por descuento y a igualdad por fecha, el q caduque antes.
		var arrCupones=$('#newPedWizard').data('arrCupones');
		if (arrCupones.length>0){
			objCupon=arrCupones[0];
			dtoTipoTotal+=parseFloat(objCupon.tipoDescuento);
			dtoTipoTotalDesc+="<li>Descuento cupón "+objCupon.codigo+":"+objCupon.tipoDescuento+"%</li>";
			$('#newPedWizard').data('idCupon',objCupon.id);
			ulDtosAdd('dtoCupon','Descuento cupón '+objCupon.codigo,objCupon.tipoDescuento,'');
		}
	}
	//desc volumen
	var arrDtos=$('#newPedWizard').data('arrDtosVolumen');
	var volumen=$('#spTotalLineas').data('totalLineas');
	var tipoDto=0;
	for (i = 0; i < arrDtos.length; i++) {
		objDto=arrDtos[i];
		var volumenDto=parseFloat(objDto.volumen);
		if (volumenDto <= volumen) {
			tipoDto=objDto.tipo;
		}
	}
	if ($('#newPedWizard').data('tipoDtoCliente')<=0 || $('#newPedWizard').data('dtoClienteCompatibleDtoVolumen')) {
		if (tipoDto!=0) {
			dtoTipoTotal+=parseFloat(tipoDto);
			dtoTipoTotalDesc+="<li>Descuento por volumen:"+tipoDto+"%</li>";
			ulDtosAdd('dtoVolumen','Descuento por volumen',tipoDto,'');
		}
	}
	//desc cliente
	if ($('#newPedWizard').data('tipoDtoCliente')>0 ){
		dtoTipoTotal+=parseFloat($('#newPedWizard').data('tipoDtoCliente'));
		dtoTipoTotalDesc+="<li>Descuento cliente:"+$('#newPedWizard').data('tipoDtoCliente')+"%</li>";
		ulDtosAdd('dtoCliente','Descuento cliente',$('#newPedWizard').data('tipoDtoCliente'),'');
	}
	//desc modo pago
	var idTipoModoPago=$('#newPedWizard').data('idTipoModoPago');
	var arrModosPago=$('#newPedWizard').data('arrModosPago');
	for (i = 0; i < arrModosPago.length; i++) {
		objModoPago=arrModosPago[i];
		if (objModoPago.id == idTipoModoPago) {
			dtoTipoTotal+=parseFloat(objModoPago.tipoDescuento);
			dtoTipoTotalDesc+="<li>Descuento por modo de pago:"+parseFloat(objModoPago.tipoDescuento)+"%</li>";
			ulDtosAdd('dtoModoPago','Descuento por modo de pago',parseFloat(objModoPago.tipoDescuento),'');
		}
	}
	//dir entrega
	var idDirEntrega=$('input[name="idDirEntrega"]:checked', '#direccionEntregaSelectionControl').val();
	var dir=$('input[name="idDirEntrega"]:checked', '#direccionEntregaSelectionControl');
	var txtDireccion=dir.data('destinatario')+" - "+dir.data('direccion')+' '+dir.data('cp')+', '+dir.data('poblacion')+' '+dir.data('provincia');
	$('#dirSeleccionada').html(txtDireccion);
	//TOTALES
	calculaTotales(dtoImporteTotal, dtoTipoTotal, dtoTipoTotal, dtoTipoTotalDesc, dtoImporteTotalDesc, idDirEntrega);
	//portes gratis
	var portes=parseFloat($('#spPortes').data('portes'));
	if (portes>0){
		$('.imgPortesGratis').hide();
	} else {
		$('.imgPortesGratis').show();
	}
}
<?="\n/*".get_class()."*/\n"?>
