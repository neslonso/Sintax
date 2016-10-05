	<div class="row">
		<div class="col-lg-12">
			<div class='row'>
<?
		$i=1;
		foreach ($arrOfers as $stdObjOfer) {
?>
				<div class="col-lg-2 col-md-3 col-sm-6">
					<?=\Sintax\ApiService\Productos::fichaProductoResponsive($stdObjOfer);?>
				</div>
<?
			if ($i%6==0){echo '<div class="clearfix visible-lg"></div>';}
			if ($i%4==0){echo '<div class="clearfix visible-md"></div>';}
			if ($i%2==0){echo '<div class="clearfix visible-sm"></div>';}
			$i++;
		}
?>
			</div>
		</div>
	</div>