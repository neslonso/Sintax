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
				<div class="col-sm-10 col-sm-offset-1 text-center">
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
<?
	if ($logueado){
?>
					<div class="divDireccion">
						<p>Dirección de entrega:</p>
						<div id="btnModalSelDir" class="btn-direccion">
							<span id="dirSeleccionada"></span>
						</div>
					</div>
<?
	}
?>
					<div class="text-center">
						<div id="btnPagar" class="btn-pagar">
							<i class="glyphicon glyphicon-shopping-cart"></i> COMPRAR AHORA
						</div>
					</div>
				</div>
				<div class="col-sm-9">
					<div>
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" id="tabsOferta" role="tablist">
<?
	$activoDescripcion="";
	if ($logueado){
?>
							<li role="presentation" class="active"><a href="#cestaOferta" aria-controls="cestaOferta" role="tab" data-toggle="tab">Detalles del pedido</a></li>
<?
	} else {
		$activoDescripcion='active';
	}
?>
							<li role="presentation" class="<?=$activoDescripcion?>"><a href="#txtDescripcion" aria-controls="txtDescripcion" role="tab" data-toggle="tab">Descripción</a></li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
<?
	if ($logueado){
?>
							<div role="tabpanel" class="tab-pane active" id="cestaOferta">
								<div id="newPedWizard" data-store="<?=$store?>"
									data-id-multi_cliente="<?=$datosCli->id?>"
									data-nombre-cliente="<?=$datosCli->nombre?>"
									data-apellidos-cliente="<?=$datosCli->apellidos?>"
									data-email-cliente="<?=$datosCli->email?>"
									data-tipo-dto-cliente="<?=$datosCli->tipoDescuento?>"
									data-arr-dtos-volumen="<?=$jsonArrDtosVolumen?>"
									data-dto-cliente-compatible-dto-volumen="<?=($storeData->DTO_CLIENTE_COMPATIBLE_DTO_VOLUMEN)?'1':'0';?>"
									data-dto-cliente-compatible-cupon="<?=($storeData->DTO_CLIENTE_COMPATIBLE_DTO_VOLUMEN)?'1':'0';?>"
									data-arr-modos-pago="<?=$jsonArrModosPago?>"
									data-id-tipo-modo-pago="<?=$idTipoModoPago?>"
									data-arr-cupones="<?=$jsonArrCupones?>"
									data-id-cupon="">
									<?=\Sintax\ApiService\Pedidos::detallePedido();?>
									<div class="restoInfoResumen">
										<h4 style="display: none;">
											Crédito de cliente a aplicar: <span id="creditoMaximoAplicable" class="h3"></span>
										</h4>
<?
		if ($storeData->TIPO_DEVOLUCION_IMPORTE_PEDIDO_EN_CREDITO>0) {
?>
										<h4>
											Te queremos de vuelta:
											<small>
												Al pagar este pedido recibirá un <?=$storeData->TIPO_DEVOLUCION_IMPORTE_PEDIDO_EN_CREDITO?>% de su importe
												(<span id="spFidelizacionCredit" class="spCalculado" data-tipo-devolucion-importe-pedido-en-credito="<?=$storeData->TIPO_DEVOLUCION_IMPORTE_PEDIDO_EN_CREDITO?>"></span>)
												como crédito para sus próximos pedidos!
											</small>
										</h4>
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
										<ul id="ulDtos" style="display:none;"></ul>
									</div>
								</div>
							</div>
<?
	}
?>
							<div role="tabpanel" class="tab-pane <?=$activoDescripcion?>" id="txtDescripcion">
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
				<div class="col-xs-12">
					<div class="row footerLanding">
						<div class="col-lg-3  col-md-3 col-sm-6 col-xs-12">
							<h3><i class="fa fa-truck" aria-hidden="true"></i>  Entrega </h3>
							<ul>
								<li>Entrega: 24/48h </li>
								<li>Envío gratis desde <?=round($storeData->IMPORTE_PEDIDO_PORTES_GRATIS)?>€</li>
								<li>Tarifa plana portes</li>
								<li>Seguimiento online del pedido</li>
							</ul>
						</div>
						<div class="col-lg-3  col-md-3 col-sm-6 col-xs-12">
							<h3><i class="fa fa-lock" aria-hidden="true"></i>  Pago seguro </h3>
							<ul>
								<li>Tarjeta, transferencia bancaria y contra reembolso</li>
								<li>Pago seguro via plataformas bancarias</li>
								<li>0% comisión contra reembolso</li>
							</ul>
						</div>
						<div class="col-lg-3  col-md-3 col-sm-6 col-xs-12">
							<h3><i class="fa fa-gavel" aria-hidden="true"></i>  Condiciones </h3>
							<ul>
								<li>Precios IVA incluído en euros</li>
								<li>Gastos de envío desglosados en cada pedido</li>
								<li>Fotos no contractuales</li>
								<li><a href="<?=BASE_URL?>aviso_legal/">Condiciones de Uso y Política de Privacidad</a></li>
							</ul>
						</div>
						<div class="col-lg-3  col-md-3 col-sm-6 col-xs-12">
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
				</div>
			</div>
		</div>
	</div>
</section>
<?
	if ($logueado){
?>
<div class="modal fade" id="modalSelDir" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Dirección de entrega</h4>
			</div>
			<div class="modal-body">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" id="tabsDir" role="tablist">
					<li role="presentation" class="active"><a href="#selectDirTab" aria-controls="selectDirTab" role="tab" data-toggle="tab">Direcciones actuales</a></li>
					<li role="presentation"><a href="#newDirTab" aria-controls="newDirTab" role="tab" data-toggle="tab">Nueva dirección</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="selectDirTab">
						<?=$this->direccionEntregaSelectionControl($datosCli,$idDirPredeterminada)?>
					</div>
					<div role="tabpanel" class="tab-pane" id="newDirTab">
						<form id="modalAddDir">
							<input name="id" id="id" type="hidden" value="0"/>
							<div class="row">
								<input class="form-control" type="hidden" name="nombre" id="nombre" value="" placeholder="Nombre para identificar esta dirección..." />
								<div class="col-sm-12">
									<div class="form-group">
										<label for="destinatario" accesskey="">Destinatario*</label>
										<input class="form-control" type="text" name="destinatario" id="destinatario" value=""  placeholder="Destinatario del envio" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label for="direccion" accesskey="">Direccion*</label>
										<input class="form-control" type="text" name="direccion" id="direccion" value="" placeholder="Dirección completa" />
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="poblacion" accesskey="">Poblacion*</label>
										<input class="form-control" type="text" name="poblacion" id="poblacion" value="" placeholder="Población"/>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="provincia" accesskey="">Provincia*</label>
										<input class="form-control" type="text" name="provincia" id="provincia" value="" placeholder="Provincia" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label for="cp" accesskey="">Código postal*</label>
										<input class="form-control" type="text" name="cp" id="cp" value="" placeholder="Código postal" />
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
											<label for="pais" accesskey="">País:</label>

											<select name="pais" id="pais" class="form-control">
	<?
										foreach ($paises as $pais) {
											$selected=($pais->id==$paisDefecto)?"selected='selected'":"";
	?>
											    <option <?=$selected?> data-id="<?=$pais->id?>" data-iso="<?=$pais->alpha2?>" value="<?=$pais->nombre_es?>"><?=$pais->nombre_es?></option>
	<?
										}
	?>
											</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="movil" accesskey="">Teléfono de contacto*</label>
										<input class="form-control" type="text" name="movil" id="movil" value="" placeholder"Teléfono de contacto"/>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" id="btnAddDir" class="btn btn-primary">Grabar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?
}
?>
<?="\n<!-- /".get_class()." -->\n"?>
