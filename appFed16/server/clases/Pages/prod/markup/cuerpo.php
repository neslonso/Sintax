<?="\n<!-- ".get_class()." -->\n"?>
<?="\n<!-- /".get_class()." -->\n"?>


<div class="container">
	<div class="row item-detail">
		<div class="col-xs-12 col-sm-12 col-md-6">
			<div class="card-item-white">
				<div class="img-item">
					<img src="<?=$objOferta->imgSrc(0, 350, 350)?>" alt="<?=$objOferta->GETnombre()?>" class="img-responsive">
				</div>
<?
if($objOferta->GETtipoDevolucionCredito()>0){
	echo '<div class="shop-item-rebote" data-toggle="tooltip" data-placement="bottom" title="Con la compra de '.$objOferta->GETnombre().' recibirá el '.$objOferta->GETtipoDevolucionCredito().'% de su importe como crédito para futuras compras" data-index="-1"><div>'.$objOferta->GETtipoDevolucionCredito().'%</div></div>';
}
if ($objOferta->descuentoOferta()>0){
	echo '<div class="shop-item-dto-triangle"></div><div class="shop-item-dto">-'.$objOferta->descuentoOferta().'%</div>';
}
if ($objOferta->tipoDescuentoGama()>0) {
	echo '<div class="shop-item-dto-gama"><div class="stamp stampRotate" data-toggle="tooltip" data-placement="bottom" title="Desuento en toda la gama '.$objOferta->objMulti_productoGama()->GETnombre().'"><div>-'.$objOferta->tipoDescuentoGama().'%</div></div></div>';
}
?>
			</div>
		</div><!--img-->
		<div class="col-xs-12 col-sm-12 col-md-6">
			<div class="card-item-white">
				<div class="name">
					<h1 class="h4"><strong><?=$objOferta->GETnombre()?></strong></h1>
				</div>
				<!--<p class="text-muted hidden-sm-down m-b-0"><?=$objOferta->GETnombre()?></p>-->
				<div class="row">
					<div class="col-xs-12">
						<div class="">
<?
if ($objOferta->descuentoOferta()>0){
?>
							<span class="price-ahora"><strong>Ahora&nbsp;<?=$objOferta->pvp()?></strong><strong class="euro">€</strong></span>
							<span class="price-antes text-muted"><small>Antes&nbsp;<?=$objOferta->pvpCatalogo()?><span class="euro">€</span></small></span>
<?
} else {
?>
							<span class="price-ahora"><strong><?=$objOferta->pvp()?></strong><strong class="euro">€</strong></span>
<?
}
?>
						</div>
					</div>
				</div>
			</div>
		</div><!--headFich-->
		<div class="col-xs-12 col-sm-12 col-md-6 pull-md-right">
			<div class="card-item-white">
				<div class="row">
					<div class="col-xs-12 col-sm-6 text-left">
						<span class="text-muted">Ref: <?=$objOferta->GETreferencia()?></span>
					</div>
					<div class="col-xs-12 col-sm-6 text-right">
						<span class="text-muted">EAN: <?=$objOferta->codigoEan()?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 pull-md-right">
			<div class="card-item-white">
				<div class="row">
					<div class="col-xs-12 col-sm-3">
						<strong>Categoría:</strong>
					</div>
					<div class="col-xs-12 col-sm-9">
						<span class="text-muted"><?=(isset($objCategoria) && is_object($objCategoria))?$objCategoria->nombre:'';?></span>
					</div>
<?
if($objOferta->GETtipoDevolucionCredito()>0){
?>
					<div class="col-xs-12 col-sm-3">
						<strong>Crédito:</strong>
					</div>
					<div class="col-xs-12 col-sm-9">
						<span class="text-muted">Con esta compra acumulas un <?=$objOferta->GETtipoDevolucionCredito()?>% de su importe como crédito para futuras compras </span>
					</div>
<?
}
?>
					<div class="col-xs-12 col-sm-3">
						<strong>Cantidad:</strong>
					</div>
					<div class="col-xs-12 col-sm-9 ">
						<input type="number" min="1" max="99" value="1" class="inputUnit">
					</div>

					<div class="col-xs-12 col-sm-3">
						<strong>Disponibilidad:</strong>
					</div>
					<div class="col-xs-12 col-sm-9">
<?
$disponibilidad = (!$objOferta->vendible()) ? 'No disponible' : 'Disponible';
$classText = (!$objOferta->vendible()) ? 'text-danger' : 'text-success';
?>
						<span class="<?=$classText?>"><?=$disponibilidad?></span>
					</div>
				</div>
			</div>
			<div class="card-item-white">
				<div class="row">
					<div class="col-md-6 col-md-push-3 hidden-xs text-center">
						<?=\Sintax\ApiService\Productos::btnComprar($objOferta,'banner-price-comprar');?>
					</div>
					<!--<div class="col-md-6 hidden-xs">
					</div>-->
					<div class="col-xs-12 visible-xs">
						<?=\Sintax\ApiService\Productos::btnComprar($objOferta,'banner-price-comprar');?>
					</div>
					<!--<div class="col-xs-6 visible-xs">
					</div>-->
				</div>
			</div>
		</div><!--ofertas-->
	</div><!--item detail-->
<?
$arrRelBlocks=array();
if (count($arrOfertasRelacionadas)>0) {
	$objThc=new \stdClass();
	$objThc->title='Productos relacionados<small class="text-muted">Los usuarios que compraron '.$objOferta->GETnombre().' también han comprado:</small>';
	$objThc->arrStdObjOfer=$arrOfertasRelacionadas;
	array_push($arrRelBlocks,$objThc);
}
if (count($arrOfertasGama)>0) {
	$arrObjGama=$objOferta->arrMulti_productoGama();
	if (count($arrObjGama)>0) {
		$objMismaGama=new \stdClass();
		$nombresGamas=implode(", ", array_map(function($objGama) {return $objGama->GETnombre();}, $arrObjGama));
		$objMismaGama->title='Productos de la misma gama<small class="text-muted">'.$nombresGamas.':</small>';
		$objMismaGama->arrStdObjOfer=$arrOfertasGama;
		array_push($arrRelBlocks,$objMismaGama);
	}
}
foreach ($arrRelBlocks as $key => $objConfig) {
?>
	<div class="row relBlock">
		<div class="col-lg-12">
			<div class="card-item-white">
				<p class="h4 titulo-encabezado"><?=$objConfig->title;?></p>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="card-item-white">
				<div class="swiper-button-prev"></div>
				<div class="swiper-container">
					<div class="swiper-wrapper">

<?
	foreach ($objConfig->arrStdObjOfer as $stdObjOfer) {
?>
						<div class="swiper-slide">
							<?\Sintax\ApiService\Productos::fichaProductoResponsive($stdObjOfer)?>
						</div>
<?
	}
?>
					</div>
				</div>
				<div class="swiper-button-next"></div>
			</div>
		</div>
	</div>
<?
}
?>
	<div class="row item-desc">
		<div class="col-xs-12 ">
			<div class="card-item-white">
				<p class="h4 titulo-encabezado">Descripción<small class="text-muted p-l-1"><?=$objOferta->GETnombre()?></small>
				</p>
			</div>
			<div class="card-item-white">
				<div class="item-desc-text">
<?
$descripcion = nl2br($objOferta->GETdescripcion());
//$descripcion = preg_replace('#^\s*<br />\s*$#m', '', $descripcion);
//$descripcion = preg_replace('#^\s*(<br />)+\s*$#m', '<hr />', $descripcion);
?>
					<p><?=trim($descripcion)?></p>
				</div>
			</div>
		</div><!--descripcion-->

	</div><!--item detail-->
</div>