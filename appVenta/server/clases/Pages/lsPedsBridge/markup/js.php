<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {

	dtLanguage={
		"sProcessing":   "Procesando...",
		"sLengthMenu": "Mostrar MENU elementos por página",
		"sZeroRecords": "No se encontraron resultados",
		"sInfo": "Mostrando del START al END de TOTAL elementos",
		"sInfoEmpty": "Sin resuldados",
		"sInfoFiltered": "(buscando entre MAX elementos en total)",
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


	$dt=$('#multi_pedidoTable').DataTable({
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

	$(document).on("click", "#multi_pedidoTable tr",
		function () {
			window.location='<?=BASE_URL?>index.php?page=pedBridge&id='+$(this).data('id')+'&hash='+$('#hash').val();
		}
	);
});
