<?if(false) {?><script><?}?>
$(document).ready(function() {
	$('.listaFichaProductoResponsive .shop-item-link').on('click',function(event) {
		event.preventDefault();
		$thisShopItemElto=$(this).closest('.shop-item');
		var resultInitSwiper=initOfersSwiper($thisShopItemElto.data('index'));

		var $animationElement=$thisShopItemElto;
		var $animationElementClone=$animationElement.clone().appendTo(document.body).off('click');

		//var $swiperSlideToEdit=$('.swiper-slide-active',resultInitSwiper.$swiperTemplateClone);
		var $swiperSlideToEdit=$('.swiper-slide',resultInitSwiper.$swiperTemplateClone);
		$(window).on('resize.swiperOferDetalle', function(event) {
			var shopItemDataHeight=$swiperSlideToEdit.find('.shop-item').height()-(
				$swiperSlideToEdit.find('.shop-item-cart').outerHeight(true)
			);
			$swiperSlideToEdit.find('.shop-item-data').outerHeight(shopItemDataHeight);
			cssFitContainer($swiperSlideToEdit.find('.shop-item-img'),$swiperSlideToEdit.find('.shop-item-img img'));
			var shopItemDescHeight=shopItemDataHeight-(
				$swiperSlideToEdit.find('.shop-item-img').outerHeight(true)+
				$swiperSlideToEdit.find('.shop-item-dtls').outerHeight(true)
			);
			$swiperSlideToEdit.find('.shop-item-desc').outerHeight(shopItemDescHeight);
			var topBottom=($(window).height()-resultInitSwiper.$swiperTemplateClone.outerHeight(true))/2;
			resultInitSwiper.$swiperTemplateClone.css({
				'top'      : topBottom,
				'bottom'   : topBottom,
			})
		});
		$animationElementClone
		.addClass('cloneAnimatedToSlider')
		.css({
			"position" : 'fixed',
			"left"     : $animationElement.offset().left-$(window).scrollLeft(),
			"top"      : $animationElement.offset().top-$(window).scrollTop(),
			"width"    : $animationElement.css('width'),
			"height"   : $animationElement.css('height'),
			"z-index"  : 999999999999,
		})
		.animate({
			"left"   : resultInitSwiper.offset.left,
			"top"    : resultInitSwiper.offset.top,
			"width"  : resultInitSwiper.size.width,
			"height" : resultInitSwiper.size.height,
		},{
			duration: 370,
			complete: function() {
				resultInitSwiper.$swiperTemplateClone.fadeIn(400, function() {
					var shopItemDataHeight=$swiperSlideToEdit.find('.shop-item').height()-(
						$swiperSlideToEdit.find('.shop-item-cart').outerHeight(true)
					);
					$swiperSlideToEdit.find('.shop-item-data').height(shopItemDataHeight);
					cssFitContainer($swiperSlideToEdit.find('.shop-item-img'),$swiperSlideToEdit.find('.shop-item-img img'));
					$animationElementClone.fadeOut(400, function() {
						$animationElementClone.remove();
					});
					var shopItemDescHeight=shopItemDataHeight-(
						$swiperSlideToEdit.find('.shop-item-img').outerHeight(true)+
						$swiperSlideToEdit.find('.shop-item-dtls').outerHeight(true)
					);
					$swiperSlideToEdit.find('.shop-item-desc').outerHeight(shopItemDescHeight);
				});
			},
			progress: function(animation,progress,remainignMs) {
				var $this=$(this);
				var shopItemDataHeight=$this.height()-(
					$this.find('.shop-item-cart').outerHeight(true)
				);
				$this.find('.shop-item-data').height(shopItemDataHeight);
				cssFitContainer($this.find('.shop-item-img'),$this.find('.shop-item-img img'));
				var shopItemDescHeight=shopItemDataHeight-(
					$this.find('.shop-item-img').outerHeight(true)+
					$this.find('.shop-item-dtls').outerHeight(true)
				);
				$this.find('.shop-item-desc').outerHeight(shopItemDescHeight);
			}
		});
	});
});

function initOfersSwiper (initialSlide) {
				var left   = Math.floor($(window).width()*0);
				var top    = Math.floor($(window).height()*0.2);
				var right  = Math.floor($(window).width()*0);
				var bottom = Math.floor($(window).height()*0.2);
				/*
				var left   = $(window).width()*0.2;
				var top    = $(window).height()*0.2;
				var right  = $(window).width()*0.2;
				var bottom = $(window).height()*0.2;
				*/
				$.overlay({
					progress: false,
					destroyOnClick:true,
				});
				var $divTable=$('body').data('overlay').$divTable;
				var $swiperTemplateClone=$('.hiddenSwiper').clone(true,true).css({
					'display'    : 'block',
					'position'   : 'fixed',
					'z-index'    : 9999999,
					//'overflow' : 'hidden',
					//'outline'  : 'solid black 3px',
					'left'       : left,
					'top'        : top,
					'right'      : right,
					'bottom'     : bottom,
					'min-height' : '220px',
					'max-height' : '500px',
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
					spaceBetween: 300,
					//mousewheelControl: true,
					grabCursor: true,
					centeredSlides: true,


					loop: true,
					slidesPerView: 'auto',
					keyboardControl: true,
					loopedSlides:0,
					effect: 'coverflow',
					coverflow: {
						rotate: 0,
						stretch: 0,
						depth: 500,
						modifier: 1,
						slideShadows : false
					},
					slideToClickedSlide:true,
					breakpoints: {
						480: {
							slidesPerView: 1,
						},
					},
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
				//console.log(result);
				return result;
}

function cssFitContainer($container,$contained) {//,widthAdjust,heightAdjust) {
	var cWidth=$container.innerWidth();//-widthAdjust;
	var cHeight=$container.innerHeight();//-heightAdjust;
	if (cWidth<cHeight) {
		$contained.css({
			'width': cWidth+'px',
			'height': 'auto',
		});
	} else {
		$contained.css({
			'width': 'auto',
			'height': cHeight+'px',
		});
	}
}