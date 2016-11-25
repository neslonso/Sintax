<?="\n<!-- ".get_class()." -->\n"?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Su pedido</h3>
		</div>
		<div class="panel-body">
			<table id="tableLineas" class="table table-striped" data-arr-lineas="">
				<thead>
					<tr>
						<th>Ref.</th>
						<th>Concepto</th>
						<th>Precio</th>
						<th>Cantidad</th>
						<th>Descuento</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<!-- -->
				</tbody>
			</table>
		</div>
		<div class="panel-footer text-right">
			<div>Total productos: <span id="spTotalLineas" class="spTotalLineas spCalculado" data-total-lineas=""></span> €</div>
			<div>
				<span id="tipDtosImporte">
					Descuentos por fidelización: <span id="spDescuentoImporte" class="spCalculado"></span> €
				</span>
			</div>
			<div>
				<span id="tipDtosTipo">
					Otros descuentos (<span id="spDtoTipo" class="spCalculado"></span>%): <span id="spDtoMonto" class="spCalculado"></span> €
				</span>
			</div>
			<div>Gastos de envío: <span id="spPortes" class="spCalculado" data-portes=""></span> €</div>
			<div>Total Pedido: <span id="spTotal" class="spCalculado"></span> €</div>
		</div>
	</div>
<?="\n<!-- /".get_class()." -->\n"?>