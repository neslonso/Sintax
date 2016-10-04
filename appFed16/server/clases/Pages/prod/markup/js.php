<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('.inputUnit').change(function(event) {
		$spin=$(this);
		var id=$(this).closest('.item-detail .jqCst').data('unit',  $spin[0].value);
	});
});

