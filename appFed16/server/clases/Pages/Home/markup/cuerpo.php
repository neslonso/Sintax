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
		<!--<div class="swiper-pagination"></div>-->

		<!-- If we need navigation buttons -->
		<!--<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>-->

		<!-- If we need scrollbar -->
		<!--<div class="swiper-scrollbar"></div>-->
	</div>
</div>
<div class="container shop-item-container" id="container-cuerpo">
<?
	if (isset($_SESSION['usuario']) && count($arrOfersCustom)>0){
?>
	<div class="categoria-cabecera text-left">
		<h1><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Recomendado para tí</h1>
	</div>
	<div class="row vertical-align">
		<div class="col-xs-1">
			<div class="swiper-recomendados-button-prev swiper-button-prev"></div>
		</div>
		<div class="col-xs-10">
			<div class="swiper-container" id="swiperRecomendados">
				<div class="swiper-wrapper swiper-wrapper-recomendados">
<?
		$i=0;
		foreach ($arrOfersCustom as $stdObjOferRec) {
			$i++;
?>
					<div class="swiper-slide swiper-slide-recomendados">
						<div>
							<?\Sintax\ApiService\Productos::fichaProductoResponsive($stdObjOferRec)?>
						</div>
					</div>
<?
		}
?>
				</div>
			</div>
		</div>
		<div class="col-xs-1">
			<div class="swiper-recomendados-button-next swiper-button-next"></div>
		</div>
	</div>
<?
	}
?>
	<div class="categoria-cabecera text-left">
		<h1><i class="fa fa-star" aria-hidden="true"></i> <?=$GLOBALS['config']->tienda->SITE_NAME?> selección</h1>
	</div>
	<?\Sintax\ApiService\Categorias::listaFichaProductoResponsive($arrOfersCuerpo);?>
</div>

<div class="hiddenSwiper" style="display:none;">
	<div class="ofersPageSwiperContainer">
		<div class="swiper-wrapper">
<?
		foreach ($arrOfersCuerpo as $stdObjOfer) {
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
