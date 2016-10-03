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
		<!-- If we need pagination -->
		<div class="swiper-pagination"></div>

		<!-- If we need navigation buttons -->
		<!--<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>-->

		<!-- If we need scrollbar -->
		<!--<div class="swiper-scrollbar"></div>-->
	</div>
</div>
<div class="container shop-item-container" id="container-cuerpo">
		<?\Sintax\ApiService\Categorias::listaFichaProductoResponsive($arrOfersCuerpo);?>
</div>