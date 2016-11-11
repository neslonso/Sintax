<?if (false) {?><style><?}?>
.ssSearchContainer {
	border           : solid @color-bordes-contenedores 1px;
	background-color : fade(@color-bg-cuerpo, 90%);
	border-radius    : 7px;
	box-shadow       : 10px 10px 5px 0px rgba(0,0,0,0.75);
	padding          : 13px;
}

.ssSearchItemContainer {
	/*padding:7px;*/
}
.ssSearchItemContainer>div {
	background-color       : rgba(255,255,255,0.9);
	margin                 : 15px 0px 15px 0px;
	padding                : 13px;
	border                 : solid @color-principal 1px;
	border-radius          : 7px;
	border-top-left-radius : 0px;
	height                 : 200px;
}
.ssSearchItemContainer .nombre {
	overflow      : hidden;
	white-space   : nowrap;
	text-overflow : ellipsis;
	border-bottom : solid @color-principal 1px;
	margin-bottom : 0.7em;
	text-align    : right;
}

.ssSearchItemContainer .descripcion {
	overflow   : hidden;
	height     : 100px;
	text-align : justify;
	margin:0.3em;
}

.ssSearchItemContainer .precio {
	position: absolute;
	text-align: center;
	font-size: 1.5em;
	font-weight: bold;
}
.ssSearchItemContainer .btns>*:first-child {
	border:1px solid lighten(@color-secundario,10%);
	color:contrast(@color-secundario) !important;
	background:@color-secundario;
}
.ssSearchItemContainer .btns>*:first-child:hover{
	color:contrast(lighten(@color-secundario, 10%)) !important;
	background:lighten(@color-secundario, 10%);
	border:1px solid @color-secundario;
}

.ssSearchItemContainer .shop-item-dto{
	left: 18px;
	top: 18px;
}
.ssSearchItemContainer .shop-item-dto-triangle{
	left: 16px;
	top: 16px;
}

.fa-ssSearch-spin {
	-webkit-animation: fa-spin 0.3s infinite linear;
	animation: fa-spin 0.3s infinite linear;
}

.ssSearchContainer .ssSearchItemContainer {
}
.ssSearchContainer .stamp {
	position: absolute;
	bottom: 7px;
	left: 73px;
	z-index:999999;
}
.ssSearchContainer .stamp>div {
	width:40px;
	height:20px;
	font-weight: bold;
	line-height: 0;
}
.ssSearchContainer .shop-item-rebote {
	position: absolute;
	top:-10px;
	right: -5px;
}

@media (max-width: 767px){
	.ssSearchItemContainer>div {
		height: auto !important;
	}
}
