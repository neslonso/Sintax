<?="\n<!-- ".get_class()." -->\n"?>
<div class="container-fluid">
	<div class="page-header">
		<h1>Detalle de pedido</h1>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Pedido #<?=sprintf('%06u',$arrPedido->pedido->numero)?> (<?=$arrPedido->pedido->fecha?>)
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
			foreach ($arrPedido->lineas as $linea) {
?>
					<tr>
						<td><?=$linea->referencia;?></td>
						<td><?=$linea->concepto;?></td>
						<td><?=$linea->pvp;?> €</td>
						<td><?=$linea->cantidad?></td>
						<td><?=$linea->descuentoPercent;?>% (<?=$linea->descuento;?> €)</td>
						<td><?=$linea->total?> €</td>
					</tr>
<?
			}
?>
				</tbody>
			</table>
		</div>
		<div class="panel-footer text-right">
			<div>Total: <?=$arrPedido->pedido->totalLineas?> €</div>
			<div>Descuentos por importe: <?=$arrPedido->pedido->totalImporteDescuentoPed?> €</div>
			<div>Descuentos porcentuales (<?=$arrPedido->pedido->descuentoPercent?> %): <?=$arrPedido->pedido->descuento?> €</div>
			<div>Gastos de envío: <?=$arrPedido->pedido->portes?> €</div>
			<div>Total Pedido: <?=$arrPedido->pedido->total?> €</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
<?
		if ($arrPedido->pedido->sacarPanelRePagar==1) {
			$txtPopup="";
			if($popup){
				//marcamos el contenido para también sacarlo en popup
				$txtPopup="id='txtPopup'";
			}
?>
			<div class="panel panel-default">
				<div class="panel-heading">
					Continuación del pedido
				</div>
				<div class="panel-body">
					<div <?=$txtPopup?>><?=$arrPedido->pedido->infoContinuacionPedido?></div>
				</div>
			</div>
<?
		}
?>
			<div class="panel panel-default">
				<div class="panel-heading">
					Mensajes del pedido
				</div>
				<div class="panel-body">

<?
				if (empty($arrPedido->mensajes)) {
?>
					<div>No hay mensajes</div>
<?
				} else {
					foreach ($arrPedido->mensajes as $mensaje) {
						$destaque=($mensaje->leido)?"":"ui-state-highlight";
						$remitente=$mensaje->remitente;
						//$marcableComoLeido=(!$objPedMsg->GETdeCliente() && !$objPedMsg->GETleido())?'marcableComoLeido':'';
?>
						<fieldset data-id-ped-msg="<?=$mensaje->id?>"
							class="fldPedMsg <?=$destaque?> <?//=$marcableComoLeido?>">
							<legend><?=$remitente?> .- <?=$mensaje->fecha?></legend>
							<pre class="textoMensaje"><?=$mensaje->mensaje?></pre>
						</fieldset>
<?
					}
				}
?>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					Entrega del pedido
				</div>
				<div class="panel-body">
					<div>Don/Dª <?=$arrPedido->pedido->entregaNombre.' '.$arrPedido->pedido->entregaApellidos?></div>
					<div><?=$arrPedido->pedido->entregaDireccion?></div>
					<div><?=$arrPedido->pedido->entregaCP?> <?=$arrPedido->pedido->entregaPoblacion?></div>
					<div><?=$arrPedido->pedido->entregaProvincia?></div>
					<div>Horario de entrega preferente: <?=$arrPedido->pedido->entregaHorario?></div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					Estado actual del pedido
				</div>
				<div class="panel-body">
					<div><?=$arrPedido->pedido->estado?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?="\n<!-- /".get_class()." -->\n"?>