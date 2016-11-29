<?="\n<!-- ".get_class()." -->\n"?>
<script type="application/ld+json">
{
	"@context": "http://schema.org/",
	"@type": "Product",
	"name": "<?=$objOferta->GETnombre()?>",
	"image": "<?=$objOferta->imgSrc(0, 350, 350)?>",
	"description": "<?=strip_tags($objOferta->GETdescripcion())?>",
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
		"price": "<?=$objOferta->pvp()?>",
		"priceValidUntil": "<?=date('Y-m-d',time()+60*60*24*7)?>",
		"itemCondition": "http://schema.org/NewCondition",
		"availability": "http://schema.org/InStock",
		"seller": {
			"@type": "Organization",
			"name": "<?=$GLOBALS['config']->tienda->SITE_NAME?>"
		}
	}
}
</script>
<?="\n<!-- /".get_class()." -->\n"?>
