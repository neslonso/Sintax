<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
var _top=0;
var _scrollTop=0;

function grabarDireccion(id){
	var nombre=$('#frmCliDir'+id+' #nombre').val();
	var destinatario=$('#frmCliDir'+id+' #destinatario').val();
	var direccion=$('#frmCliDir'+id+' #direccion').val();
	var poblacion=$('#frmCliDir'+id+' #poblacion').val();
	var provincia=$('#frmCliDir'+id+' #provincia').val();
	var cp=$('#frmCliDir'+id+' #cp').val();
	/*
	var idPais=$('#frmCliDir'+id+' #pais').data('id');
	var isoPais=$('#frmCliDir'+id+' #pais').data('iso');
	*/
	var pais=$('#frmCliDir'+id+' #pais').val();
	var movil=$('#frmCliDir'+id+' #movil').val();
	if (destinatario.trim()=="" || direccion.trim()=="" || poblacion.trim()=="" || provincia.trim()=="" || cp.trim()=="" || movil.trim()==""){
		muestraMsgModal('Error en el formulario','Por favor, rellene todos los campos de la dirección');
	} else {
		//comprobamos si el cp es válido para la tienda
		console.log("pais:"+pais);
		$.post('<?=BASE_DIR.FILE_APP?>',{
			'MODULE':'actions',
			'acClase':'mis_datos',
			'acMetodo':'acCheckCP',
			'acTipo':'ajax',
			'cp':cp,
			'pais':pais
		},
		function (response) {
			console.log(response);
			if (!response.data.resultado.valor){
				muestraMsgModal('Error',response.data.resultado.msg);
			} else {
				$('#frmCliDir'+id).submit();
			}
		},
		'json');
	}
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
						'acClase':'mis_datos',
						'acMetodo':'acBorrarDireccion',
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

	$('body')
	.on('show.bs.modal', '.modal', function (e) {
		var $modalDialog=$(this).find(".modal-dialog");
		var marginTop=20;
		$modalDialog.css({'margin-top': marginTop + _scrollTop - _top});
	});
});

function panelClick(id){
	if(!$('#spanDir'+id).hasClass('panel-collapsed')) {
		$('#panelDirBody'+id+', #panelDirFooter'+id).slideUp();
		$('#spanDir'+id).addClass('panel-collapsed');
		$('#icoDir'+id).removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	} else {
		$('#panelDirBody'+id+', #panelDirFooter'+id).slideDown();
		$('#spanDir'+id).removeClass('panel-collapsed');
		$('#icoDir'+id).removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	}
}
