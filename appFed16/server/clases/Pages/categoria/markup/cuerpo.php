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
	if (isset($_SESSION['usuario']) && count($arrOfersCustom)>0){
		if (!is_null($idCategoria)) {
			$nombreCat=" de ".$objCat->GETnombre();
		}
?>
	<div class="categoria-cabecera text-left">
		<h1><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Recomendado para tí<?=$nombreCat?></h1>
	</div>
	<?\Sintax\ApiService\Categorias::swiperFichaProductoResponsive($arrOfersCustom," Auto Recomendados (arrOfersCustom en ".$objCat->GETnombre()."[ID:".$objCat->GETid()."] )");?>
<?
	}
?>
<?
	if (!is_null($idCategoria)) {
?>
	<div>
		<div class="categoria-cabecera text-left">
		<h1><i class="fa fa-list-alt" aria-hidden="true"></i> <?=$objCat->GETnombre()?></h1>
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
	<?\Sintax\ApiService\Categorias::listaFichaProductoResponsive($arrOfersCuerpo,"Lista categoría (".$objCat->GETnombre()."[ID:".$objCat->GETid()."])");?>
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
