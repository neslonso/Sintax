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
	background-color: @color-btn-items;
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
	border:1px solid @color-btn-items-border;
	color:@color-btn-items-bg-font !important;
	background:@color-btn-items-bg;
}
.shop-item .shop-item-cart  a.btn:hover{
	color:#fff !important;
	background:@color-principal;
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
	color:#fff;
	border:1px solid @color-btn-items-border;
}
.shop-item-btn-info:hover{
	background:@color-principal;
	color:#fff;
	border:1px solid @color-btn-items-border;
}
/* estilos rebote */
.shop-item-rebote{
	background-image: url("./appFed16/binaries/imgs/shop-item-rebote.png");
	background-size: cover;
	cursor: pointer;
	height: 60px;
	width: 60px;
	position: absolute;
	right: 9px;
	top: -7px;
	z-index: @zindex-shop-item-rebote;
}
.shop-item-rebote > div{
	font-family: arial;
	font-size: small;
	font-weight: bold;
	padding-left: 6px;
	position: absolute;
	text-align: center;
	top: 33px;
	width: 100%;
}
/*estilos triangulo dto*/
.shop-item-dto{
	position: absolute;
	z-index: @zindex-shop-item-rebote+1;
	font-size: 1.5em;
	color: @color-btn-items-bg-font;
	-webkit-transform: rotate(-45deg);
	transform: rotate(-45deg);
	font-weight: bold;
	text-align: center;
	height: 50px;
	width: 50px;
	left: 2px;
	top: 3px;
}
.shop-item-dto-triangle{
	width: 0;
	height: 0;
	border-style: solid;
	border-width: 50px 50px 0 0;
	border-color: @color-btn-items-bg transparent transparent transparent;
	position: absolute;
	left: 0px;
	top: 0px;
	z-index: @zindex-shop-item-rebote;
}
/*****/
.cloneAnimatedToSlider,
.swiper-slide .shop-item {
	.shop-item;
	margin:0px;
	height: 100%;
	border:2px solid @color-borde-items-over;
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
	outline: 1px solid black;
}
.shop-item-img {
	outline: 1px solid red;
}
.shop-item-dtls {
	outline: 1px solid green;
}.shop-item-desc {
	outline: 1px solid blue;
}*/
.shop-item-dto-gama>div {
	width: 240px;
	height: 240px;
	overflow: hidden;
}
.shop-item-dto-gama>div>div {
	padding: 1em;
}
.shop-item-dto-gama .dto {
	font-size: xx-large;
}
.shop-item-dto-gama .gama {
	font-size: xx-large;
	font-variant: small-caps;
}
