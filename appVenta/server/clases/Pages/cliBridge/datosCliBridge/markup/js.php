<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
var _top=0;
var _scrollTop=0;

function grabarDireccion(id){
	$('#frmCliDir'+id).submit();
}

function borrarDireccion(id){
	bootbox.dialog({
		message:'¿Confirma que desea eliminar la dirección?',
		title:'Eliminar dirección',
		onEscape: true,
		buttons: {
			confirmar: {
				label: 'Si, eliminar dirección',
				classname: 'btn-danger',
				callback: function () {
					//Post ('action','<?=BASE_DIR.FILE_APP?>','MODULE','actions','acClase','datosCliBridge','acMetodo','borrarDireccion','acTipo','stdAssoc','id',id);
					$.post('<?=BASE_DIR.FILE_APP?>',{
						'MODULE':'actions',
						'acClase':'datosCliBridge',
						'acMetodo':'borrarDireccion',
						'acTipo':'ajax',
						'hash':$('#hash').val(),
						'id':id
					},
					function (response) {
						$('#panelDir'+id).remove();
						muestraMsgModal('Direcciones de entrega','La dirección se ha eliminado correctamente');
					},
					'json');
				}
			},
			cancelar: {
				label: 'No',
				classname: 'btn-primary'
			}
		}
	});
}

$(document).ready(function() {
	"use strict";

	setInterval(function() {
		var _docHeight = (document.height !== undefined) ? document.height : document.body.offsetHeight;
		//var _docWidth = (document.width !== undefined) ? document.width : document.body.offsetWidth;
		var objMsg= {
			service: "datosCliBridgeIframeHeight",
			parameters: _docHeight
		}
		parent.postMessage(objMsg, '*');
	}
	,100);

	window.addEventListener('message', function(event) {
		// IMPORTANT: Check the origin of the data!
		if (~event.origin.indexOf('celorriofarma')) {
			// The data has been sent from your site. The data sent with postMessage is stored in event.data
			switch (event.data.service) {
				case 'scrollInfo':
					_top=event.data.parameters._top;
					_scrollTop=event.data.parameters._scrollTop;
					//console.log(event.data.parameters);
					break;
				default:
					console.log('FED16: BAD DATA');
					console.log(event);
					break;
			}
		} else {
			// The data hasn't been sent from your site!. Be careful! Do not use it.
			console.log('FED16: BAD ORIGIN');
			return;
		}
	});


	var dtLanguage={
		"sProcessing":   "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ elementos por página",
		"sZeroRecords": "No se encontraron resultados",
		"sInfo": "Mostrando del _START_ al _END_ de _TOTAL_ elementos",
		"sInfoEmpty": "Sin resuldados",
		"sInfoFiltered": "(buscando entre _MAX_ elementos en total)",
		"sInfoPostFix":  "",//This information will be appended to the sInfo (sInfo, sInfoEmpty and sInfoFiltered in whatever combination they are being used) at all times.
		"sSearch":       "Buscar:",
		"sUrl":          "",
		"oPaginate": {
			"sFirst":    "Primero",
			"sPrevious": "Anterior",
			"sNext":     "Siguiente",
			"sLast":     "Último"
		}
	};

	var $dt=$('#multi_cuponesTable').DataTable({
		'aoColumns': [
			{"sWidth":"7%"},
			{"sWidth":"5%"},
			{'sType':'date',"sWidth":"10%"},
			{'bSortable':false,'bSearchable':false, 'sWidth':'3%'},
		],
		'aaSorting':[[1,"desc"]],
		'sPaginationType': "full_numbers",
		'language': dtLanguage,
		"bStateSave": true
	});

	var $dt2=$('#multi_apuntesTable').DataTable({
		'aoColumns': [
			{'sType':'date',"sWidth":"10%"},
			{"sWidth":"5%"},
			{"sWidth":"10%"},
			{'sType':'date',"sWidth":"10%"},
		],
		'aaSorting':[[1,"desc"]],
		'sPaginationType': "full_numbers",
		'language': dtLanguage,
		"bStateSave": true
	});

	$('#btnEnviarCliChangePass').on('click', function () {
		if (($('#pass').val()==$('#pass2').val()) && $('#pass').val()!=""){
			$('#frmCliChangePass').submit();
		} else {
			muestraMsgModal('Cambio de contraseña','Debe escribir y repetir exactamente la contraseña tal y como quiera que figure en el sistema');
		}
	});

	$('#btnEnviarCliEditPerfil').on('click', function () {
		$('#frmCliEditPerfil').submit();
	});

	$('#btnAddDir').on('click', function () {
		$('#frmAddDir').submit();
	});

	$('body')
	.on('show.bs.modal', '.modal', function (e) {
		var $modalDialog=$(this).find(".modal-dialog");
		var marginTop=20;
		$modalDialog.css({'margin-top': marginTop + _scrollTop - _top});
	});
});
