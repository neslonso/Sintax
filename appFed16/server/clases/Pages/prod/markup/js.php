<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('.inputUnit').change(function(event) {
		$spin=$(this);
		$( ".item-detail .jqCst" ).data('unit' , $spin[0].value);
	});

	$('.swiper-container').each(function(){
		new Swiper($(this), {
			direction: 'horizontal',
			loop: false,
			grabCursor: true,
			slidesPerView: 'auto',
			spaceBetween: 30,
			mousewheelControl: true,
			nextButton: $(this).closest('.relBlock').find('.swiper-button-next'),
			prevButton: $(this).closest('.relBlock').find('.swiper-button-prev'),
		});
	});
});

