<?if (false) {?><style><?}?>
.container-menu{
	padding-left: 0px !important;
	padding-right: 0px !important;
}
.rootMenu{
	padding-left: 5px !important;
	/*
	background-repeat: no-repeat !important;
	background-position: -1px center !important;
	*/
}
.txtMenuRoot{
	display: inline-block;
	/*vertical-align: middle;
	vertical-align: -moz-middle-with-baseline;
	line-height: normal;*/
	width: @width-root-txt-menu;
	float:left;
	padding-left: 5px;
	height:30px;
	line-height: 30px;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
	text-transform: capitalize;
	font-variant: small-caps;
	font-size: smaller;
}
.rootMenu-ico{
	width: 30px;
	height: 30px;
	display: inline-block;
	float: left;
	border: solid @color-principal 1px;
	border-radius: 3px;
	background-color: #fff;
}
.col-subMenu{
	-moz-column-count: 3;
	-webkit-column-count: 3;
	column-count: 3;
}
.col-subMenu h4 a{
	font-weight: bold !important;
}
.col-subMenu .containerImgDecoCat {
	padding-top: 13px;
}
.img-cat-subMenu{
	width: 30px;
	height: 30px;
	display: inline-block;
	float: left !important;
	/*margin-top: 0px !important;*/
	/*margin-bottom: -10px !important;*/
	margin-right: 3px;
}
.nombre-cat-subMenu{
	float: left !important;
}
.ttmenu-content .box li {
	padding: 5px 5px 5px 0 !important;
}

.ttmenu-content .box+.child h4 {
	/*line-height: 30px;*/
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}