<div id="container-banners">
	<div class="swiper-container">
		<div class="swiper-wrapper">
<?
		$i=0;
		foreach ($arrOfersBanner as $stdObjOfer) {
			$i++;
?>
				<div class="swiper-slide">
					<?\Sintax\ApiService\Productos::fichaProductoDto($stdObjOfer)?>
				</div>
<?
		}
?>
		</div>
		<div class="swiper-pagination"></div>
	</div>
</div>
<div class="container shop-item-container" id="container-cuerpo">
<?
	if (!is_null($idCategoria)) {
?>
	<div>
		<div class="categoria-cabecera text-left">
		<h1><?=$objCat->GETnombre()?></h1>
<?
		if(!empty($arrCatsHijas)) {
?>
		<div class="swiper-container" id="swiperCategoria">
			<div class="swiper-wrapper">
<?
			foreach ($arrCatsHijas as $objCatHija) {
?>
				<div class="swiper-slide swiper-slide-cat"><a href="<?=$objCatHija->url()?>"><?=$objCatHija->GETnombre()?></a></div>
<?
			}
?>
			</div>
		</div>

<?
		}
?>
		</div>
	</div>
<?
	}
?>
	<?\Sintax\ApiService\Categorias::listaFichaProductoResponsive($arrOfersCuerpo);?>
<?
	if (!empty($objCat->GETdescripcion())) {
?>
		<div class="text-justify categoria-descripcion">
			<?=$objCat->GETdescripcion()?>
		</div>
<?
	}
?>
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
