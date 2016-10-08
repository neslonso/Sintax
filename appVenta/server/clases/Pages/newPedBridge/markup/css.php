<?if (false) {?><style><?}?>
<?="\n/*".get_class()."*/\n"?>
#ulDtos {}
@media (min-width: 992px) {
	#ulDtos li {
		float:left;
		width:44%;
		margin-right:3%;
	}
}

#spDtoMonto, #spDescuentoImporte {color:#f00;}

.tooltip-wide .tooltip .tooltip-inner {max-width:400px;}
.tooltip-wide .tooltip td {white-space:nowrap; padding:3px;}
.tooltip-wide .tooltip table td:first-child {
	max-width: 200px;
	overflow: hidden;
	text-overflow: ellipsis;
}
.tooltip-wide .tooltip table td:last-child {
	font-weight:bold;
}

/*
.tooltip table td:not(:first-child) {white-space:nowrap;}
*/

/* Input range styles *********************************************************/
@track-color: #337ab7;
@thumb-color: #fff;

@thumb-radius: 10px;
@thumb-height: 20px;
@thumb-width: 10px;
@thumb-shadow-size: 1px;
@thumb-shadow-blur: 0px;
@thumb-shadow-color: #111;
@thumb-border-width: 1px;
@thumb-border-color: #000;

@track-width: 100%;
@track-height: 7px;
@track-shadow-size: 2px;
@track-shadow-blur: 2px;
@track-shadow-color: #222;
@track-border-width: 1px;
@track-border-color: black;

@track-radius: 5px;
@contrast: 5%;

.shadow(@shadow-size,@shadow-blur,@shadow-color) {
	box-shadow: @shadow-size @shadow-size @shadow-blur @shadow-color, 0px 0px @shadow-size lighten(@shadow-color,5%);
}

.track() {
	width: @track-width;
	height: @track-height;
	cursor: pointer;
	animate: 0.2s;
}

.thumb() {
	.shadow(@thumb-shadow-size,@thumb-shadow-blur,@thumb-shadow-color);
	border: @thumb-border-width solid @thumb-border-color;
	height: @thumb-height;
	width: @thumb-width;
	border-radius: @thumb-radius;
	background: @thumb-color;
	cursor: pointer;
}

input[type=range] {
	-webkit-appearance: none;
	margin: @thumb-height/2 0;
	width: @track-width;

	&:focus {
		outline: none;
	}

	&::-webkit-slider-runnable-track {
		.track();
		.shadow(@track-shadow-size,@track-shadow-blur,@track-shadow-color);
		background: @track-color;
		border-radius: @track-radius;
		border: @track-border-width solid @track-border-color;
	}

	&::-webkit-slider-thumb {
		.thumb();
		-webkit-appearance: none;
		margin-top: ((-@track-border-width * 2 + @track-height) / 2) - (@thumb-height / 2);
	}

	&:focus::-webkit-slider-runnable-track {
		background: lighten(@track-color, @contrast);
	}

	&::-moz-range-track {
		.track();
		.shadow(@track-shadow-size,@track-shadow-blur,@track-shadow-color);
		background: @track-color;
		border-radius: @track-radius;
		border: @track-border-width solid @track-border-color;
	}
	&::-moz-range-thumb {
		.thumb();
	}

	&::-ms-track {
		.track();
		background: transparent;
		border-color: transparent;
		border-width: @thumb-width 0;
		color: transparent;
	}

	&::-ms-fill-lower {
		background: darken(@track-color, @contrast);
		border: @track-border-width solid @track-border-color;
		border-radius: @track-radius*2;
		.shadow(@track-shadow-size,@track-shadow-blur,@track-shadow-color);
	}
	&::-ms-fill-upper {
		background: @track-color;
		border: @track-border-width solid @track-border-color;
		border-radius: @track-radius*2;
		.shadow(@track-shadow-size,@track-shadow-blur,@track-shadow-color);
	}
	&::-ms-thumb {
		.thumb();
	}
	&:focus::-ms-fill-lower {
		background: @track-color;
	}
	&:focus::-ms-fill-upper {
		background: lighten(@track-color, @contrast);
	}
}
/* Input range styles *********************************************************/
<?="\n/*".get_class()."*/\n"?>