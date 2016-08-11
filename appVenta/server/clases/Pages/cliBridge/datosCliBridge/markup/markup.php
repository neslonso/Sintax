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
					<input name="publicidad" id="publicidad" type="checkbox" data-initialize="checkbox" value="1" <?=(isset($arrCliente->cliente->publicidad))?"checked='checked'":"";?>/>
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
					<input name="factura" id="factura" type="checkbox" value="1" <?=(isset($arrCliente->cliente->factura))?"checked='checked'":"";?>/>
					<label for="factura" accesskey="">Recibir factura</label>
				</div>
				<div class="col-sm-3">
					<br>
					<input name="avisosSms" id="avisosSms.Dummy" type="hidden" value="0" />
					<input name="avisosSms" id="avisosSms" type="checkbox" value="1" <?=(isset($arrCliente->cliente->avisosSms))?"checked='checked'":"";?>/>
					<label for="avisosSms" accesskey="">Recibir SMS</label>
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
			Libreta de direcciones
		</div>
		<div class="panel-body">
<?
	if (!empty($arrCliente->direcciones)) {
		foreach ($arrCliente->direcciones as $direccion) {
?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<?=$direccion->nombre?>
				</div>
				<div class="panel-body">
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
				</div>
				<div class="panel-footer text-right">
					<button type="button" class="btn btn-success">
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



<?="\n<!-- /".get_class()." -->\n"?>
