<?="\n<!-- ".get_class()." -->\n"?>
<div class="container divOps" id="container-cuerpo">
	<div class="row">
		<div class="col-xs-12 text-center txtOps">
			Ooops<span class="exclamacion">!</span>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 text-center">
			<h2 class=""> Lo sentimos, no podemos mostar esta página </h2>
			<p class=" text-center">
				<strong>Código de error 404</strong>
				<br>
				Utiliza nuestro buscador para encontrar lo que necesitas.
			</p>
		</div>
	</div>
</div>
<div class="container shop-item-container" id="container-cuerpo">
<?
	if (isset($_SESSION['usuario']) && count($arrOfersCustom)>0){
?>
	<div class="categoria-cabecera text-left">
		<h1><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Recomendado para tí</h1>
	</div>
	<?\Sintax\ApiService\Categorias::swiperFichaProductoResponsive($arrOfersCustom," Auto Recomendados (arrOfersCustom en Home)");?>
<?
	}
?>
	<div class="categoria-cabecera text-left">
		<h1><i class="fa fa-star" aria-hidden="true"></i> <?=$GLOBALS['config']->tienda->SITE_NAME?> selección</h1>
	</div>
	<?\Sintax\ApiService\Categorias::listaFichaProductoResponsive($arrOfersCuerpo,$GLOBALS['config']->tienda->SITE_NAME." selección (Lista Home)");?>
</div>
<?="\n<!-- /".get_class()." -->\n"?>
