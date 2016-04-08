<?="\n<!-- ".get_class()." -->\n"?>

<?="<pre>".print_r($arrPedido,true)."</pre>"?>

<?
/*
		<form action="./actions.php" method="post" enctype="multipart/form-data" id="frmPedStatus" class="stdFrm">
			<fieldset>
				<legend>Pedido #<?=sprintf('%06u',$objPed->GETnumero())?> (<?=Fecha::toFechaES(Fecha::fromMysql($objPed->GETinsert()))?>)</legend>
				<table class="tableLineas ui-widget">
					<thead class="ui-widget-header"><tr>
						<th class="referencia">Ref.</th>
						<th class="concepto">Concepto</th>
						<th class="precioU">Precio</th>
						<th class="cantidad">Cantidad</th>
						<th class="dto">Descuento</td>
						<th class="totalLinea">Total</th>
					</tr></thead>
					<tbody class="ui-widget-content">
<?
$i=1;
foreach ($objPed->arrIdLineas() as $idPedLinea) {
	$parImpar=($i%2==0)?'par':'impar';
	$i++;
	$objPedLinea=new PedidoLinea($idPedLinea);
?>
						<tr class="<?=$parImpar?>">
							<td class="referencia"><?=$objPedLinea->GETreferencia();?></td>
							<td class="concepto"><?=$objPedLinea->GETconcepto();?></td>
							<td class="precioU moneda"><?=Cadena::toLocalNumber($objPedLinea->pvp(),3);?> €</td>
							<td class="cantidad">
								<?=$objPedLinea->GETcantidad();?>
								<span title="Añadir 1" class="btnLinea btnMas1" data-id-linea="<?=$objPedLinea->GETid();?>"></span>
								<span title="Quitar 1" class="btnLinea btnMenos1" data-id-linea="<?=$objPedLinea->GETid();?>"></span>
								<span title="Quitar todos" class="btnLinea btnMenosTodos" data-id-linea="<?=$objPedLinea->GETid();?>"></span>
							</td>
							<td class="dto moneda"><?=$objPedLinea->GETtipoDescuento();?>% (<?=Cadena::toLocalNumber($objPedLinea->totalDescuentoPvp(),2);?> €)</td>
							<td class="totalLinea moneda"><?=Cadena::toLocalNumber($objPedLinea->total(),2)?> €</td>
						</tr>
<?
}
?>
					</tbody>
					<tfoot class="ui-widget-header"><tr>
						<td rowspan="6" colspan="4"></td>
						<td colspan="2"></td>
					</tr><tr>
						<td class="labelTotalLineas">Total:</td>
						<td class="totalLineas moneda"><?=Cadena::toLocalNumber($objPed->base()+$objPed->iva(),2);?> €</td>
					</tr><tr>
						<td class="labelTotalDescuento">Descuento (<?=Cadena::toLocalNumber($objPed->GETtipoDescuento(),2)?>%):</td>
						<td class="totalDescuento moneda"><?=Cadena::toLocalNumber($objPed->totalDescuentoPvp(),2)?> €</td>
<?
if ($objPed->GETcredito()>0) {
?>
					</tr><tr>
						<td class="labelTotalCredito">Crédito:</td>
						<td class="totalCredito moneda"><?=Cadena::toLocalNumber($objPed->GETcredito(),2)?> €</td>
<?
}
?>
					</tr><tr>
						<td class="labelPortes">Gastos de envío:</td>
						<td class="portes moneda"><?=Cadena::toLocalNumber($objPed->totalPortes(),2)?> €</td>
					</tr><tr>
						<td class="labelTotalPedido">Total pedido:</td>
						<td class="totalPedido moneda"><?=Cadena::toLocalNumber($objPed->total(),2)?> €</td>
					</tr></tfoot>
				</table>

				<table><tr>
					<td style="width:50%; padding-right:7px;">
						<fieldset class="borderBox" style="">
							<legend>Mensajes del pedido</legend>
							<div style="height:100%; overflow:auto;">
		<?
		foreach ($objPed->arrIdsMensajes() as $idPedMsg) {
			$objPedMsg=new PedidoMensaje($idPedMsg);
			$destaque=($objPedMsg->GETleido())?"":"ui-state-highlight";
			$remitente=($objPedMsg->GETdeCliente())?$objCliente->GETnombre().' '.$objCliente->GETapellidos():SITE_NAME;
			$marcableComoLeido=(!$objPedMsg->GETdeCliente() && !$objPedMsg->GETleido())?'marcableComoLeido':'';
		?>
								<fieldset data-id-ped-msg="<?=$objPedMsg->GETid()?>"
									class="fldPedMsg <?=$destaque?> <?=$marcableComoLeido?>">
									<legend><?=$remitente?> .- <?=Fecha::toFechaES(Fecha::fromMysql($objPedMsg->GETinsert()))?></legend>
									<pre class="textoMensaje"><?=$objPedMsg->GETmensaje()?></pre>
								</fieldset>
								<br />
		<?
		}
		?>
								<fieldset>
									<legend>Enviar nuevo mensaje</legend>
									<textarea name="comentarios" id="comentarios" style="width:100%;"></textarea>
									<div id="btnEnviarMensaje" data-id-pedido="<?=$objPed->GETid();?>">Enviar</div>
								</fieldset>
							</div>
						</fieldset>
					</td>
					<td style="width:50%; padding-right:7px;">
						<fieldset class="borderBox" style="height:125px;">
							<legend>Entrega del pedido</legend>
							<div style="height:100%; overflow:auto; padding-right:7px;">
								Don/Dª <?=$objPed->GETnombre().' '.$objPed->GETapellidos();?><br />
								<?=$objPed->GETdireccion()?><br />
								<?=$objPed->GETcp();?> <?=$objPed->GETpoblacion();?><br />
								<?=$objPed->GETprovincia();?><br />
								Horario de entrega preferente:<?=$objPed->GEThorario();?>
							</div>
						</fieldset>
						<br />
						<fieldset class="borderBox" style="">
							<legend>Estado actual del pedido</legend>
							<div style="height:100%; padding-right:7px;">
								<div style="font-size:larger; font-weight:bolder;"><?=$objPedidoEstado->GETnombre();?></div>
								<br />
								<?=$objPed->descripcionEstadoActual("divDatosParseadosEstado");?><br />
								<div style="text-align: right;">
									<div id="btnCorreoEstado" data-id-pedido="<?=$objPed->GETid();?>">
										Recibir esta información por email
									</div>
								</div>


<?
*/
?>








<?="\n<!-- /".get_class()." -->\n"?>
