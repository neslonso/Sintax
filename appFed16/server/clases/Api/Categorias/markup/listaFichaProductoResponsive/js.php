$(document).ready(function() {
	$('#container-cuerpo .shop-item-link').on('click',function(event) {
		$thisShopItemElto=$(this).closest('.shop-item');
		var resultInitSwiper=initOfersSwiper($thisShopItemElto.data('index'));
		event.preventDefault();
		var $animationElement=$thisShopItemElto;//.find('.imgOfer');
		var $animationElementClone=$animationElement.clone().appendTo(document.body).off('click')
		//.addClass('imgAnimatedToSlider')
		.css({
			"position" : 'fixed',
			"left"     : $animationElement.offset().left-$(window).scrollLeft(),
			"top"      : $animationElement.offset().top-$(window).scrollTop(),
			"width"    : $animationElement.width(),
			"height"   : $animationElement.height(),
			"z-index"  : 999999999999,
			"margin"   : '0px',
		})
		.animate({
			"left"   : resultInitSwiper.offset.left,
			"top"    : resultInitSwiper.offset.top,
			"width"  : resultInitSwiper.size.width,
			"height" : resultInitSwiper.size.height,
		},{
			duration: 3700,
			complete: function() {
				resultInitSwiper.$swiperTemplateClone.fadeIn('400', function() {
				});
				$animationElementClone.fadeOut('400', function() {
					$animationElementClone.remove();
				});
			}
		});
	});
});

function initOfersSwiper (initialSlide) {
				$.overlay();//destroyOnClick
				var $divTable=$('body').data('overlay').$divTable;
				var $swiperTemplateClone=$('.hiddenSwiper').clone(true,true).css({
					'display'  : 'block',
					'position' : 'fixed',
					'z-index'  : 9999999,
					'overflow' : 'hidden',
					//'outline'  : 'solid black 3px',
					'left'     : $(window).width()*0.2,
					'top'      : $(window).height()*0.2,
					'right'    : $(window).width()*0.2,
					'bottom'   : $(window).height()*0.2,
				})
				.on('click', function(event) {
					event.stopPropagation();
				})
				.appendTo($divTable);

				var mySwiper = new Swiper ($swiperTemplateClone.find('.ofersPageSwiperContainer')[0], {
					// Optional parameters
					direction: 'horizontal',

					// If we need pagination
					//pagination: '.swiper-pagination',

					// Navigation arrows
					nextButton: '.swiper-button-next',
					prevButton: '.swiper-button-prev',

					// And if we need scrollbar
					//scrollbar: '.swiper-scrollbar',

					initialSlide:initialSlide,
					spaceBetween: 30,
					mousewheelControl: true,
					grabCursor: true,
					centeredSlides: true,


					loop: true,
					slidesPerView: 'auto',
					//slidesPerView: '5',
					loopedSlides:0,
					effect: 'coverflow',
					coverflow: {
						rotate: 50,
						stretch: 0,
						depth: 300,
						modifier: 1,
						slideShadows : false
					},
					slideToClickedSlide:true,
					/*
					breakpoints: {
						1024: {
							slidesPerView: 4,
							spaceBetween: 40
						},
						768: {
							slidesPerView: 3,
							spaceBetween: 30
						},
						640: {
							slidesPerView: 2,
							spaceBetween: 20
						},
						320: {
							slidesPerView: 1,
							spaceBetween: 10
						}
					},
					*/
				});
				var result=new Object;
				var offset=new Object;
				var size=new Object;
				var $measuredElement=$('.swiper-slide-active',$swiperTemplateClone)//.find('img');
				offset.left=$measuredElement.offset().left-$(window).scrollLeft();
				offset.top=$measuredElement.offset().top-$(window).scrollTop();
				size.width=$measuredElement.outerWidth();
				size.height=$measuredElement.outerHeight();

				result.offset=offset;
				result.size=size;
				result.$swiperTemplateClone=$swiperTemplateClone;

				$swiperTemplateClone.hide();
				console.log(result);
				return result;
}