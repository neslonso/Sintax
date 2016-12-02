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

});
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
	var creditoMaximoAplicable=$('#tableLineas').data('creditoMaximoAplicable');
	//$('#creditoMaximoAplicable').html(creditoMaximoAplicable+'€');
	//if (creditoMaximoAplicable>0) {$('#creditoMaximoAplicable').closest('h4').show();} else {$('#creditoMaximoAplicable').closest('h4').hide();}
	//aplicar el credito

	//dtoXtipo=descCliente+modoPago+cupon+volumen
	//storedata->if descuento cliente y cupon compatibles? -> dtoClienteCompatibleCupon
	//dtoClientecompatibleDtoVolumen (dtosvolumenpedido)
	//modopago ->tarjeta (arraysmodospago) 	//xtipo=descCliente+modoPago+cupon FUnc new de modos pago('tarjeta') y me devuelve la id y con eso ya saco el descuento.
	//cupon de mayor desc q tiene el pavo. Ordenar por descuento y a igualdad por fecha, el q caduque antes y enchufarselo.
	//descliente


	/*
	$('#credito').attr({max:creditoMaximoAplicable}).val(creditoMaximoAplicable);
	$('#credito').trigger('input');

	aplicaDtoVolumen();
	var dtoImporte=ulDtosTotalImporte().toFixed(2);
	var dtoTipo=ulDtosTotalTipo().toFixed(2);
	var totalLineas=$('#spTotalLineas').data('totalLineas');
	var restoToCredito=($('#panelCredito').data('importe_minimo_aplicacion_credito')-totalLineas).toFixed(2);
	$('#spRestoToCredito').html(restoToCredito).data('restoToCredito',restoToCredito);
	calculaTotales(dtoImporte, dtoTipo, ulDtosTotalTipo(), ulDtosDescTipo(), ulDtosDescImporte(), idDirEntrega);
	*/
	var idDirEntrega=$('input[name="idDirEntrega"]:checked', '#direccionEntregaSelectionControl').val();
	var dir=$('input[name="idDirEntrega"]:checked', '#direccionEntregaSelectionControl');
	var txtDireccion=dir.data('destinatario')+" - "+dir.data('direccion')+' '+dir.data('cp')+', '+dir.data('poblacion')+' '+dir.data('provincia');
	$('#dirSeleccionada').html(txtDireccion);
	calculaTotales(creditoMaximoAplicable, 0, 0, 0, 0, idDirEntrega);
}
<?="\n/*".get_class()."*/\n"?>
