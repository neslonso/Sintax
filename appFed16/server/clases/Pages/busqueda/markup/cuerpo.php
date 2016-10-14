<?="\n<!-- ".get_class()." -->\n"?>
<?="\n<!-- /".get_class()." -->\n"?>
<div class="container shop-item-container" id="container-cuerpo">
	<div>
		<div class="categoria-cabecera text-left">
			<h1><i class="fa fa-search" aria-hidden="true"></i> Resultados de la búsqueda <?=$txtBusqueda?></h1>
		</div>
	</div>
	<?\Sintax\ApiService\Categorias::listaFichaProductoResponsive($arrOfers);?>
</div>
<div class="hiddenSwiper" style="display:none;">
	<div class="ofersPageSwiperContainer">
		<div class="swiper-wrapper">
<?
		foreach ($arrOfers as $stdObjOfer) {
?>
			<div class="swiper-slide">
				<?\Sintax\ApiService\Productos::fichaProductoResponsive($stdObjOfer);?>
			</div>
<?
		}
?>
		</div>
		<!-- If we need pagination -->
		<!--<div class="swiper-pagination"></div>-->

		<!-- If we need navigation buttons -->
		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>

		<!-- If we need scrollbar -->
		<!--<div class="swiper-scrollbar"></div>-->
	</div>
</div>