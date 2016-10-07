<?="\n<!-- ".get_class()." -->\n"?>
	<div class="page-header">
		<h1>Alta de cliente</h1>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Registro de usuario
			<input type="hidden" name="keyTienda" id="keyTiendaNewUsr" value="<?=$keyTienda?>" />
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label for="email" accesskey="">Correo electrónico: </label>
						<input class="form-control" type="text" name="email" id="emailNewUsr" value="" placeholder="correo@electronico.com" />
						<p class="help-block">Email de acceso al sitio</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="pass" accesskey="">Contraseña:</label>
						<input class="form-control" type="password" name="pass" id="passNewUsr" value="" />
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="pass" accesskey="">Repite contraseña:</label>
						<input class="form-control" type="password" name="pass2" id="pass2NewUsr" value="" />
						<p class="help-block">Repetir contraseña</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<input type="checkbox" name="checkLegal" id="checkLegal" value="1" />
						<label for="legal" accesskey="">Acepto las <a href="<?=BASE_URL?>aviso_legal/">condiciones de uso</a></label>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer text-right">
			<button type="button" id="btnNewUser" class="btn btn-primary">
				<span class="glyphicon glyphicon-ok"></span> Enviar
			</button>
		</div>
	</div>
<?="\n<!-- /".get_class()." -->\n"?>