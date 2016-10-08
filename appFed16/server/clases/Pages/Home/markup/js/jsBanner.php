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
		//centeredSlides: true,
		spaceBetween: 30,
		//mousewheelControl: true,
		speed:3000,
		autoplay: 10000,
		autoplayDisableOnInteraction: false,
	});
	var mySwiperRec = new Swiper ('#swiperRecomendados', {
		slidesPerView: 'auto',
		direction: 'horizontal',
		loop: false,
		mousewheelControl: false,
		grabCursor: true,
	    nextButton: '.swiper-recomendados-button-next',
	    prevButton: '.swiper-recomendados-button-prev',
	});
});