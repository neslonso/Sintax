<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	var mySwiper = new Swiper ('.swiper-container', {
		// Optional parameters
		direction: 'horizontal',

		// If we need pagination
		pagination: '.swiper-pagination',

		// Navigation arrows
		//nextButton: '.swiper-button-next',
		//prevButton: '.swiper-button-prev',

		// And if we need scrollbar
		//scrollbar: '.swiper-scrollbar',

		//loop: false,
		slidesPerView: 'auto', //auto debe ir con loopedSlides
		paginationClickable: true,
		spaceBetween: 30,

		/* Coverflow
		effect: 'coverflow',
		grabCursor: true,
		centeredSlides: true,
		slidesPerView: 'auto', //si hay loop, auto debe ir con loopedSlides
		coverflow: {
			rotate: 50,
			stretch: 0,
			depth: 100,
			modifier: 1,
			slideShadows : true
		},
		*/
		/*speed:1000,
		autoplay: 1000,*/
		autoplayDisableOnInteraction: false,
	});
});