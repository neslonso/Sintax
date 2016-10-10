<?="\n<!-- ".get_class()." -->\n"?>
<div class="container-fluid">
	<div class="panel panel-default" style="margin-top:20px;">
		<div class="panel-heading">
			Finalización de pedido
		</div>
		<div class="panel-body">
<?
		if ($pagado){
?>
			<p>Su pago ha sido realizado correctamente. Muchas gracias por su compra.</p>
<?
		} else {
?>
			<p>Ha ocurrido alguna incidencia en su proceso de pago. Disculpe las molestias</p>
<?
		}
?>
			<p>
				Puede consultar el estado de sus pedidos siguiento <a href="<?=$urlPeds?>">este enlace</a>
			</p>
		</div>
	</div>
</div>
<?="\n<!-- /".get_class()." -->\n"?>
