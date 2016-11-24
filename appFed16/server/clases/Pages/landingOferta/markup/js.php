<?if (false) {?><script><?}?>
$(document).ready(function() {
	$('#tabsOferta a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
	if($('#newPedWizard').length != 0) {
console.log("*************************ini");
	getLineas();
console.log("*************************fin");
	}
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












<?="\n/*".get_class()."*/\n"?>
