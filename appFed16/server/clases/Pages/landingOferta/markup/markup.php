<?="\n<!-- ".get_class()." -->\n"?>
<header id="header" class=" ">
	<div class="bandaSuperior">
		<?=$GLOBALS['config']->tienda->BIENVENIDA?>
	</div>
	<div class="container">
		<div class="row vertical-align">
			<div class="col-xs-12 col-sm-3">
				<div class="logoLanding" class="">
					<a href="<?=BASE_URL?>">
						<img src="<?=$GLOBALS['config']->tienda->URL_LOGO?>">
					</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-9">
				<div class="textwidget">
					<strong>Infórmate:</strong>
					<a href="mailto:<?=$GLOBALS['config']->tienda->CONTACTO->EMAIL?>"><?=$GLOBALS['config']->tienda->CONTACTO->EMAIL?></a> o
					<a href="tel:+34 <?=$GLOBALS['config']->tienda->CONTACTO->TLF?>"><?=$GLOBALS['config']->tienda->CONTACTO->TLF?></a>
				</div>
			</div>
		</div>
	</div>
</header>

<section class="cuerpoOferta" style="">
	<div class="">
		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-1 text-center">
					<h1 class="promoH1"><?=$objOferta->GETnombre()?></h1>
<?
	if ($objOferta->descuentoOferta()>0){
?>
					<div>
						<span class="promoH2 tachado"><small>Antes&nbsp;<?=$objOferta->pvpCatalogo()?> €</small></span>
						&nbsp;
						<span class="promoH2"><strong>¡Ahora&nbsp;<span class="precio"><?=$objOferta->pvp()?> €</span>!</strong></span>
					</div>
<?
	} else {
?>
					<h2 class="promoH2">¡Ahora por <strong><span class="precio"><?=$objOferta->pvp()?> €</span>!</strong></h2>
<?
	}
?>
				</div>
			</div>
			<div class="row textoOferta">
				<div class="col-sm-3">
					<div class="card-item-white">
						<div class="img-item">
							<img src='<?=$objOferta->imgSrc(0, 300, 300)?>'/>
						</div>
<?
	if ($objOferta->descuentoOferta()>0){
		echo '<div class="shop-item-dto-triangle"></div><div class="shop-item-dto">-'.$objOferta->descuentoOferta().'%</div>';
	}
?>
					</div>
					<div>mas movidillas del producto</div>
					<div>btn comprar..portes gratis etc</div>
					<div class="text-center">
						<?=\Sintax\ApiService\Productos::btnComprar($objOferta,'banner-price-comprar');?>
					</div>
				</div>
				<div class="col-sm-9">
					<div>
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" id="tabsOferta" role="tablist">
							<li role="presentation" class="active"><a href="#cestaOferta" aria-controls="cestaOferta" role="tab" data-toggle="tab">Detalles del pedido</a></li>
							<li role="presentation"><a href="#txtDescripcion" aria-controls="txtDescripcion" role="tab" data-toggle="tab">Descripción</a></li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="cestaOferta">

								<div class="tabOferta tabResumen" id="newPedWizard" data-store="<?=$store?>"
									data-id-multi_cliente="<?=$datosCli->id?>"
									data-nombre-cliente="<?=$datosCli->nombre?>"
									data-apellidos-cliente="<?=$datosCli->apellidos?>"
									data-email-cliente="<?=$datosCli->email?>"
									data-tipo-dto-cliente="<?=$datosCli->tipoDescuento?>"
									data-arr-dtos-volumen="<?=$jsonArrDtosVolumen?>"
									data-dto-cliente-compatible-dto-volumen="<?=($storeData->DTO_CLIENTE_COMPATIBLE_DTO_VOLUMEN)?'1':'0';?>">
									<div class="panel panel-default">
										<div class="panel-body">
											<table id="tableLineas" class="table table-striped" data-arr-lineas="">
												<thead>
													<tr>
														<th>Ref.</th>
														<th>Concepto</th>
														<th>Precio</th>
														<th>Cantidad</th>
														<th>Descuento</td>
														<th>Total</th>
													</tr>
												</thead>
												<tbody>
													<!-- -->
												</tbody>
											</table>
										</div>
										<div class="panel-footer">
											<div class="row">
												<div class="col-sm-6 text-left">
<?
if ($storeData->TIPO_DEVOLUCION_IMPORTE_PEDIDO_EN_CREDITO>0) {
?>
													<h4>
														Te queremos de vuelta<br />
														<small>
															Al pagar este pedido recibirá un <?=$storeData->TIPO_DEVOLUCION_IMPORTE_PEDIDO_EN_CREDITO?>% de su importe
															(<span id="spFidelizacionCredit" class="spCalculado" data-tipo-devolucion-importe-pedido-en-credito="<?=$storeData->TIPO_DEVOLUCION_IMPORTE_PEDIDO_EN_CREDITO?>"></span>)
															como crédito para sus próximos pedidos!
														</small>
													</h4>
													<hr />
<?
}
?>
													<h4 style="display: none;">
														Productos rebote<br />
														<small class="tooltip-wide">
															Su pedido incluye productos rebote por un total de
															<span id="spTotalRebotes"></span>
															que recibirá como crédito para sus próximos pedidos!
														</small>
													</h4>
												</div>
												<div class="col-sm-6 text-right">
													<div>Total productos: <span id="spTotalLineas" class="spTotalLineas spCalculado" data-total-lineas=""></span> €</div>
													<div>
														<span id="tipDtosImporte">
															Descuentos por fidelización: <span id="spDescuentoImporte" class="spCalculado"></span> €
														</span>
													</div>
													<div>
														<span id="tipDtosTipo">
															Otros descuentos (<span id="spDtoTipo" class="spCalculado"></span>%): <span id="spDtoMonto" class="spCalculado"></span> €
														</span>
													</div>
													<div>Gastos de envío: <span id="spPortes" class="spCalculado" data-portes=""></span> €</div>
													<div>Total Pedido: <span id="spTotal" class="spCalculado"></span> €</div>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane " id="txtDescripcion">
								<div class="tabOferta">
									<h3 class="promoH3"><?=$objOferta->GETnombre()?></h3>
<?
	$descripcion = nl2br($objOferta->GETdescripcion());
?>
									<p><?=trim($descripcion)?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<footer>
	<div class="footer" id="footer">
		<div class="container-fluid">
			<div class="row">
				<div class="caracteristicas">
					<div class="col-lg-2  col-md-2 col-sm-4 col-xs-12">
						<h3><i class="fa fa-truck" aria-hidden="true"></i>  Entrega </h3>
						<ul>
							<li>Entrega: 24/48h </li>
							<li>Envío gratis desde <?=round($storeData->IMPORTE_PEDIDO_PORTES_GRATIS)?>€</li>
							<li>Tarifa plana portes</li>
							<li>Seguimiento online del pedido</li>
						</ul>
					</div>
					<div class="col-lg-2  col-md-2 col-sm-4 col-xs-12">
						<h3><i class="fa fa-lock" aria-hidden="true"></i>  Pago seguro </h3>
						<ul>
							<li>Tarjeta, transferencia bancaria y contra reembolso</li>
							<li>Pago seguro via plataformas bancarias</li>
							<li>0% comisión contra reembolso</li>
						</ul>
					</div>
					<div class="col-lg-2  col-md-2 col-sm-4 col-xs-12">
						<h3><i class="fa fa-gavel" aria-hidden="true"></i>  Condiciones </h3>
						<ul>
							<li>Precios IVA incluído en euros</li>
							<li>Gastos de envío desglosados en cada pedido</li>
							<li>Fotos no contractuales</li>
							<li><a href="<?=BASE_URL?>aviso_legal/">Condiciones de Uso y Política de Privacidad</a></li>
						</ul>
					</div>
					<div class="col-lg-2  col-md-2 col-sm-4 col-xs-12">
						<h3><i class="fa fa-building" aria-hidden="true"></i>  Empresa </h3>
						<ul>
							<li><?=$GLOBALS['config']->tienda->EMPRESA->NOMBRE?></li>
							<li><a class="ellipsis" href="mailto:<?=$GLOBALS['config']->tienda->CONTACTO->EMAIL?>"><?=$GLOBALS['config']->tienda->CONTACTO->EMAIL?></a></li>
							<li><a href="tel:<?=$GLOBALS['config']->tienda->CONTACTO->TLF?>"><?=$GLOBALS['config']->tienda->CONTACTO->TLF?></a></li>
							<li><?=$GLOBALS['config']->tienda->EMPRESA->DIRECCION?></li>
							<li><?=$GLOBALS['config']->tienda->EMPRESA->CIF?></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4  col-md-4 col-sm-6 col-xs-12 ">
					<h3><i class="fa fa-rss" aria-hidden="true"></i>  Suscríbete </h3>
					<ul>
						<li>
							<div class="input-append newsletter-box text-center">
								<p class="text-justify">Suscríbete a nuestro boletín y estarás informado de todas nuestras ofertas.</p>
								<form id="frmSuscribir">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon" id="spanAceptoSuscribir"  data-toggle="tooltip" title="Acepto las condiciones de uso" data-placement="top" data-container="body">
												<input type="checkbox" id="aceptoSuscribir" name="aceptoSuscribir" value="1">
											</span>
											<span class="input-group-addon"  data-toggle="tooltip" title="Ver las condiciones de uso" data-placement="top" data-container="body">
												<a href="<?=BASE_URL?>aviso_legal/"><i class="fa fa-gavel" aria-hidden="true"></i></a>
											</span>
											<input  class="form-control" type="text" name="emailSuscribir" id="emailSuscribir" value="" placeholder="tucorreo@electronico.com"  />
										</div>
									</div>
									<button type="button" id="btnSuscribir" class="btn btn-primary">
										 Enviar <i class="fa fa-long-arrow-right"> </i>
									</button>
								</form>
							</div>
						</li>
					</ul>
					<ul class="social">
<?
				if ($linkTiendaFB){
?>
						<li> <a href="<?=$GLOBALS['config']->tienda->SOCIAL->FB->URL?>"> <i class=" fa fa-facebook">   </i> </a> </li>
<?
				}
				if ($linkTiendaTW){
?>
						<li> <a href="<?=$GLOBALS['config']->tienda->SOCIAL->TW->URL?>"> <i class="fa fa-twitter">   </i> </a> </li>
<?
				}
?>
					<!--
						<li> <a href="#"> <i class="fa fa-google-plus">   </i> </a> </li>
						<li> <a href="#"> <i class="fa fa-pinterest">   </i> </a> </li>
						<li> <a href="#"> <i class="fa fa-youtube">   </i> </a> </li>
					-->
					</ul>
				</div>
			</div>
			<!--/.row-->
		</div>
		<!--/.container-->
	</div>
	<!--/.footer-->

	<div class="footer-bottom">
		<div class="container-fluid">
			<div class="pull-left footer-logoTienda">
				<a href="<?=BASE_URL?>">
					<img style="height:65px;" src="<?=$GLOBALS['config']->tienda->URL_LOGO?>" alt="<?=$GLOBALS['config']->tienda->key?>">
				</a>
				<!--© Nombretienda-->
			</div>
			<div class="pull-right footer-logos">
				<a href="http://xunta.es">
					<img src="<?=BASE_DIR?>index.php?MODULE=images&almacen=IMGS_DIR&alto=65&fichero=cofinanciado.xunta.png" alt="Xunta de Galicia">
				</a>
				<a href="javascript:void(null);">
					<img src="<?=BASE_DIR?>index.php?MODULE=images&almacen=IMGS_DIR&alto=65&fichero=visaMasterLogo.png" alt="Pago seguro">
				</a>
				<a href="javascript:void(null);">
					<img src="<?=BASE_DIR?>index.php?MODULE=images&almacen=IMGS_DIR&alto=65&fichero=html5Logo.png" alt="html5">
				</a>
				<a href="javascript:void(null);">
					<img src="<?=BASE_DIR?>index.php?MODULE=images&almacen=IMGS_DIR&alto=65&fichero=lib/dondominio_seals/ddsecure_70x70_white@3x.png" alt="Conexión cifrada">
				</a>
			</div>
		</div>
	</div>
	<!--/.footer-bottom-->
</footer>
<?="\n<!-- /".get_class()." -->\n"?>
