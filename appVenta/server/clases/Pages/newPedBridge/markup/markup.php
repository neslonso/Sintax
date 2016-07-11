<?="\n<!-- ".get_class()." -->\n"?>
<div class="fuelux">
	<div class="wizard" data-initialize="wizard" id="newPedWizard" data-store="<?=$store?>" data-tipo-dto-cliente="<?=$datosCli->tipoDescuento?>">
		<div class="steps-container">
			<ul class="steps">
				<li data-step="0">
					<span class="badge">1</span>Debug
					<span class="chevron"></span>
				</li>
				<li data-step="1" class="active">
					<span class="badge">1</span>Pago y entrega
					<span class="chevron"></span>
				</li>
				<li data-step="2">
					<span class="badge">2</span>Descuentos y comentarios
					<span class="chevron"></span>
				</li>
				<li data-step="3">
					<span class="badge">3</span>Resumen y confirmación
					<span class="chevron"></span>
				</li>
			</ul>
		</div>
		<div class="actions">
			<button type="button" class="btn btn-default btn-prev">
				<span class="glyphicon glyphicon-arrow-left"></span>Anterior
			</button>
			<button type="button" class="btn btn-primary btn-next" data-last="¡Comprar ahora!">Siguiente
				<span class="glyphicon glyphicon-arrow-right"></span>
			</button>
		</div>
		<div class="step-content">
			<div class="step-pane sample-pane alert" data-step="0">
				<div class="row">
					<div class="col-md-4">
						newPedBridgeData:
						<pre><?=var_export($newPedBridgeData)?></pre>
					</div><div class="col-md-4">
						datosCli:
						<pre><?=var_export($datosCli)?></pre>
					</div><div class="col-md-4">
						storeData:
						<pre><?=var_export($storeData)?></pre>
					</div>
				</div>
			</div>
			<div class="step-pane active sample-pane alert" data-step="1">
				<div class="row">
					<div class="col-md-6">
						<?=$this->modoPagoSelectionControl($arrModosPago)?>
					</div>
					<div class="col-md-6">
						<?=$this->direccionEntregaSelectionControl($datosCli)?>
					</div>
				</div>
				<!--<pre><?var_dump($newPedBridgeData)?></pre>-->
			</div>
			<div class="step-pane sample-pane alert" data-step="2">
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Crédito de cliente</h3>
							</div>
							<div class="panel-body">
<?
if ( $this->totalLineas($newPedBridgeData->lineas) > $storeData->IMPORTE_MINIMO_APLICACION_CREDITO) {
?>
								<div class="row">
									<div class="col-md-2">
										<span class="h3">0.00€</span>
									</div>
									<div class="col-md-7">
										<input type="range" name="credito" id="credito" value="0" min="0.0" max="<?=$datosCli->saldoCredito?>" step="0.01" />
									</div>
									<div class="col-md-3 text-right">
										<span class="h3"><?=$datosCli->saldoCredito?>€</span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-7 text-center">
										<span class="h2"><small>Crédito a aplicar:</small></span>
										<span id="creditoAplicar" class="h3" data-credito-aplicar="0.00"
											data-saldo-inicial="<?=$datosCli->saldoCredito?>">0.00€</span>

									</div>
								</div>
								<div class="row">
									<div class="col-md-12 text-right">
										<button type="button" id="addCredito" name="addCredito" class="btn btn-primary" aria-label="Aplicar credito"
											data-loading-text="Validando...">Aplicar</button>
									</div>
								</div>
<?
} else {
?>
								No es posible aplicar credito a su pedido. El importe de su pedido no alcanza el valor mínimo para
								que su credito de cliente sea aplicable.<br />
								<ul>
									<li>Importe necesario: <?=$storeData->IMPORTE_MINIMO_APLICACION_CREDITO?> €</li>
									<li>Importe actual: <?=$this->totalLineas($newPedBridgeData->lineas)?> €</li>
									<li>Faltan: <?=$storeData->IMPORTE_MINIMO_APLICACION_CREDITO - $this->totalLineas($newPedBridgeData->lineas)?> €. <a href="#" title="Ver ofertas de valor aproximado"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
									<li>Crédito disponible: <?=$datosCli->saldoCredito?> €</li>
								</ul>
								<span id="creditoAplicar" data-credito-aplicar="0.00" data-saldo-inicial="<?=$datosCli->saldoCredito?>"></span>
<?
}
?>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Cupón descuento</h3>
							</div>
							<div class="panel-body">
								<div class="col-md-12">
									<?=$this->cuponSelectionControl($datosCli->arrCupones)?>
									<div class="form-group">
										<label class="control-label col-sm-2" for="addCupon"></label>
										<div class="text-right">
											<button type="button" id="addCupon" name="addCupon" class="btn btn-primary" aria-label="Añadir cupón"
												data-loading-text="Validando...">Añadir</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Descuentos que se aplicarán</h3>
							</div>
							<div class="panel-body">
								<ul id="ulDtos"></ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Comentarios</h3>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="control-label" for="comentarios"></label>
									<textarea class="form-control" id="comentarios" name="comentarios" rows="1"></textarea>
									<p class="help-block">Indique los comentarios que considere oportunos</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="step-pane sample-pane alert" data-step="3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Su pedido</h3>
					</div>
					<div class="panel-body">
						<table class="table table-striped">
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
<?
			foreach ($newPedBridgeData->lineas as $stdObjLinea) {
				$dtoTooltip='';
				$totalTipoDtoLinea=$this->totalDtoTipo($stdObjLinea);
				$totalImporteDtoLinea=$this->totalDtoImporte($stdObjLinea);
				foreach ($stdObjLinea->dtos as $stdObjDto) {
					$dtoTooltip.='<li>'.$stdObjDto->concepto.'</li>';
				}
				$dtoDesc='';
				if ($totalTipoDtoLinea>0) {
					$dtoDesc.=$totalTipoDtoLinea.'%';
				}
				if ($totalTipoDtoLinea>0 && $totalImporteDtoLinea>0) {
						$dtoDesc.=' + ';
				}
				if ($totalImporteDtoLinea>0) {
					$dtoDesc.=$totalImporteDtoLinea.'€';
				}
				if ($dtoDesc=='') {$dtoDesc='--';}
?>
								<tr class="trLinea"
									data-obj-linea='<?=json_encode($stdObjLinea)?>'
								>
									<td><?=$stdObjLinea->referencia;?></td>
									<td><?=$stdObjLinea->concepto;?></td>
									<td>(<?=$stdObjLinea->pai?>€*<?=$stdObjLinea->tipoIva?>%) <?=$this->pvp($stdObjLinea)?>€</td>
									<td><?=$stdObjLinea->cantidad?></td>
									<td><span data-toggle="tooltip" data-placement="left" data-html="true" title="<?=$dtoTooltip?>"><?=$dtoDesc?></span></td>
									<td class="totalLinea" data-totalLinea="<?=$this->total($stdObjLinea)?>"><?=$this->total($stdObjLinea)?>€</td>
								</tr>
<?
			}
?>
							</tbody>
						</table>
					</div>
					<div class="panel-footer text-right">
						<div>Total: <span id="spTotalLineas" class="spCalculado" data-total-lineas="<?=$this->totalLineas($newPedBridgeData->lineas)?>"><?=$this->totalLineas($newPedBridgeData->lineas)?></span> €</div>
						<div>
							<span id="tipDtosTipo">
								Descuentos porcentuales (<span id="spDtoTipo" class="spCalculado"></span>%): <span id="spDtoMonto" class="spCalculado"></span> €
							</span>
						</div>
						<div>
							<span id="tipDtosImporte">
								Descuentos por importe: <span id="spDescuentoImporte" class="spCalculado"></span> €</div>
							</span>
						<div>Gastos de envío: <span id="spPortes" class="spCalculado" data-portes="<?=$newPedBridgeData->portes?>"><?=$newPedBridgeData->portes?></span> €</div>
						<div>Total Pedido: <span id="spTotal" class="spCalculado"></span> €</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?="\n<!-- /".get_class()." -->\n"?>