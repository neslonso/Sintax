<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('.btnPagar').addClass('btn btn-warning btn-lg btn-block');
	if ($("#txtPopup").length){
		muestraMsgModal("Continuación del pedido",$("#txtPopup").html());
		$('.modal').find('.btnPagar').attr('id', 'fakeId');
	}
	$('.btnPagar').click(function(event) {
		if (false) {
			//ReferenceError: ga is not defined
			var eventCategory='btnPagar';
			var eventAction='click';
			var eventLabel=$('#containerPedido').data('pedidoNumero');
			var eventValue=0;
			ga('send', {
				hitType: 'event',
				eventCategory: eventCategory,
				eventAction: eventAction,
				eventLabel: eventLabel,
				eventValue: eventValue,
			});
		}
	});

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
