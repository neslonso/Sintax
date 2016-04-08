<?="\n<!-- ".get_class()." -->\n"?>
<form action="<?=BASE_DIR.FILE_APP?>" method="post" enctype="multipart/form-data" id="frmMulti_pedido">
	<input name="MODULE" id="MODULE" type="hidden" value="actions"/>
	<input name="acClase" id="acClase" type="hidden" value="lsPedsBridge"/>
	<input name="acMetodo" id="acMetodo" type="hidden" value="acGrabar"/>
	<input name="acTipo" id="acTipo" type="hidden" value="stdAssoc"/>
	<input name="acReturnURI" id="acReturnURI" type="hidden" value="<?=$_SERVER["REQUEST_URI"]?>"/>
	<fieldset>
		<legend class="titulo">Listado de Pedidos</legend>
		<table id="multi_pedidoTable" class="stdDataTable"></table>
	</fieldset>
</form>
<?="\n<!-- /".get_class()." -->\n"?>
