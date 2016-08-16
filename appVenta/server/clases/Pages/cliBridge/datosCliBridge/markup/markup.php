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
					<div class="form-group">
						<label for="email" accesskey="">Dirección de correo electrónico: </label><br />
						<input class="form-control" type="text" name="email" id="email" value="<?=$arrCliente->cliente->email?>" /><br />
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="pass" accesskey="">Cambiar contraseña:</label>
						<input class="form-control" type="password" name="pass" id="pass" value="" />
						<p class="help-block">Déjelo vacío si no desea cambiar la contraseña</p>
					</div>
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
						<div class="form-group">
							<label class="control-label" for="nombre">Nombre:</label>
							<input class="form-control" type="text" name="nombre" id="nombre" value="<?=$arrCliente->cliente->nombre?>" />
							<p class="help-block">Introduzca su nombre de pila</p>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label for="apellidos" accesskey="">Apellidos:</label>
							<input class="form-control" type="text" name="apellidos" id="apellidos" value="<?=$arrCliente->cliente->apellidos?>" />
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label for="movil" accesskey="">Teléfono móvil:</label>
							<input class="form-control" type="text" name="movil" id="movil" value="<?=$arrCliente->cliente->movil?>" />
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input name="publicidad" id="publicidad.Dummy" type="hidden" value="0" />
							<input name="publicidad" id="publicidad" type="checkbox" data-initialize="checkbox" value="1" <?=($arrCliente->cliente->publicidad==1)?"checked='checked'":"";?>/>
							<label for="publicidad" accesskey="">Recibir publicidad</label>
							<p class="help-block">Márquelo si desea recibir correos promocionales</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label for="nif" accesskey="">Nif/Cif:</label>
							<input class="form-control"type="text" name="nif" id="nif" value="<?=$arrCliente->cliente->nif?>" />
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label for="razonSocial" accesskey="">Empresa:</label>
							<input class="form-control" type="text" name="razonSocial" id="razonSocial" value="<?=$arrCliente->cliente->razonSocial?>" />
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input name="factura" id="factura.Dummy" type="hidden" value="0" />
							<input name="factura" id="factura" type="checkbox" value="1" <?=($arrCliente->cliente->factura==1)?"checked='checked'":"";?>/>
							<label for="factura" accesskey="">Recibir factura</label>
							<p class="help-block">Márquelo si desea recibir la factura</p>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<input name="avisosSms" id="avisosSms.Dummy" type="hidden" value="0" />
							<input name="avisosSms" id="avisosSms" type="checkbox" value="1" <?=($arrCliente->cliente->avisosSms==1)?"checked='checked'":"";?>/>
							<label for="avisosSms" accesskey="">Recibir SMS</label>
							<p class="help-block">Márquelo si desea recibir mensajes SMS</p>
						</div>
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
								<div class="form-group">
									<label for="nombre" accesskey="">Nombre:</label>
									<input class="form-control" type="text" name="nombre" id="nombre" value="<?=$direccion->nombre?>" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="destinatario" accesskey="">Destinatario:</label>
									<input class="form-control" type="text" name="destinatario" id="destinatario" value="<?=$direccion->destinatario?>" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label for="direccion" accesskey="">Direccion:</label>
									<input class="form-control" type="text" name="direccion" id="direccion" value="<?=$direccion->direccion?>" />
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="poblacion" accesskey="">Poblacion:</label>
									<input class="form-control" type="text" name="poblacion" id="poblacion" value="<?=$direccion->poblacion?>" />
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="provincia" accesskey="">Provincia:</label>
									<input class="form-control" type="text" name="provincia" id="provincia" value="<?=$direccion->provincia?>" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label for="cp" accesskey="">Código postal:</label>
									<input class="form-control" type="text" name="cp" id="cp" value="<?=$direccion->cp?>" />
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="pais" accesskey="">País:</label>
									<input class="form-control" type="text" name="pais" id="pais" value="<?=$direccion->pais?>" />
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="movil" accesskey="">Teléfono de contacto:</label>
									<input class="form-control" type="text" name="movil" id="movil" value="<?=$direccion->movil?>" />
								</div>
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
							<div class="form-group">
								<label for="nombre" accesskey="">Nombre:</label>
								<input class="form-control" type="text" name="nombre" id="nombre" value="" placeholder="Nombre para identificar esta dirección..." />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="destinatario" accesskey="">Destinatario:</label>
								<input class="form-control" type="text" name="destinatario" id="destinatario" value="<?=$arrCliente->cliente->nombre?> <?=$arrCliente->cliente->apellidos?>"  placeholder="Destinatario del envio" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label for="direccion" accesskey="">Direccion:</label>
								<input class="form-control" type="text" name="direccion" id="direccion" value="" placeholder="Dirección completa" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="poblacion" accesskey="">Poblacion:</label>
								<input class="form-control" type="text" name="poblacion" id="poblacion" value="" placeholder="Población"/>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="provincia" accesskey="">Provincia:</label>
								<input class="form-control" type="text" name="provincia" id="provincia" value="" placeholder="Provincia" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label for="cp" accesskey="">Código postal:</label>
								<input class="form-control" type="text" name="cp" id="cp" value="" placeholder="Código postal" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="pais" accesskey="">País:</label>
								<input class="form-control" type="text" name="pais" id="pais" value="España" placeholder"País" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="movil" accesskey="">Teléfono de contacto:</label>
								<input class="form-control" type="text" name="movil" id="movil" value="<?=$arrCliente->cliente->movil?>" placeholder"Teléfono de contacto"/>
							</div>
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
