	<div class="row listaFichaProductoResponsive">
		<div class="col-lg-12">
			<div class='row'>
<?
		$i=1;
		foreach ($arrOfers as $stdObjOfer) {
?>
				<div class="col-lg-2 col-md-3 col-sm-6">
					<?=\Sintax\ApiService\Productos::fichaProductoResponsive($stdObjOfer);?>
				</div>
<?
			if ($i%6==0){echo '<div class="clearfix visible-lg"></div>';}
			if ($i%4==0){echo '<div class="clearfix visible-md"></div>';}
			if ($i%2==0){echo '<div class="clearfix visible-sm"></div>';}
			$i++;
		}
?>
			</div>
		</div>
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
