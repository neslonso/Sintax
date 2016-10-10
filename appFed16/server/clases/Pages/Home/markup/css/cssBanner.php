<?if (false) {?><style><?}?>
#container-banners .swiper-container {
	width: 100%;
	height: 100%;
	padding: 25px 0;
	box-shadow: inset 0 -7px 3px rgba(0, 0, 0, 0.3);

	background: linear-gradient(90deg, #ffffff, @color-principal, #ffffff);
	background-size: 600% 600%;
	animation: bannerBackground 120s ease infinite;
}
@keyframes bannerBackground {
	0%{background-position:0% 50%}
	50%{background-position:100% 50%}
	100%{background-position:0% 50%}
}
#container-banners .swiper-slide {
	width:300px;
}
#container-banners .swiper-slide>div {
	height:100%;
	background-color: #FFF;
	border: solid #a0a0a0 1px;
	border-radius: 7px;
}
#container-banners .swiper-slide>div>div {
	height: 100%;
}