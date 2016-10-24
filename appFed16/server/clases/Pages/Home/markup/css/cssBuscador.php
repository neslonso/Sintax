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
	text-align: center;
	font-size: 1.5em;
	font-weight: bold;
}
.ssSearchItemContainer .btns>*:first-child {
	border:1px solid @color-btn-items-border;
	color:@color-btn-items-bg-font !important;
	background:@color-btn-items-bg;
}
.ssSearchItemContainer .btns>*:first-child:hover{
	color:#fff !important;
	background:@color-principal;
}

.ssSearchItemContainer .shop-item-dto{
	.shop-item-dto;
	left: 11px;
	top: 13px;
}
.ssSearchItemContainer .shop-item-dto-triangle{
	.shop-item-dto-triangle;
	left: 16px;
	top: 16px;
}

.fa-ssSearch-spin {
	-webkit-animation: fa-spin 0.3s infinite linear;
	animation: fa-spin 0.3s infinite linear;
}

.ssSearchContainer .ssSearchItemContainer {
}