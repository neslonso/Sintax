<?if(false) {?><script><?}?>
$(document).ready(function() {
	if (typeof ga !== "undefined") {
		$('.shop-item-wrapper').each(function(index, el) {
			//Enviamos event de impresion a GA
			var $this=$(this);
			var gaId=$this.data('referencia') + ' [ID:' + $this.data('id') +']';
			var gaName=$this.data('nombre');
			var gaCategory=$this.data('categoria');
			var gaList=$this.closest('.gaList').data('nombreLista');
			var gaPosition=$this.data('index');
			var gaThisClass=$this.data('this-class');
			ga('ec:addImpression', {      // Provide product details in an impressionFieldObject.
				'id': gaId,               // Product ID (string).
				'name': gaName,           // Product name (string).
				'category': gaCategory,   // Product category (string).
				//'brand': 'Google',        // Product brand (string).
				//'variant': 'Black',       // Product variant (string).
				'list': gaList,           // Product list (string).
				'position': gaPosition,   // Product position (number).
				'thisClass': gaThisClass, // Custom dimension (string).
			});
			ga('send', 'event', 'catalog', 'impression', {'nonInteraction': true});
		});
	} else {
		console.log('.shop-item-wrapper ec:addImpression typeof ga='+typeof ga);
	}
});
