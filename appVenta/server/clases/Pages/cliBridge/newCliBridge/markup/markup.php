<?="\n<!-- ".get_class()." -->\n"?>
<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-heading">
			Registro de usuario
			<input type="hidden" name="hash" id="hash" value="<?=$hash?>" /><br />
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-4">
					<label for="email" accesskey="">Correo electrónico: </label><br />
					<input type="text" name="email" id="email" value="" /><br />
				</div>
				<div class="col-sm-4">
					<label for="pass" accesskey="">Contraseña:</label><br />
					<input type="text" name="pass" id="pass" value="" />
				</div>
				<div class="col-sm-4">
					<label for="pass" accesskey="">Repite contraseña:</label><br />
					<input type="text" name="pass2" id="pass2" value="" />
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
