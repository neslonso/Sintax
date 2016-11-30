<?="\n<!-- ".get_class()." -->\n"?>
<script type="application/ld+json">
{
	"@context": "http://schema.org/",
	"@type": "Product",
	"name": "<?=htmlentities(strip_tags($objOferta->GETnombre()),ENT_QUOTES,"UTF-8")?>",
	"image": "<?=$objOferta->imgSrc(0, 350, 350)?>",
	"description": "<?=htmlentities(strip_tags($objOferta->GETdescripcion()),ENT_QUOTES,"UTF-8")?>",
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
