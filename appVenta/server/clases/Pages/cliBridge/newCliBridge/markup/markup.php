<?="\n<!-- ".get_class()." -->\n"?>
<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-heading">
			Registro de usuario
			<input type="hidden" name="keyTienda" id="keyTienda" value="<?=$keyTienda?>" />
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label for="email" accesskey="">Correo electrónico: </label>
						<input class="form-control" type="text" name="email" id="email" value="" placeholder="correo@electronico.com" />
						<p class="help-block">Email de acceso al sitio</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="pass" accesskey="">Contraseña:</label>
						<input class="form-control" type="password" name="pass" id="pass" value="" />
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="pass" accesskey="">Repite contraseña:</label>
						<input class="form-control" type="password" name="pass2" id="pass2" value="" />
						<p class="help-block">Repite nuevamente tu contraseña</p>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer text-right">
			<button type="button" id="btnEnviarLogin" class="btn btn-primary">
				<span class="glyphicon glyphicon-ok"></span> Enviar
			</button>
		</div>
	</div>
</div>

<?="\n<!-- /".get_class()." -->\n"?>
