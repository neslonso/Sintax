<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('.btnPagar').addClass('btn btn-warning btn-lg btn-block');
	if ($("#txtPopup").length){
		muestraMsgModal("Continuación del pedido",$("#txtPopup").html());
		$('.modal').find('.btnPagar').attr('id', 'fakeId');
	}
});
