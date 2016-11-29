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
function callbackLandingOferta(){
	/*
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
	$('#credito').attr({max:creditoMaximoAplicable}).val(creditoMaximoAplicable);
	$('#credito').trigger('input');
	$('#creditoMaximoAplicable').html(creditoMaximoAplicable+'€');
	aplicaDtoVolumen();
	var dtoImporte=ulDtosTotalImporte().toFixed(2);
	var dtoTipo=ulDtosTotalTipo().toFixed(2);
	var totalLineas=$('#spTotalLineas').data('totalLineas');
	var restoToCredito=($('#panelCredito').data('importe_minimo_aplicacion_credito')-totalLineas).toFixed(2);
	$('#spRestoToCredito').html(restoToCredito).data('restoToCredito',restoToCredito);
	var idDirEntrega=$('input[name="idDirEntrega"]:checked', '#direccionEntregaSelectionControl').val();
	calculaTotales(dtoImporte, dtoTipo, ulDtosTotalTipo(), ulDtosDescTipo(), ulDtosDescImporte(), idDirEntrega);
	*/
	calculaTotales(0, 0, 0, 0, 0, 1);
}
<?="\n/*".get_class()."*/\n"?>
