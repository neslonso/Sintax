<?if (false) {?><script><?}?>
<?="\n/*".get_class()."*/\n"?>
$(document).ready(function() {
	$('.shop-item-link').on('click',function(event) {
		$thisShopItemWrapper=$(this).closest('.shop-item-wrapper');
		var resultInitSwiper=initOfersSwiper($thisShopItemWrapper.data('index'));
		event.preventDefault();
		var $imgOfer=$thisShopItemWrapper.find('.imgOfer');
		var $imgOferClone=$imgOfer.clone().appendTo(document.body)
		.addClass('imgAnimatedToSlider')
		.css({
			"position"        : 'fixed',
			"left"            : $imgOfer.offset().left-$(window).scrollLeft(),
			"top"             : $imgOfer.offset().top-$(window).scrollTop(),
			"z-index"         : 999999999999,
		})
		.animate({
			"left":resultInitSwiper.offset.left,
			"top":resultInitSwiper.offset.top,
		},{
			complete: function() {
				resultInitSwiper.$swiperTemplateClone.fadeIn('400', function() {
					$imgOferClone.fadeOut('400', function() {
						$imgOferClone.remove();
					});
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
					loop: true,
					//slidesPerView: '3',
					slidesPerView: 'auto',
					loopedSlides:33,
					spaceBetween: 30,

					grabCursor: true,
					centeredSlides: true,
					effect: 'coverflow',
					coverflow: {
						rotate: 50,
						stretch: 0,
						depth: 100,
						modifier: 1,
						slideShadows : false
					},
					slideToClickedSlide:true,
				});
				var result=new Object;
				var offset=new Object;
				offset.left=$('.swiper-slide-active',$swiperTemplateClone).find('img').offset().left-$(window).scrollLeft();
				offset.top=$('.swiper-slide-active',$swiperTemplateClone).find('img').offset().top-$(window).scrollTop();
				result.offset=offset;
				result.$swiperTemplateClone=$swiperTemplateClone;
				$swiperTemplateClone.hide();
				console.log(result);
				return result;
}