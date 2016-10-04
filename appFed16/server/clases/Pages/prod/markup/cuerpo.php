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
				<p class="text-muted hidden-sm-down m-b-0"><?=$objOferta->GETnombre()?></p>
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
					?>
					<div class="col-xs-12 col-sm-3">
						<strong>Crédito:</strong>
					</div>
					<div class="col-xs-12 col-sm-9">
						<span class="text-muted">CREDITO</span>
					</div>
					<?

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
?>
						<?=$disponibilidad?>
					</div>
				</div>
			</div>
			<div class="card-item-white">
				<div class="row">
					<div class="col-xs-6">
						<button type="button" <?=$agotado?> class="jqCst btn btn-default btn-success btnAddCart" data-id="<?=$objOferta->GETid()?>"  data-ttl="<?=$objOferta->GETnombre()?>" data-unit="1" data-prc="<?=$objOferta->pvp()?>" data-src="<?=$objOferta->imgSrc()?>"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;Añadir al carrito</button>
					</div>
					<div class="col-xs-6">
						<button type="button" <?=$agotado?> class="btnCheckOrder btn btn-default btn-success btnOrder <?=$agotado?>" ><i class="glyphicon glyphicon-ok-circle"></i>&nbsp;Comprar ahora</button>
					</div>
				</div>
			</div>
		</div><!--ofertas-->
	</div><!--item detail-->

	<div class="row item-detail">
		<div class="col-xs-12 ">
			<div class="card-item-white">
				<div class="desc-item">
					<h4>Descripción</h4>
					<p><?=$objOferta->GETdescripcion()?></p>
				</div>
			</div>
		</div><!--descripcion-->

	</div><!--item detail-->
</div>