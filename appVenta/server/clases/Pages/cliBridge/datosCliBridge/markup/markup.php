<?="\n<!-- ".get_class()." -->\n"?>
<div class="container-fluid">
	<div class="page-header">
		<h1><?=$arrCliente->cliente->saludo?> <?=$arrCliente->cliente->nombre?></h1>
		<h3>
			<span class="label label-default">Descuento: <?=$arrCliente->cliente->tipoDescuento?> %</span> &nbsp;
			<span class="label label-default">Crédito: <?=$arrCliente->cliente->saldo?> €</span>
		</h3>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			Datos de acceso
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-6">
					<label for="email" accesskey="">Dirección de correo electrónico: </label><br />
					<input type="text" name="email" id="email" value="<?=$arrCliente->cliente->email?>" /><br />
				</div>
				<div class="col-sm-6">
					<label for="pass" accesskey="">Cambiar contraseña (vacio = no cambiar):</label><br />
					<input type="text" name="pass" id="pass" value="" />
				</div>
			</div>
		</div>
		<div class="panel-footer text-right">
			<button type="button" class="btn btn-success">
				<span class="glyphicon glyphicon-ok"></span> Guardar
			</button>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			Perfil del cliente
		</div>
		<div class="panel-body">
			<form action="<?=BASE_DIR.FILE_APP?>" method="post" enctype="multipart/form-data" id="frmCliEditPerfil">
				<input name="MODULE" id="MODULE" type="hidden" value="actions"/>
				<input name="acClase" id="acClase" type="hidden" value="datosCliBridge"/>
				<input name="acMetodo" id="acMetodo" type="hidden" value="acGrabarPerfil"/>
				<input name="acTipo" id="acTipo" type="hidden" value="stdAssoc"/>
				<input name="acReturnURI" id="acReturnURI" type="hidden" value="<?=$_SERVER["REQUEST_URI"]?>"/>
				<input name="hash" id="hash" type="hidden" value="<?=$hash?>"/>
				<input name="id" id="id" type="hidden" value="<?=$idUser?>"/>
				<div class="row">
					<div class="col-sm-3">
						<label for="nombre" accesskey="">Nombre:</label><br />
						<input type="text" name="nombre" id="nombre" value="<?=$arrCliente->cliente->nombre?>" />
					</div>
					<div class="col-sm-3">
						<label for="apellidos" accesskey="">Apellidos:</label><br />
						<input type="text" name="apellidos" id="apellidos" value="<?=$arrCliente->cliente->apellidos?>" />
					</div>
					<div class="col-sm-3">
						<label for="movil" accesskey="">Teléfono móvil:</label><br />
						<input type="text" name="movil" id="movil" value="<?=$arrCliente->cliente->movil?>" />
					</div>
					<div class="col-sm-3">
						<br>
						<input name="publicidad" id="publicidad.Dummy" type="hidden" value="0" />
						<input name="publicidad" id="publicidad" type="checkbox" data-initialize="checkbox" value="1" <?=($arrCliente->cliente->publicidad==1)?"checked='checked'":"";?>/>
						<label for="publicidad" accesskey="">Recibir publicidad</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<label for="nif" accesskey="">Nif/Cif:</label><br />
						<input type="text" name="nif" id="nif" value="<?=$arrCliente->cliente->nif?>" />
					</div>
					<div class="col-sm-3">
						<label for="razonSocial" accesskey="">Empresa:</label><br />
						<input type="text" name="razonSocial" id="razonSocial" value="<?=$arrCliente->cliente->razonSocial?>" />
					</div>
					<div class="col-sm-3">
						<br>
						<input name="factura" id="factura.Dummy" type="hidden" value="0" />
						<input name="factura" id="factura" type="checkbox" value="1" <?=($arrCliente->cliente->factura==1)?"checked='checked'":"";?>/>
						<label for="factura" accesskey="">Recibir factura</label>
					</div>
					<div class="col-sm-3">
						<br>
						<input name="avisosSms" id="avisosSms.Dummy" type="hidden" value="0" />
						<input name="avisosSms" id="avisosSms" type="checkbox" value="1" <?=($arrCliente->cliente->avisosSms==1)?"checked='checked'":"";?>/>
						<label for="avisosSms" accesskey="">Recibir SMS</label>
					</div>
				</div>
			</form>
		</div>
		<div class="panel-footer text-right">
			<button type="button" id="btnEnviarCliEditPerfil" class="btn btn-success">
				<span class="glyphicon glyphicon-ok"></span> Guardar
			</button>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			Libreta de direcciones
		</div>
		<div class="panel-body">
<?
	if (!empty($arrCliente->direcciones)) {
		foreach ($arrCliente->direcciones as $direccion) {
?>
			<div id="panelDir<?=$direccion->id?>" class="panel panel-warning">
				<div class="panel-heading">
					<?=$direccion->nombre?>
				</div>
				<div class="panel-body">
					<form action="<?=BASE_DIR.FILE_APP?>" method="post" enctype="multipart/form-data" id="frmCliDir<?=$direccion->id?>">
						<input name="MODULE" id="MODULE" type="hidden" value="actions"/>
						<input name="acClase" id="acClase" type="hidden" value="datosCliBridge"/>
						<input name="acMetodo" id="acMetodo" type="hidden" value="acGrabarDireccion"/>
						<input name="acTipo" id="acTipo" type="hidden" value="stdAssoc"/>
						<input name="acReturnURI" id="acReturnURI" type="hidden" value="<?=$_SERVER["REQUEST_URI"]?>"/>
						<input name="hash" id="hash" type="hidden" value="<?=$hash?>"/>
						<input name="id" id="id" type="hidden" value="<?=$direccion->id?>"/>
						<div class="row">
							<div class="col-sm-6">
								<label for="nombre" accesskey="">Nombre:</label><br />
								<input type="text" name="nombre" id="nombre" value="<?=$direccion->nombre?>" />
							</div>
							<div class="col-sm-6">
								<label for="destinatario" accesskey="">Destinatario:</label><br />
								<input type="text" name="destinatario" id="destinatario" value="<?=$direccion->destinatario?>" />
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<label for="direccion" accesskey="">Direccion:</label><br />
								<input type="text" name="direccion" id="direccion" value="<?=$direccion->direccion?>" />
							</div>
							<div class="col-sm-4">
								<label for="poblacion" accesskey="">Poblacion:</label><br />
								<input type="text" name="poblacion" id="poblacion" value="<?=$direccion->poblacion?>" />
							</div>
							<div class="col-sm-4">
								<label for="provincia" accesskey="">Provincia:</label><br />
								<input type="text" name="provincia" id="provincia" value="<?=$direccion->provincia?>" />
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<label for="cp" accesskey="">Código postal:</label><br />
								<input type="text" name="cp" id="cp" value="<?=$direccion->cp?>" />
							</div>
							<div class="col-sm-4">
								<label for="pais" accesskey="">País:</label><br />
								<input type="text" name="pais" id="pais" value="<?=$direccion->pais?>" />
							</div>
							<div class="col-sm-4">
								<label for="movil" accesskey="">Teléfono de contacto:</label><br />
								<input type="text" name="movil" id="movil" value="<?=$direccion->movil?>" />
							</div>
						</div>
					</form>
				</div>
				<div class="panel-footer text-right">
					<button type="button" onclick="borrarDireccion('<?=$direccion->id?>');" class="btn btn-danger">
						<span class="glyphicon glyphicon-remove"></span> Eliminar
					</button>
					<button type="button" onclick="grabarDireccion('<?=$direccion->id?>');" class="btn btn-success">
						<span class="glyphicon glyphicon-ok"></span> Guardar
					</button>
				</div>
			</div>
<?
		}
	} else {
?>
			<div> Todavía no tiene ninguna dirección </div>
<?
	}
?>
		</div>
		<div class="panel-footer text-right">
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalAddDir">
					<span class="glyphicon glyphicon-plus"></span> Añadir dirección
				</button>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			Cupones descuento
		</div>
		<div class="panel-body">
			<table id="multi_cuponesTable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Cupón</th>
						<th>Descuento</th>
						<th>Caducidad</th>
						<th>Pedidos</th>
					</tr>
				</thead>
				<tbody>
<?
			foreach ($arrCliente->cupones as $cupon) {
?>
					<tr data-id="<?=$cupon->id?>">
						<td>
							<?=$cupon->cupon?>
						</td>
						<td>
							<?=$cupon->tipoDescuento?> %
						</td>
						<td>
							<?=$cupon->caducidad?>
						</td>
						<td>
							<?=$cupon->pedidos?>
						</td>
					</tr>
<?
			}
?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			Apuntes de crédito
		</div>
		<div class="panel-body">
			<table id="multi_apuntesTable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Fecha</th>
						<th>Monto</th>
						<th>Descripcion</th>
						<th>Caducidad</th>
					</tr>
				</thead>
				<tbody>
<?
			foreach ($arrCliente->apuntes as $apunte) {
?>
					<tr data-id="<?=$cupon->id?>">
						<td>
							<?=$apunte->insert?>
						</td>
						<td>
							<?=$apunte->monto?> €
						</td>
						<td>
							<?=$apunte->descripcion?>
						</td>
						<td>
							<?=$apunte->caducidad?>
						</td>
					</tr>
<?
			}
?>
				</tbody>
			</table>
		</div>
	</div>

</div>

<div class="modal fade" id="modalAddDir" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Añadir dirección</h4>
			</div>
			<div class="modal-body">
				<form action="<?=BASE_DIR.FILE_APP?>" method="post" enctype="multipart/form-data" id="frmAddDir">
					<input name="MODULE" id="MODULE" type="hidden" value="actions"/>
					<input name="acClase" id="acClase" type="hidden" value="datosCliBridge"/>
					<input name="acMetodo" id="acMetodo" type="hidden" value="acGrabarDireccion"/>
					<input name="acTipo" id="acTipo" type="hidden" value="stdAssoc"/>
					<input name="acReturnURI" id="acReturnURI" type="hidden" value="<?=$_SERVER["REQUEST_URI"]?>"/>
					<input name="hash" id="hash" type="hidden" value="<?=$hash?>"/>
					<input name="id" id="id" type="hidden" value="0"/>
					<input name="idMulti_cliente" id="idMulti_cliente" type="hidden" value="<?=$arrCliente->cliente->id?>"/>
					<div class="row">
						<div class="col-sm-6">
							<label for="nombre" accesskey="">Nombre:</label><br />
							<input type="text" name="nombre" id="nombre" value="" placeholder="Nombre para identificar esta dirección..." />
						</div>
						<div class="col-sm-6">
							<label for="destinatario" accesskey="">Destinatario:</label><br />
							<input type="text" name="destinatario" id="destinatario" value="<?=$arrCliente->cliente->nombre?> <?=$arrCliente->cliente->apellidos?>"  placeholder="Destinatario del envio" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<label for="direccion" accesskey="">Direccion:</label><br />
							<input type="text" name="direccion" id="direccion" value="" placeholder="Dirección completa" />
						</div>
						<div class="col-sm-4">
							<label for="poblacion" accesskey="">Poblacion:</label><br />
							<input type="text" name="poblacion" id="poblacion" value="" placeholder="Población"/>
						</div>
						<div class="col-sm-4">
							<label for="provincia" accesskey="">Provincia:</label><br />
							<input type="text" name="provincia" id="provincia" value="" placeholder="Provincia" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<label for="cp" accesskey="">Código postal:</label><br />
							<input type="text" name="cp" id="cp" value="" placeholder="Código postal" />
						</div>
						<div class="col-sm-4">
							<label for="pais" accesskey="">País:</label><br />
							<input type="text" name="pais" id="pais" value="España" placeholder"País" />
						</div>
						<div class="col-sm-4">
							<label for="movil" accesskey="">Teléfono de contacto:</label><br />
							<input type="text" name="movil" id="movil" value="<?=$arrCliente->cliente->movil?>" placeholder"Teléfono de contacto"/>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" id="btnAddDir" class="btn btn-primary">Grabar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?="\n<!-- /".get_class()." -->\n"?>
