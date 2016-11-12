<?if (false) {?><style><?}?>
/*********  LISTADO DE PRODUCTOS **********/
.swiper-slide .shop-item-wrapper {
	height: 100%;
}
.shop-item {
	position: relative;
	/*max-width: 360px;*/
	margin: 15px auto;
	/*padding: 5px;*/
	text-align: center;
	border-radius: 4px;
	overflow: hidden;
	background-color: @color-bg-items;
}

.shop-item-container .shop-item {
	.shop-item;
	border:2px solid @color-borde-items;
}
.shop-item.hover,
.shop-item:hover{
	border:2px solid @color-borde-items-over;
}
.shop-item img {
	/*width: 100%;*/
	/*max-width: 360px;*/
	margin: 0 auto;
	/*
	border: 1px solid #eee;
	border-radius: 3px;
	*/
}
.shop-item-img{
	padding-left: 25px;
	padding-right: 25px;
	padding-top: 5px;
}
.shop-item .shop-item-dtls {
	height:auto;
	overflow: auto;/* Esta combinación hace que crezca para albergar los margenes de sus hijod*/
	padding-left: 5px;
	padding-right: 5px;
}
.shop-item .shop-item-dtls h4 {
	margin-top: 13px;
	margin-bottom: 10px;
	text-transform: uppercase;
}
.shop-item .shop-item-dtls .shop-item-price {
	display: block;
	/*margin-bottom: 13px;*/
	font-size: 22px !important;
	color: @color-items-precio;
}
.shop-item .shop-item-price-antes{
	font-size: 14px;
	text-decoration:line-through;
	opacity: 0.5;
}
.shop-item .shop-item-cart {
	/*position: absolute;
	bottom:0px;
	left: 0px;*/
	width: 100%;
	padding-bottom:10px;
	padding-top: 10px;
	background-color: @color-principal;
}
.shop-item-container .shop-item .shop-item-cart {
	/*position: absolute;
	top: 100%;
	-webkit-transition: all 0.15s ease-in;
	-moz-transition: all 0.15s ease-in;
	-ms-transition: all 0.15s ease-in;
	-o-transition: all 0.15s ease-in;
	transition: all 0.15s ease-in;*/
}
.shop-item-container .shop-item.hover .shop-item-cart,
.shop-item-container .shop-item:hover .shop-item-cart {
	/*margin-top: -50px;*/
}
.shop-item .shop-item-cart  a.btn{
	border:1px solid lighten(@color-secundario,10%);
	color:contrast(@color-secundario) !important;
	background:@color-secundario;
}
.shop-item .shop-item-cart  a.btn:hover{
	color:contrast(lighten(@color-secundario, 10%)) !important;
	background:lighten(@color-secundario, 10%);
	border:1px solid @color-secundario;
}
.shop-item-link{
	cursor: pointer;
}
.shop-item-name{
	overflow: hidden;
	white-space: nowrap;
	text-overflow: ellipsis;
	font-size: smaller;
}
.shop-item-desc {
	display: none;
}
.shop-item-btn-info{
	background:@color-terciario;
	color:contrast(@color-terciario);
	border:1px solid lighten(@color-terciario,10%);
}
.shop-item-btn-info:hover{
	background:lighten(@color-terciario, 10%);
	color:contrast(lighten(@color-terciario, 10%));
	border:1px solid @color-terciario;
}
/*****/
.cloneAnimatedToSlider,
.swiper-slide .shop-item {
	.shop-item;
	margin:0px;
	height: 100%;
	border:2px solid @color-borde-items-over;
}
.cloneAnimatedToSlider .shop-item-data,
.swiper-slide .shop-item-data {
	overflow: hidden;
}
.cloneAnimatedToSlider .shop-item-img,
.swiper-slide .shop-item-img {
	/*height:40%;*/
}
.cloneAnimatedToSlider .shop-item-desc,
.swiper-slide .shop-item-desc {
	display: block;
	text-align: justify;
	padding:7px;
	overflow: auto;
	height:0px;
}

.cloneAnimatedToSlider .shop-item-dtls,
.swiper-slide .shop-item-dtls {
	/*height:20%;*/
}

/*
.shop-item-data {
	outline: 5px solid black;
}
.shop-item-img {
	outline: 1px solid red;
}
.shop-item-dtls {
	outline: 1px solid green;
}.shop-item-desc {
	outline: 1px solid blue;
}
*/