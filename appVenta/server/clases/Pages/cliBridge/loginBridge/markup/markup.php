<?="\n<!-- ".get_class()." -->\n"?>

<div class="container-fluid containerLateral">
<?
if (isset($_SESSION['usuario'])) {
?>
	<div class="panel panel-default text-center">
		<div class="panel-heading">
			<?=$arrResult->datos->saludo?> <?=$arrResult->datos->nombre?>
		</div>
		<div class="panel-body">
			<div>
				Descuento:<br /><span class="label label-default"><?=$arrResult->datos->tipoDescuento?> %</span>
			</div>
			<div>
				Crédito:<br /><span class="label label-default"><?=$arrResult->datos->saldo?> €</span>
			</div>
			<hr />
			<div>
				<a id="lnkDatos" href="#">Datos personales</a>
			</div>
			<hr />
			<div>
				<a id="lnkHistorial" href="#">Historial de pedidos</a>
			</div>
		</div>
		<div class="panel-footer text-right">
			<button id="btnLogout" type="button" class="btn btn-primary">
				<span class="glyphicon glyphicon-remove"></span> Salir
			</button>
		</div>
	</div>
<?
} else {
?>
	<div class="panel panel-default">
		<form id="frmLogin">
			<div class="panel-heading">
				Acceso
				<input type="hidden" name="keyTienda" id="keyTienda" value="<?=$keyTienda?>" />
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="email" accesskey="">Email: </label>
					<input  class="form-control" type="text" name="email" id="email" value="" />
				</div>
				<div class="form-group">
					<label for="pass" accesskey="">Clave:</label>
					<input class="form-control" type="password" name="pass" id="pass" value="" />
				</div>
			</div>
			<div class="panel-footer text-right">
					<button id="btnLogin" type="button" class="btn btn-primary btn-sm">
						<span class="glyphicon glyphicon-ok"></span> Entrar
					</button>
					<button id="btnRegistro" type="button" class="btn btn-default btn-sm btn-margin-top">
						<span class="glyphicon glyphicon-plus"></span> Registrate
					</button>
			</div>
		</form>
	</div>
<?
}
?>
</div>
<?="\n<!-- /".get_class()." -->\n"?>
