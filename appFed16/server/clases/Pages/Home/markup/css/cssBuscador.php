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
	background-color : rgba(255,255,255,0.9);
	margin           : 15px 0px 15px 0px;
	padding          : 13px;
	border           : solid @color-principal 1px;
	border-radius    : 7px;
	height           : 180px;
}
.ssSearchItemContainer .nombre {
	overflow      : hidden;
	white-space   : nowrap;
	text-overflow : ellipsis;
}

.ssSearchItemContainer .descripcion {
	overflow : hidden;
	height   : 100px;
}

.ssSearchItemContainer .precio {
	font-size: larger;
}

.fa-ssSearch-spin {
	-webkit-animation: fa-spin 0.3s infinite linear;
	animation: fa-spin 0.3s infinite linear;
}

.ssSearchContainer .ssSearchItemContainer {
}