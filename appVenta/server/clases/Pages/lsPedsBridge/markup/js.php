<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
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

	var keyTienda=$('#store').val();
	var $dt=$('#multi_pedidoTable'+keyTienda).DataTable({
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

	$(document).on("click", "#multi_pedidoTable"+keyTienda+" tbody tr",
		function () {
			window.location='<?=BASE_URL?>index.php?page=pedBridge&id='+$(this).data('id')+'&store='+$('#store').val()+'&idUser='+$('#idUser').val();
		}
	);
});
