<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('.inputUnit').change(function(event) {
		$spin=$(this);
		$( ".item-detail .jqCst" ).data('unit' , $spin[0].value);
	});
});

