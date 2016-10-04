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

		loop: true,
		slidesPerView: 'auto', //auto debe ir con loopedSlides
		paginationClickable: true,
		freeMode:true,
		spaceBetween: 30,
		//mousewheelControl: true,
		speed:3000,
		autoplay: 10000,
		autoplayDisableOnInteraction: false,
	});
});