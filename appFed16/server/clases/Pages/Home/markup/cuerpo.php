<div id="container-banners">
	<div class="swiper-container">
		<div class="swiper-wrapper">
<?
		foreach ($arrOfersBanner as $stdObjOfer) {
?>
				<div class="swiper-slide">
					<?\Sintax\ApiService\Productos::fichaProductoDto($stdObjOfer)?>
				</div>
<?
		}
?>
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