<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('.btnPagar').addClass('btn btn-warning btn-lg btn-block');
	if ($("#txtPopup").length){
		muestraMsgModal("Continuación del pedido",$("#txtPopup").html());
		$('.modal').find('.btnPagar').attr('id', 'fakeId');
	}

	setInterval(function() {
		var _docHeight = (document.height !== undefined) ? document.height : document.body.offsetHeight;
		//var _docWidth = (document.width !== undefined) ? document.width : document.body.offsetWidth;
		var objMsg= {
			service: "pedBridgeIframeHeight",
			parameters: _docHeight
		}
		parent.postMessage(objMsg, '*');
	}
	,100);
});