<?if(false) {?><script><?}?>
<?\Sintax\ApiService\Productos::fichaProductoResponsiveJs();?>
$(document).ready(function() {
	$('.swiperFichaProductoResponsive').each(function(){
		new Swiper($(this).find('.swiper-container'), {
			direction: 'horizontal',
			loop: false,
			mousewheelControl: true,
			grabCursor: true,
			slidesPerView: 'auto',
			spaceBetween: 30,
			nextButton: $(this).find('.swiper-button-next'),
			prevButton: $(this).find('.swiper-button-prev'),
			/*
			breakpoints: {
				1024: {
					slidesPerView: 4,
					slidesPerGroup:4,
				},
				768: {
					slidesPerView: 3,
					slidesPerGroup:3,
				},
				640: {
					slidesPerView: 2,
					slidesPerGroup:2,
				},
				320: {
					slidesPerView: 1,
					slidesPerGroup:1,
				}
			},
			*/
		});
	});
});
