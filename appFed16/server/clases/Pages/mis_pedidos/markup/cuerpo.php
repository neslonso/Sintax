<?="\n<!-- ".get_class()." -->\n"?>
<div class="container-fluid">
	<div class="page-header">
		<h1>Historial de pedidos</h1>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Listado de Pedidos
		</div>
		<div class="panel-body">
			<form action="<?=BASE_DIR.FILE_APP?>" method="post" enctype="multipart/form-data" id="frmMulti_pedido">
				<input name="MODULE" id="MODULE" type="hidden" value="actions"/>
				<input name="acClase" id="acClase" type="hidden" value="lsPedsBridge"/>
				<input name="acMetodo" id="acMetodo" type="hidden" value="acGrabar"/>
				<input name="acTipo" id="acTipo" type="hidden" value="stdAssoc"/>
				<input name="acReturnURI" id="acReturnURI" type="hidden" value="<?=$_SERVER["REQUEST_URI"]?>"/>
				<input name="store" id="store" type="hidden" value="<?=$store?>"/>
				<input name="idUser" id="idUser" type="hidden" value="<?=$idUser?>"/>
				<table id="multi_pedidoTable<?=$store?>" class="table table-striped table-bordered">
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
						<tr data-id="<?=$objPed->id?>" style="cursor:pointer;">
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
								<?=$objPed->total?> €
							</td>
						</tr>
<?
			}
?>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
<?="\n<!-- /".get_class()." -->\n"?>