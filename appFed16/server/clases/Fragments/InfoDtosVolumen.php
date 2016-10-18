<?
class InfoDtosVolumen {
	public function __construct(\Sintax\Core\IPage $objPage) {}
	public function markup() {
		$storeData=\Sintax\ApiService\Pedidos::getStoreData();
		ob_start();
?>
						<!--
							<a href="javascript:void(null);" class="btn btn-default btn-menu hidden-xs" id="info-toggle"><span class="glyphicon glyphicon-info-sign"></span></a>
						-->
						<div id="infoDropdown" class="btn-group">
							<button type="button" class="btn btn-default btn-menu dropdown-toggle hidden-xs" data-toggle="dropdown">
								<span class="glyphicon glyphicon-info-sign"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li>
 									<div class="container-fluid">
				<div>Descuentos por volumen</div>
				<table border="0" cellpadding="0" cellspacing="0">
				<tr><th>Desde</th><th>Descuento</th></tr>
<?
	foreach ($storeData->DTOS_VOLUMEN_PEDIDO as $objDtoData) {
		$dto=$objDtoData->volumen;
		$porcen=$objDtoData->tipo;
?>
				<tr><td><?=$dto?> €</td><td><?=$porcen?> %</td></tr>
<?
	}
?>
				</table>
									</div>
								</li>
							</ul>
						</div>
<?
		$result=ob_get_clean();
		return $result;
	}
	public function style() {
		return '
			#infoDropdown>button {
				margin-left:0.25em;
			}
			#infoDropdown .container-fluid>div {
				font-weight:bold;
				color: @color-principal;
				white-space: nowrap;
				text-align: center;
				margin-bottom: 0.5em;
			}
			#infoDropdown table {
				width: 100%;
				border: solid @color-principal 1px;
				margin-bottom: 0.5em;
			}
			#infoDropdown table th {
				color: @color-secundario;
				background-color: @color-principal;
				padding: 0.5em;
			}
			#infoDropdown table td {
				padding: 0.3em 0.7em;
			}
			#infoDropdown table tr:nth-child(even) {
				background-color: @color-secundario;
			}
			#infoDropdown table th:nth-child(even),
			#infoDropdown table td:nth-child(even) {
				text-align:right;
			}
		';
	}
	public function code() {
		/*$("#info-toggle").on("click", function() {
			console.log("#info-toggle click");
			$div=$("<div>").css({
				"position":"absolute",
			})
			.html("Aqui la info de descuentos")
			.appendTo($(this).parent());
		});*/
		return '';
	}
}
