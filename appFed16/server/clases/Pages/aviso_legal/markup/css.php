<?if (false) {?><style><?}?>
<?="\n/*".get_class()."*/\n"?>
.aviso_legal {
	/*font-size:smaller;*/
	font-family: Helvetica, Verdana, sans-serif;
	text-align:justify;
}
.aviso_legal>div>div>div {
	margin:3em;
	padding:3em;
	background-color: #fff;
	-webkit-box-shadow: 3px 7px 7px 3px rgba(48,48,48,1);
	-moz-box-shadow: 3px 7px 7px 3px rgba(48,48,48,1);
	box-shadow: 3px 7px 7px 3px rgba(48,48,48,1);
}
.aviso_legal .divOl {
	margin:10px;
	margin-top: 40px;
}
.aviso_legal ol {
	color: #ccc;
	/*list-style-type: none;*/
	/*list-style-type: upper-roman;*/
	list-style-position: outside;
	margin-bottom:-2em;/*lo mismo el top del p*/
}

.aviso_legal ol li {
	font: bold italic 45px/1.5 Helvetica, Verdana, sans-serif;
	margin-bottom: 20px;
}

.aviso_legal li p {
	position:relative;
	font: 12px/1.5 Helvetica, sans-serif;
	padding-left: 20px;
	color: #555;
	top:-2em;
}
/* estilos navegadores */
#navegadores {
	height: auto;
	overflow: hidden;
}
#navegadores ul {
	list-style-type: none !important;
	margin: 0;
	padding: 0;
	height: auto;
	overflow: hidden;
}
#navegadores li {
	background: url("<?=BASE_URL?>/binaries/imgs/lib/logosBrowsers/sprite_navegadores.jpg") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
	float: left;
	font-size: 12px;
	height: 150px;
	margin: 0 2px;
	text-align: center;
	width: 110px;
}
#navegadores li a {
	color: #333333;
	float: left;
	font-size: 12px;
	font-weight: bold;
	width: 100%;
}
#navegadores li a span {
	float: left;
	padding-top: 115px;
	text-align: center;
	width: 100%;
}
#navegadores li.explorer {
	background-position: -10px -15px;
}
#navegadores li.firefox {
	background-position: -126px -15px;
}
#navegadores li.chrome {
	background-position: -242px -15px;
}
#navegadores li.safari {
	background-position: -362px -15px;
}
#navegadores li.opera {
	background-position: -477px -15px;
}
#navegadores li.ios {
	background-position: -605px -15px;
}
#navegadores li.android {
	background-position: -715px -15px;
}
#navegadores li.windowsphone {
	background-position: -842px -15px;
}
