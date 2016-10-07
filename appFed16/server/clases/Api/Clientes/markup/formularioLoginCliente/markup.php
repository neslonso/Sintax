<?="\n<!-- ".get_class()." -->\n"?>
	<div class="page-header">
		<h1>Acceso de cliente</h1>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Identificación de usuario
			<input type="hidden" name="keyTienda" id="keyTiendaNewUsr" value="<?=$keyTienda?>" />
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="email" accesskey="">Correo electrónico: </label>
						<input  class="form-control" type="text" name="email" id="emailLoginUser" value="" placeholder="correo@electronico.com" />
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="pass" accesskey="">Contraseña:</label>
						<input class="form-control" type="password" name="pass" id="passLoginUser" value="" />
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer text-right">
			<button type="button" id="btnLoginUser" class="btn btn-primary">
				<span class="glyphicon glyphicon-ok"></span> Entrar
			</button>
		</div>
	</div>
<?="\n<!-- /".get_class()." -->\n"?>

