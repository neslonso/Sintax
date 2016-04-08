<?="\n<!-- ".get_class()." -->\n"?>
<form action="<?=BASE_DIR.FILE_APP?>" method="post" enctype="multipart/form-data" id="frmMulti_pedido">
	<input name="MODULE" id="MODULE" type="hidden" value="actions"/>
	<input name="acClase" id="acClase" type="hidden" value="lsPedsBridge"/>
	<input name="acMetodo" id="acMetodo" type="hidden" value="acGrabar"/>
	<input name="acTipo" id="acTipo" type="hidden" value="stdAssoc"/>
	<input name="acReturnURI" id="acReturnURI" type="hidden" value="<?=$_SERVER["REQUEST_URI"]?>"/>
	<fieldset>
		<legend class="titulo">Listado de Pedidos</legend>
		<table id="multi_pedidoTable" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>numero</th>
					<th>Actualizado</th>
					<th>Estado</th>
					<th>total</th>
				</tr>
			</thead>
			<tbody>
<?
	foreach ($pedidos as $objPed) {
?>
				<tr data-id="<?=$objPed->id?>">
					<td>
						<?=$objPed->keyPedido?>
					</td>
					<td>
						<?=$objPed->momento?>
					</td>
					<td>
						<?=$objPed->nombreEstado?>
					</td>
					<td>
						<?=$objPed->total?>
					</td>
				</tr>
<?
	}
?>
			</tbody>
		</table>

	</fieldset>
</form>
<?="\n<!-- /".get_class()." -->\n"?>
