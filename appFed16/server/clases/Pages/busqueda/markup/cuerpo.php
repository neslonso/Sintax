<?="\n<!-- ".get_class()." -->\n"?>
<?="\n<!-- /".get_class()." -->\n"?>
<div class="container shop-item-container" id="container-cuerpo">
	<div>
		<div class="categoria-cabecera text-left">
			<h1><i class="fa fa-search" aria-hidden="true"></i> Resultados de la búsqueda <?=$txtBusqueda?></h1>
		</div>
	</div>
	<?\Sintax\ApiService\Categorias::listaFichaProductoResponsive($arrOfers);?>
</div>
