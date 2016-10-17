<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	var mySwiper = new Swiper ('#container-banners .swiper-container', {
		// Optional parameters
		direction: 'horizontal',

		// If we need pagination
		//pagination: '.swiper-pagination',

		// Navigation arrows
		//nextButton: '.swiper-button-next',
		//prevButton: '.swiper-button-prev',

		// And if we need scrollbar
		//scrollbar: '.swiper-scrollbar',

		loop: false,
		slidesPerView: 'auto', //auto debe ir con loopedSlides
		freeMode:true,
		grabCursor: true,
		//centeredSlides: true,
		spaceBetween: 30,
		//mousewheelControl: true,
		speed:4000,
		autoplay: 8000,
		autoplayDisableOnInteraction: false,
		<?=$GLOBALS['config']->tienda->TEMA->EFECTO_BANNER?>
	});
	var mySwiperRec = new Swiper ('#swiperRecomendados', {
		direction: 'horizontal',
		loop: false,
		mousewheelControl: false,
		grabCursor: true,
	    nextButton: '.swiper-recomendados-button-next',
	    prevButton: '.swiper-recomendados-button-prev',
		slidesPerView: 'auto',
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