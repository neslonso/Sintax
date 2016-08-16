<?="\n<!-- ".get_class()." -->\n"?>

<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-heading">
			Acceso
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
			<button type="button" class="btn btn-primary btn-sm">
				<span class="glyphicon glyphicon-ok"></span> Entrar
			</button>
		</div>
	</div>
<?
if (isset($arrResult->datos)) {
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<?=$arrResult->datos->saludo?> <?=$arrResult->datos->nombre?>
		</div>
		<div class="panel-body">
			<div>
				Descuento: <span class="label label-default"><?=$arrResult->datos->tipoDescuento?> %</span>
			</div>
			<div>
				Crédito: <span class="label label-default"><?=$arrResult->datos->saldo?> €</span>
			</div>
			<div>
				<a href="">Datos personales</a>
			</div>
			<div>
				<a href="">Historial de pedidos</a>
			</div>
		</div>
		<div class="panel-footer text-right">
			<button type="button" class="btn btn-primary">
				<span class="glyphicon glyphicon-remove"></span> Salir
			</button>
		</div>
	</div>
<?
}
?>
</div>
<?="\n<!-- /".get_class()." -->\n"?>
