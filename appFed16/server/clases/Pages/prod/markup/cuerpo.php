<?="\n<!-- ".get_class()." -->\n"?>
<?="\n<!-- /".get_class()." -->\n"?>


<div class="container">
	<div class="row item-detail">
		<div class="col-xs-12 col-sm-12 col-md-6">
			<div class="card-item-white">
				<div class="img-item">
					<img src="<?=$objOferta->imgSrc(0, 350, 350)?>" class="img-responsive">
				</div>

			</div>
		</div><!--img-->
		<div class="col-xs-12 col-sm-12 col-md-6">
			<div class="card-item-white">
				<div class="name">
					<h1 class="h4"><strong><?=$objOferta->GETnombre()?></strong></h1>
				</div>
				<!--<p class="text-muted hidden-sm-down m-b-0"><?=$objOferta->GETnombre()?></p>-->
<?
if($objOferta->GETtipoDevolucionCredito()>0){
			$rebote = '<div class="shop-item-rebote" data-toggle="tooltip" title="Con la compra de '.$objOferta->GETnombre().' recibirá el '.$objOferta->GETtipoDevolucionCredito().'% de su importe como crédito para futuras compras" data-index="-1"><div>'.$objOferta->GETtipoDevolucionCredito().'%</div></div>';
?>
				<?=$rebote?>

<?
}
?>
				<div class="row">
					<div class="col-xs-12">
						<div class="">
							<span class="price-ahora"><strong>Ahora&nbsp;<?=$objOferta->pvp()?></strong><strong class="euro">€</strong></span>
							<span class="price-antes text-muted"><small>Antes&nbsp;<?=$objOferta->pvpCatalogo()?><span class="euro">€</span></small></span>
							<div class="price-descuento"><span class="badge">- <?=$objOferta->descuentoOferta()?> %</span></div>
						</div>
					</div>
				</div>
			</div>
		</div><!--headFich-->
		<div class="col-xs-12 col-sm-12 col-md-6 pull-md-right">
			<div class="card-item-white">
				<div class="row">
					<div class="col-xs-12 col-sm-3">
						<strong>Categoría:</strong>
					</div>
					<div class="col-xs-12 col-sm-9">
						<span class="text-muted"><?=$objCategoria->nombre?></span>
					</div>
<?
					//if producto rebote
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
	$disponibilidad = ($objOferta->GETagotado()==1) ? 'Agotado' : 'Disponible';
	$agotado = ($objOferta->GETagotado()==1) ? 'disabled' : '';
	$classText = ($objOferta->GETagotado()==1) ? 'text-danger' : 'text-success';
?>
						<span class="<?=$classText?>"><?=$disponibilidad?></span>
					</div>
				</div>
			</div>
			<div class="card-item-white">
				<div class="row">
					<div class="col-md-6 col-md-push-3 hidden-xs">
						<button type="button" <?=$agotado?> class="jqCst btn btn-default btn-comprar btnAddCart" data-id="<?=$objOferta->GETid()?>"  data-ttl="<?=$objOferta->GETnombre()?>" data-unit="1" data-prc="<?=$objOferta->pvp()?>" data-src="<?=$objOferta->imgSrc()?>"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;Comprar ahora</button>
					</div>
					<!--<div class="col-md-6 hidden-xs">
						<button type="button" <?=$agotado?> class="btn btn-default btn-warning btnOrder <?=$agotado?>" ><i class="glyphicon glyphicon-ok-circle"></i>&nbsp;Comprar ahora</button>
					</div>-->
					<div class="col-xs-12 visible-xs">
						<button type="button" <?=$agotado?> class="jqCst btn btn-default btn-comprar btnAddCart btnXs" data-id="<?=$objOferta->GETid()?>"  data-ttl="<?=$objOferta->GETnombre()?>" data-unit="1" data-prc="<?=$objOferta->pvp()?>" data-src="<?=$objOferta->imgSrc()?>"><i class="glyphicon glyphicon-shopping-cart">&nbsp;Comprar ahora</i></button>
					</div>
					<!--<div class="col-xs-6 visible-xs">
						<button type="button" <?=$agotado?> class="btn btn-default btn-warning btnOrder <?=$agotado?> btnXs" ><i class="glyphicon glyphicon-ok-circle"></i>&nbsp;</button>
					</div>-->
				</div>
			</div>
		</div><!--ofertas-->
	</div><!--item detail-->

	<!--swiper articulos relacionados-->
	<div class="row item-relacionados">
		<div class="col-lg-12">
			<div class="card-item-white">
				<p class="h4 titulo-encabezado">Productos relacionados<small class="text-muted p-l-1">Los usuarios también han comprado</small>
				</p>
			</div>
			<div id="container-banners">
				<div class="swiper-container">
					<div class="swiper-wrapper">

			<?
					foreach ($arrOfertasRelacionadas as $stdObjOfer) {
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

		</div>
	</div>

	<!--swiper productos gama-->
	<div class="row item-gama">
		<div class="col-lg-12">
			<div class="card-item-white">
				<p class="h4 titulo-encabezado">Productos gama<small class="text-muted p-l-1"><?=$objOferta->GETnombre()?></small>
				</p>
			</div>
			<div id="container-banners">
				<div class="swiper-container">
					<div class="swiper-wrapper">

			<?
					foreach ($arrOfertasGama as $stdObjOfer) {
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

		</div>
	</div>



	<div class="row item-desc">
		<div class="col-xs-12 ">
			<div class="card-item-white">
				<p class="h4 titulo-encabezado">Descripción<small class="text-muted p-l-1"><?=$objOferta->GETnombre()?></small>
				</p>
			</div>
			<div class="card-item-white">
				<div class="item-desc-text">
<?
	$descripcion = str_replace ( '<br /><br />' , '<br />' , $objOferta->GETdescripcion());
	//$descripcion = str_replace ( '<br />\n<br />' , '<br />' , $descripcion);
?>
					<p><?=trim($objOferta->GETdescripcion())?></p>
				</div>
			</div>
		</div><!--descripcion-->

	</div><!--item detail-->
</div>