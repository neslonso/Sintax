<?if(false) {?><script><?}?>
$(document).ready(function() {
	if (typeof ga !== "undefined") {
		$('.shop-item-wrapper').each(function(index, el) {
			var $this=$(this);
			if ($this.is(":visible")) {
				//Enviamos event de impresion a GA
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
			}
		});
	} else {
		console.log('.shop-item-wrapper ec:addImpression typeof ga='+typeof ga);
	}
	$('.shop-item-wrapper').each(function(index, el) {
		var $this=$(this);
		if ($this.is(":visible")) {
			var ldName=$this.data('nombre');
			var ldImage=$this.data('imgSrc');
			var ldDescription=$this.data('descripcion');
			var ldPrice=$this.data('precio');
			var ldAvailability=($this.data('agotado')==1)?'http://schema.org/OutOfStock':'http://schema.org/InStock';

			var script = document.createElement('script');
			script.type = 'application/ld+json';
			script.text = JSON.stringify({
				"@context": "http://schema.org/",
				"@type": "Product",
				"name": ldName,
				"image": ldImage,
				"description": ldDescription,
				/*
				"mpn": "925872",
				"brand": {
					"@type": "Thing",
					"name": "ACME"
				},
				"aggregateRating": {
					"@type": "AggregateRating",
					"ratingValue": "4.4",
					"reviewCount": "89"
				},
				*/
				"offers": {
					"@type": "Offer",
					"priceCurrency": "EUR",
					"price": ldPrice,
					"priceValidUntil": "<?=date('Y-m-d',time()+60*60*24*7)?>",
					"itemCondition": "http://schema.org/NewCondition",
					"availability": ldAvailability,
					"seller": {
						"@type": "Organization",
						"name": "<?=$GLOBALS['config']->tienda->SITE_NAME?>"
					}
				}

			});
			document.querySelector('head').appendChild(script);
		}
	});
});
