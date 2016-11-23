<div class="swiperFichaProductoResponsive gaList">
	<div class="row vertical-align" style="margin-top:7px;"
		data-nombre-lista="<?=$nombre?>">
		<div class="col-xs-1">
			<div class="swiper-button-container swiper-button-container-prev">
				<div class="swiper-button swiper-button-prev"></div>
			</div>
		</div>
		<div class="col-xs-10">
				<div class="swiper-container">
					<div class="swiper-wrapper">
<?
foreach ($arrOfers as $stdObjOfer) {
?>
						<div class="swiper-slide">
							<?\Sintax\ApiService\Productos::fichaProductoResponsive($stdObjOfer)?>
						</div>
<?
}
?>
					</div>
				</div>
		</div>
		<div class="col-xs-1">
			<div class="swiper-button-container swiper-button-container-next">
				<div class="swiper-button swiper-button-next"></div>
			</div>
		</div>
	</div>
</div>