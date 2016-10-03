/*********  LISTADO DE PRODUCTOS **********/
.shop-item {
	position: relative;
	max-width: 360px;
	margin: 15px auto;
	padding: 5px;
	text-align: center;
	border-radius: 4px;
	overflow: hidden;
	border:2px solid @color-borde-items;
	background-color: @color-bg-items;
	/*max-width: 200px;*/
}
.swiper-slide .shop-item-wrapper {
	height: 100%;
}
.swiper-slide .shop-item {
	margin:0px;
	height: 100%;
}
.shop-item:hover{
	border:2px solid @color-borde-items-over;
}
.shop-item img {
	width: 100%;
	max-width: 360px;
	margin: 0 auto;
	/*border: 1px solid #eee;*/
	border-radius: 3px;
}
.shop-item .shop-item-dtls h4 {
	margin-top: 13px;
	margin-bottom: 10px;
	text-transform: uppercase;
}
.shop-item .shop-item-dtls .shop-item-price {
	display: block;
	margin-bottom: 13px;
	font-size: 24px !important;
	color: @color-items-precio;
}
.shop-item .shop-item-cart {
	position: absolute;
	top: 100%;
	left: 0;
	width: 100%;
	padding-bottom:10px;
	padding-top: 10px;
	background-color: @color-btn-items;
	-webkit-transition: all 0.35s ease-in;
	-moz-transition: all 0.35s ease-in;
	-ms-transition: all 0.35s ease-in;
	-o-transition: all 0.35s ease-in;
	transition: all 0.35s ease-in;
}
.shop-item:hover .shop-item-cart {
	margin-top: -50px;
}
.shop-item .shop-item-cart  a.btn{
	border:1px solid @color-btn-items-border;
	color:@color-btn-items-bg-font !important;
	background:@color-btn-items-bg;
	-webkit-transition: all 0.35s ease-in;
	-moz-transition: all 0.35s ease-in;
	-ms-transition: all 0.35s ease-in;
	-o-transition: all 0.35s ease-in;
	transition: all 0.35s ease-in;
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
	overflow: hidden;
	height:0px;
}
body>.shop-item .shop-item-desc,
.swiper-slide .shop-item-desc {
	overflow: hidden;
	height:100%;
}

.shop-item .shop-item-cart  a.btn:hover{
	color:#fff !important;
	background:transparent;
}
.shop-item-rebote{
	background-image: url("./appFed16/binaries/imgs/shop-item-rebote.png");
	cursor: pointer;
	font-size: larger;
	height: 100px;
	position: absolute;
	right: -13px;
	top: -33px;
	width: 100px;
	z-index: @zindex-shop-item-rebote;
}
.shop-item-rebote > div{
	font-family: arial;
	font-size: larger;
	font-weight: bold;
	padding-left: 6px;
	position: absolute;
	text-align: center;
	top: 55px;
	width: 100%;
}
.shop-item-modal{
	padding: 5px;
	text-align: center;
	border-radius: 4px;
	border:2px solid @color-borde-items;
	background-color: @color-bg-items;
	max-height: 700px;
	overflow: hidden;
}
.shop-item-modal h1{
	font-size: 24px;
}
.shop-item-modal-price{
	color: @color-items-precio;
	font-size: 18px;
	font-weight: bold;
}
.shop-item-modal-img{
	display: inline-block !important;
}
