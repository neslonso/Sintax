<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('.inputUnit').change(function(event) {
		$spin=$(this);
		$( ".item-detail .jqCst" ).data('unit' , $spin[0].value);
	});

	var mySwiper = new Swiper ('.swiper-container', {
		direction: 'horizontal',
		loop: false,
		grabCursor: true,
		nextButton: '.relBlock .swiper-button-next',
		prevButton: '.relBlock .swiper-button-prev',
		slidesPerView: 'auto',
		spaceBetween: 30,
		mousewheelControl: true,
	});
});

